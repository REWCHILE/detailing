<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Extra;
use App\Models\VehicleType;
use App\Models\BusinessProfile;
use App\Models\BusinessHour;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\PageSeo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminCatalogController extends Controller
{
    // ==========================================
    // SERVICES CRUD
    // ==========================================

    public function servicesIndex()
    {
        $services = Service::with(['vehicleTypes', 'extras'])->orderBy('display_order')->get();
        $vehicleTypes = VehicleType::orderBy('display_order')->get();
        $extras = Extra::orderBy('display_order')->get();
        
        $categoryOrder = $this->getCategoryOrder();
        $categoryDetails = [
            'limpieza' => ['label' => 'Limpieza & Detallado', 'style' => 'color: #2563eb; background-color: #eff6ff; border-color: #bfdbfe;'],
            'correccion' => ['label' => 'Corrección', 'style' => 'color: #d97706; background-color: #fef3c7; border-color: #fde68a;'],
            'ceramico' => ['label' => 'Cerámico', 'style' => 'color: #059669; background-color: #d1fae5; border-color: #a7f3d0;'],
            'especiales' => ['label' => 'Especiales', 'style' => 'color: #9333ea; background-color: #f3e8ff; border-color: #e9d5ff;'],
        ];

        return view('admin.servicios', compact('services', 'vehicleTypes', 'extras', 'categoryOrder', 'categoryDetails'));
    }

    public function servicesCreate()
    {
        $vehicleTypes = VehicleType::orderBy('display_order')->get();
        $extras = Extra::orderBy('display_order')->get();
        
        return view('admin.servicios-form', compact('vehicleTypes', 'extras'));
    }

    public function servicesEdit($id)
    {
        $service = Service::with(['vehicleTypes', 'extras'])->findOrFail($id);
        $vehicleTypes = VehicleType::orderBy('display_order')->get();
        $extras = Extra::orderBy('display_order')->get();
        
        return view('admin.servicios-form', compact('service', 'vehicleTypes', 'extras'));
    }

    public function servicesStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|in:limpieza,correccion,ceramico,especiales',
            'short_description' => 'required|string',
            'long_description' => 'nullable|string',
            'prices' => 'required|array',
            'prices.*' => 'required|integer|min:0',
            'duration_minutes' => 'required|integer|min:1',
            'display_order' => 'required|integer',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'extras' => 'nullable|array',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $prices = $request->input('prices', []);
                $basePrice = count($prices) > 0 ? (int) reset($prices) : 0;

                $slug = Str::slug($request->input('name'));
                if (Service::where('slug', $slug)->exists()) {
                    $slug .= '-' . Str::random(4);
                }

                $service = Service::create([
                    'id' => (string) Str::ulid(),
                    'slug' => $slug,
                    'name' => $request->input('name'),
                    'category' => $request->input('category', 'especiales'),
                    'short_description' => $request->input('short_description'),
                    'long_description' => $request->input('long_description'),
                    'base_price' => $basePrice,
                    'duration_minutes' => $request->input('duration_minutes'),
                    'display_order' => $request->input('display_order', 0),
                    'is_active' => $request->boolean('is_active', true),
                    'is_featured' => $request->boolean('is_featured', false),
                ]);

                // Sync vehicle type prices
                $syncPrices = [];
                foreach ($prices as $vehicleTypeId => $price) {
                    $syncPrices[$vehicleTypeId] = ['price' => $price];
                }
                $service->vehicleTypes()->sync($syncPrices);

                // Sync extras
                $syncData = [];
                if ($request->has('extras')) {
                    foreach ($request->input('extras') as $extraId => $data) {
                        if (isset($data['enabled']) && $data['enabled'] == '1') {
                            $mode = $data['mode'] ?? 'optional';
                            $syncData[$extraId] = [
                                'is_default' => ($mode === 'recommended'),
                                'is_required' => ($mode === 'required'),
                                'is_courtesy' => ($mode === 'courtesy'),
                                'is_included' => ($mode === 'included')
                            ];
                        }
                    }
                }
                $service->extras()->sync($syncData);
            });

            return redirect()->route('admin.servicios')->with('success', 'Servicio creado correctamente.');
        } catch (\Exception $e) {
            Log::error("[AdminServices] Store error: " . $e->getMessage());
            return back()->withInput()->with('error', 'Error al crear el servicio.');
        }
    }

    public function servicesUpdate(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|in:limpieza,correccion,ceramico,especiales',
            'short_description' => 'required|string',
            'long_description' => 'nullable|string',
            'prices' => 'required|array',
            'prices.*' => 'required|integer|min:0',
            'duration_minutes' => 'required|integer|min:1',
            'display_order' => 'required|integer',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'extras' => 'nullable|array',
        ]);

        try {
            DB::transaction(function () use ($request, $service) {
                $prices = $request->input('prices', []);
                $basePrice = count($prices) > 0 ? (int) reset($prices) : 0;

                $slug = Str::slug($request->input('name'));
                if (Service::where('slug', $slug)->where('id', '!=', $service->id)->exists()) {
                    $slug .= '-' . Str::random(4);
                }

                $service->update([
                    'slug' => $slug,
                    'name' => $request->input('name'),
                    'category' => $request->input('category', 'especiales'),
                    'short_description' => $request->input('short_description'),
                    'long_description' => $request->input('long_description'),
                    'base_price' => $basePrice,
                    'duration_minutes' => $request->input('duration_minutes'),
                    'display_order' => $request->input('display_order'),
                    'is_active' => $request->boolean('is_active', false),
                    'is_featured' => $request->boolean('is_featured', false),
                ]);

                // Sync vehicle type prices
                $syncPrices = [];
                foreach ($prices as $vehicleTypeId => $price) {
                    $syncPrices[$vehicleTypeId] = ['price' => $price];
                }
                $service->vehicleTypes()->sync($syncPrices);

                // Sync extras
                $syncData = [];
                if ($request->has('extras')) {
                    foreach ($request->input('extras') as $extraId => $data) {
                        if (isset($data['enabled']) && $data['enabled'] == '1') {
                            $mode = $data['mode'] ?? 'optional';
                            $syncData[$extraId] = [
                                'is_default' => ($mode === 'recommended'),
                                'is_required' => ($mode === 'required'),
                                'is_courtesy' => ($mode === 'courtesy'),
                                'is_included' => ($mode === 'included')
                            ];
                        }
                    }
                }
                $service->extras()->sync($syncData);
            });

            return redirect()->route('admin.servicios')->with('success', 'Servicio actualizado correctamente.');
        } catch (\Exception $e) {
            Log::error("[AdminServices] Update error: " . $e->getMessage());
            return back()->withInput()->with('error', 'Error al actualizar el servicio.');
        }
    }

    public function servicesDelete($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return redirect()->route('admin.servicios')->with('success', 'Servicio eliminado.');
    }

    // ==========================================
    // EXTRAS CRUD
    // ==========================================

    public function extrasIndex()
    {
        $extras = Extra::with('services')->orderBy('display_order')->get();
        $services = Service::orderBy('name')->get();
        return view('admin.extras', compact('extras', 'services'));
    }

    public function extrasCreate()
    {
        $services = Service::orderBy('name')->get();
        return view('admin.extras-form', compact('services'));
    }

    public function extrasEdit($id)
    {
        $extra = Extra::with('services')->findOrFail($id);
        $services = Service::orderBy('name')->get();
        return view('admin.extras-form', compact('extra', 'services'));
    }

    public function extrasStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|integer|min:0',
            'duration_minutes' => 'required|integer|min:1',
            'display_order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        $slug = Str::slug($request->input('name'));
        if (Extra::where('slug', $slug)->exists()) {
            $slug .= '-' . Str::random(4);
        }

        $extra = Extra::create([
            'id' => (string) Str::ulid(),
            'slug' => $slug,
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'duration_minutes' => $request->input('duration_minutes'),
            'display_order' => $request->input('display_order'),
            'is_active' => $request->boolean('is_active', true),
        ]);

        if ($request->has('services')) {
            $extra->services()->sync($request->input('services'));
        }

        return redirect()->route('admin.extras')->with('success', 'Extra creado correctamente.');
    }

    public function extrasUpdate(Request $request, $id)
    {
        $extra = Extra::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|integer|min:0',
            'duration_minutes' => 'required|integer|min:1',
            'display_order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        $slug = Str::slug($request->input('name'));
        if (Extra::where('slug', $slug)->where('id', '!=', $id)->exists()) {
            $slug .= '-' . Str::random(4);
        }

        $extra->update([
            'slug' => $slug,
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'duration_minutes' => $request->input('duration_minutes'),
            'display_order' => $request->input('display_order'),
            'is_active' => $request->boolean('is_active', false),
        ]);

        if ($request->has('services')) {
            $extra->services()->sync($request->input('services'));
        } else {
            $extra->services()->sync([]);
        }

        return redirect()->route('admin.extras')->with('success', 'Extra actualizado correctamente.');
    }

    public function extrasDelete($id)
    {
        $extra = Extra::findOrFail($id);
        $extra->delete();
        return redirect()->route('admin.extras')->with('success', 'Extra eliminado.');
    }

    // ==========================================
    // VEHICLES CRUD
    // ==========================================

    public function vehiclesIndex()
    {
        $vehicles = VehicleType::orderBy('display_order')->get();
        return view('admin.vehiculos', compact('vehicles'));
    }

    public function vehiclesStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'emoji' => 'nullable|string|max:10',
            'price_multiplier' => 'nullable|numeric|min:0.1|max:5.0',
            'display_order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        $slug = Str::slug($request->input('name'));
        if (VehicleType::where('slug', $slug)->exists()) {
            $slug .= '-' . Str::random(4);
        }

        VehicleType::create([
            'id' => (string) Str::ulid(),
            'slug' => $slug,
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'emoji' => $request->input('emoji', '🚗'),
            'price_multiplier' => $request->input('price_multiplier', 1.0),
            'display_order' => $request->input('display_order'),
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.vehiculos')->with('success', 'Tipo de vehículo creado.');
    }

    public function vehiclesUpdate(Request $request, $id)
    {
        $vehicle = VehicleType::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'emoji' => 'nullable|string|max:10',
            'price_multiplier' => 'nullable|numeric|min:0.1|max:5.0',
            'display_order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        $vehicle->update([
            'slug' => Str::slug($request->input('name')),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'emoji' => $request->input('emoji', '🚗'),
            'price_multiplier' => $request->input('price_multiplier', 1.0),
            'display_order' => $request->input('display_order'),
            'is_active' => $request->boolean('is_active', false),
        ]);

        return redirect()->route('admin.vehiculos')->with('success', 'Tipo de vehículo actualizado.');
    }

    public function vehiclesDelete($id)
    {
        $vehicle = VehicleType::findOrFail($id);
        $vehicle->delete();
        return redirect()->route('admin.vehiculos')->with('success', 'Tipo de vehículo eliminado.');
    }

    // ==========================================
    // MERCADO PAGO GATEWAY CONFIG
    // ==========================================

    public function pasarelasIndex()
    {
        $profile = BusinessProfile::firstOrCreate(['id' => 'default']);
        return view('admin.pasarelas', compact('profile'));
    }

    public function pasarelasUpdate(Request $request)
    {
        $profile = BusinessProfile::firstOrCreate(['id' => 'default']);
        
        $request->validate([
            'payment_gateway_mode' => 'required|string|in:TEST,PRODUCTION',
            'mercado_pago_public_key_test' => 'nullable|string',
            'mercado_pago_access_token_test' => 'nullable|string',
            'mercado_pago_public_key_production' => 'nullable|string',
            'mercado_pago_access_token_production' => 'nullable|string',
            'payment_gateway_enabled' => 'boolean',
            'show_prices' => 'boolean',
        ]);

        $profile->update([
            'payment_gateway_enabled' => $request->boolean('payment_gateway_enabled', false),
            'show_prices' => $request->boolean('show_prices', false),
            'payment_gateway_mode' => $request->input('payment_gateway_mode'),
            'mercado_pago_public_key_test' => $request->input('mercado_pago_public_key_test'),
            'mercado_pago_access_token_test' => $request->input('mercado_pago_access_token_test'),
            'mercado_pago_public_key_production' => $request->input('mercado_pago_public_key_production'),
            'mercado_pago_access_token_production' => $request->input('mercado_pago_access_token_production'),
        ]);

        return redirect()->route('admin.pasarelas')->with('success', 'Configuración de pasarela de pago guardada.');
    }

    // ==========================================
    // GENERAL PROFILE & SMTP CONFIG
    // ==========================================

    public function configuracionIndex()
    {
        $profile = BusinessProfile::firstOrCreate(['id' => 'default']);
        $businessHours = BusinessHour::orderBy(DB::raw("FIELD(weekday, 'MONDAY', 'TUESDAY', 'WEDNESDAY', 'THURSDAY', 'FRIDAY', 'SATURDAY', 'SUNDAY')"))->get();
        $templates = \App\Models\EmailTemplate::all();
        return view('admin.configuracion', compact('profile', 'businessHours', 'templates'));
    }

    public function configuracionUpdate(Request $request)
    {
        $profile = BusinessProfile::firstOrCreate(['id' => 'default']);
        
        $request->validate([
            'business_name' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'whatsapp' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'google_maps_url' => 'nullable|url|max:1000',
            'google_analytics_id' => 'nullable|string|max:50',
            'google_tag_manager_id' => 'nullable|string|max:50',
            'header_scripts' => 'nullable|string',
            'footer_scripts' => 'nullable|string',
            'address_line1' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'booking_hold_minutes' => 'required|integer|min:5',
            'lead_time_hours' => 'required|integer|min:0',
            'max_advance_days' => 'required|integer|min:1',
            
            // SMTP Settings
            'smtp_host' => 'nullable|string',
            'smtp_port' => 'nullable|integer',
            'smtp_user' => 'nullable|string',
            'smtp_password' => 'nullable|string',
            'smtp_from_name' => 'nullable|string',
            'smtp_from_email' => 'nullable|string',
            'smtp_enabled' => 'boolean',
            'smtp_secure' => 'boolean',

            // Email Templates
            'templates' => 'nullable|array',
            'templates.*.subject' => 'required|string|max:255',
            'templates.*.title' => 'required|string|max:255',
            'templates.*.badge_text' => 'required|string|max:255',
            'templates.*.badge_color' => 'required|string|max:7',
            'templates.*.body_text' => 'required|string',

            // Business Hours array
            'hours' => 'nullable|array',
        ]);

        $logoPath = $profile->logo;
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');

            // Validate real MIME type (not just extension)
            $allowedMimes = ['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml'];
            if (!in_array($file->getMimeType(), $allowedMimes)) {
                return back()->withInput()->with('error', 'El formato de imagen no es válido. Usa JPG, PNG, WebP o SVG.');
            }

            // Use guessExtension() based on file content instead of client-provided extension
            $filename = 'logo_' . time() . '.' . $file->guessExtension();
            $file->storeAs('uploads', $filename, 'public');
            
            // Delete old logo if exists
            if ($profile->logo) {
                $oldFile = str_replace(['storage/uploads/', 'uploads/'], ['', ''], $profile->logo);
                \Illuminate\Support\Facades\Storage::disk('public')->delete('uploads/' . $oldFile);
            }
            
            $logoPath = 'storage/uploads/' . $filename;
        }

        $profile->update([
            'business_name' => $request->input('business_name'),
            'logo' => $logoPath,
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'whatsapp' => $request->input('whatsapp'),
            'instagram' => $request->input('instagram'),
            'google_maps_url' => $request->input('google_maps_url'),
            'google_analytics_id' => $request->input('google_analytics_id'),
            'google_tag_manager_id' => $request->input('google_tag_manager_id'),
            'header_scripts' => $request->input('header_scripts'),
            'footer_scripts' => $request->input('footer_scripts'),
            'address_line1' => $request->input('address_line1'),
            'city' => $request->input('city'),
            'region' => $request->input('region'),
            'booking_hold_minutes' => $request->input('booking_hold_minutes'),
            'lead_time_hours' => $request->input('lead_time_hours'),
            'max_advance_days' => $request->input('max_advance_days'),
            
            // SMTP
            'smtp_enabled' => $request->boolean('smtp_enabled', false),
            'smtp_host' => $request->input('smtp_host'),
            'smtp_port' => $request->input('smtp_port'),
            'smtp_user' => $request->input('smtp_user'),
            'smtp_password' => $request->input('smtp_password') === '____STORED_SECRET____' ? $profile->smtp_password : $request->input('smtp_password'),
            'smtp_secure' => $request->boolean('smtp_secure', false),
            'smtp_from_name' => $request->input('smtp_from_name'),
            'smtp_from_email' => $request->input('smtp_from_email'),
        ]);

        // Sync Business Hours
        if ($request->has('hours')) {
            foreach ($request->input('hours') as $weekday => $hourData) {
                $isClosed = isset($hourData['is_closed']);
                
                // Parse times into minutes of day
                $openMinute = null;
                $closeMinute = null;
                
                if (!$isClosed && !empty($hourData['open_time']) && !empty($hourData['close_time'])) {
                    [$oH, $oM] = explode(':', $hourData['open_time']);
                    [$cH, $cM] = explode(':', $hourData['close_time']);
                    $openMinute = ($oH * 60) + $oM;
                    $closeMinute = ($cH * 60) + $cM;
                }

                BusinessHour::where('weekday', $weekday)->update([
                    'is_closed' => $isClosed,
                    'open_minute_of_day' => $openMinute,
                    'close_minute_of_day' => $closeMinute,
                ]);
            }
        }

        // Sync/Update Email Templates
        if ($request->has('templates')) {
            foreach ($request->input('templates') as $key => $tplData) {
                \App\Models\EmailTemplate::where('key', $key)->update([
                    'subject' => $tplData['subject'],
                    'title' => $tplData['title'],
                    'badge_text' => $tplData['badge_text'],
                    'badge_color' => $tplData['badge_color'],
                    'body_text' => $tplData['body_text'],
                ]);
            }
        }

        return redirect()->route('admin.configuracion')->with('success', 'Configuración general guardada.');
    }

    public function testSmtp(Request $request)
    {
        $request->validate([
            'test_email' => 'required|email',
            'host' => 'required|string',
            'port' => 'required|integer',
            'user' => 'required|string',
            'password' => 'nullable|string',
            'fromName' => 'nullable|string',
            'fromEmail' => 'nullable|string',
            'secure' => 'boolean',
        ]);

        try {
            \App\Services\EmailService::sendTestEmail($request->input('test_email'), $request->all());
            return response()->json(['status' => 'success', 'message' => 'Correo de prueba enviado con éxito.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error SMTP: ' . $e->getMessage()], 500);
        }
    }

    public function servicesMoveUp($id)
    {
        $service = \App\Models\Service::findOrFail($id);
        $previous = \App\Models\Service::where('category', $service->category)
            ->where('display_order', '<', $service->display_order)
            ->orderBy('display_order', 'desc')
            ->first();

        if ($previous) {
            $temp = $service->display_order;
            $service->update(['display_order' => $previous->display_order]);
            $previous->update(['display_order' => $temp]);
        }
        return back()->with('success', 'Orden actualizado.');
    }

    public function servicesMoveDown($id)
    {
        $service = \App\Models\Service::findOrFail($id);
        $next = \App\Models\Service::where('category', $service->category)
            ->where('display_order', '>', $service->display_order)
            ->orderBy('display_order', 'asc')
            ->first();

        if ($next) {
            $temp = $service->display_order;
            $service->update(['display_order' => $next->display_order]);
            $next->update(['display_order' => $temp]);
        }
        return back()->with('success', 'Orden actualizado.');
    }

    private function getCategoryOrder()
    {
        $path = storage_path('app/category_order.json');
        if (file_exists($path)) {
            return json_decode(file_get_contents($path), true);
        }
        return ['limpieza', 'correccion', 'ceramico', 'especiales'];
    }

    private function setCategoryOrder($array)
    {
        file_put_contents(storage_path('app/category_order.json'), json_encode(array_values($array)));
    }

    public function categoriesMoveUp($cat)
    {
        $order = $this->getCategoryOrder();
        $index = array_search($cat, $order);
        if ($index > 0) {
            $temp = $order[$index - 1];
            $order[$index - 1] = $order[$index];
            $order[$index] = $temp;
            $this->setCategoryOrder($order);
        }
        return back()->with('success', 'Orden de categorías actualizado.');
    }

    public function categoriesMoveDown($cat)
    {
        $order = $this->getCategoryOrder();
        $index = array_search($cat, $order);
        if ($index !== false && $index < count($order) - 1) {
            $temp = $order[$index + 1];
            $order[$index + 1] = $order[$index];
            $order[$index] = $temp;
            $this->setCategoryOrder($order);
        }
        return back()->with('success', 'Orden de categorías actualizado.');
    }

    // ==========================================
    // DOCUMENTATION
    // ==========================================

    public function documentacionIndex()
    {
        return view('admin.documentacion');
    }

    // ==========================================
    // PAGE ANALYTICS
    // ==========================================

    public function paginasIndex(Request $request)
    {
        $period = $request->input('period', 'month');
        if (!in_array($period, ['today', 'yesterday', 'week', 'month', 'year', 'all'])) {
            $period = 'month';
        }

        // Date boundaries
        $now = now();
        $periodStart = match($period) {
            'today' => $now->copy()->startOfDay(),
            'yesterday' => $now->copy()->subDay()->startOfDay(),
            'week' => $now->copy()->startOfWeek(),
            'month' => $now->copy()->startOfMonth(),
            'year' => $now->copy()->startOfYear(),
            default => null, // 'all'
        };

        $periodEnd = match($period) {
            'today' => $now->copy()->endOfDay(),
            'yesterday' => $now->copy()->subDay()->endOfDay(),
            'week' => $now->copy()->endOfWeek(),
            'month' => $now->copy()->endOfMonth(),
            'year' => $now->copy()->endOfYear(),
            default => null, // 'all'
        };

        $periodLabels = [
            'today' => 'Hoy',
            'yesterday' => 'Ayer',
            'week' => 'Esta Semana',
            'month' => 'Este Mes',
            'year' => 'Este Año',
            'all' => 'Todo el Histórico',
        ];
        $currentPeriodLabel = $periodLabels[$period];

        // Period summary stats
        $periodVisitasQuery = \App\Models\PageVisit::query();
        if ($periodStart) $periodVisitasQuery->where('visited_at', '>=', $periodStart);
        if ($periodEnd) $periodVisitasQuery->where('visited_at', '<=', $periodEnd);
        $totalPeriod = $periodVisitasQuery->count();

        // Unique Visitors (IPs) in selected period
        $uniqueVisitorsQuery = \App\Models\PageVisit::query();
        if ($periodStart) $uniqueVisitorsQuery->where('visited_at', '>=', $periodStart);
        if ($periodEnd) $uniqueVisitorsQuery->where('visited_at', '<=', $periodEnd);
        $uniquePeriod = $uniqueVisitorsQuery->whereNotNull('ip_hash')->distinct('ip_hash')->count('ip_hash');

        // Global fixed stats
        $totalToday = \App\Models\PageVisit::where('visited_at', '>=', $now->copy()->startOfDay())->count();
        $totalYesterday = \App\Models\PageVisit::whereBetween('visited_at', [$now->copy()->subDay()->startOfDay(), $now->copy()->subDay()->endOfDay()])->count();
        $totalWeek = \App\Models\PageVisit::where('visited_at', '>=', $now->copy()->startOfWeek())->count();
        $totalMonth = \App\Models\PageVisit::where('visited_at', '>=', $now->copy()->startOfMonth())->count();
        $totalAll = \App\Models\PageVisit::count();

        // Top page for selected period
        $topPageQuery = \App\Models\PageVisit::select('page_path', 'page_title', DB::raw('COUNT(*) as visit_count'));
        if ($periodStart) $topPageQuery->where('visited_at', '>=', $periodStart);
        if ($periodEnd) $topPageQuery->where('visited_at', '<=', $periodEnd);
        $topPage = $topPageQuery->groupBy('page_path', 'page_title')
            ->orderByDesc('visit_count')
            ->first();

        // Pages table with period_visits & global counts
        $pagesQuery = \App\Models\PageVisit::select(
            'page_path',
            'page_title',
            DB::raw('COUNT(*) as total_visits'),
            DB::raw('SUM(CASE WHEN visited_at >= "' . $now->copy()->startOfDay()->format('Y-m-d H:i:s') . '" THEN 1 ELSE 0 END) as today_visits'),
            DB::raw('SUM(CASE WHEN visited_at >= "' . $now->copy()->startOfWeek()->format('Y-m-d H:i:s') . '" THEN 1 ELSE 0 END) as week_visits'),
            DB::raw('SUM(CASE WHEN visited_at >= "' . $now->copy()->startOfMonth()->format('Y-m-d H:i:s') . '" THEN 1 ELSE 0 END) as month_visits'),
            DB::raw('SUM(CASE WHEN visited_at >= "' . $now->copy()->startOfYear()->format('Y-m-d H:i:s') . '" THEN 1 ELSE 0 END) as year_visits')
        );

        if ($periodStart && $periodEnd) {
            $pagesQuery->addSelect(DB::raw('SUM(CASE WHEN visited_at >= "' . $periodStart->format('Y-m-d H:i:s') . '" AND visited_at <= "' . $periodEnd->format('Y-m-d H:i:s') . '" THEN 1 ELSE 0 END) as period_visits'));
        } else {
            $pagesQuery->addSelect(DB::raw('COUNT(*) as period_visits'));
        }

        $pages = $pagesQuery->groupBy('page_path', 'page_title')
            ->orderByDesc('period_visits')
            ->orderByDesc('total_visits')
            ->get();

        // Dynamic Chart Data based on period (Visitantes Únicos por IP)
        $chartLabels = [];
        $chartValues = [];

        if ($period === 'today' || $period === 'yesterday') {
            $chartTitle = $period === 'today' ? 'Visitantes Únicos de Hoy (por hora)' : 'Visitantes Únicos de Ayer (por hora)';
            $chartRaw = \App\Models\PageVisit::select(
                    DB::raw('HOUR(visited_at) as hr'),
                    DB::raw('COUNT(DISTINCT ip_hash) as visit_count')
                )
                ->where('visited_at', '>=', $periodStart)
                ->where('visited_at', '<=', $periodEnd)
                ->groupBy(DB::raw('HOUR(visited_at)'))
                ->pluck('visit_count', 'hr')
                ->toArray();

            for ($h = 0; $h < 24; $h++) {
                $chartLabels[] = sprintf('%02d:00', $h);
                $chartValues[] = $chartRaw[$h] ?? 0;
            }
        } elseif ($period === 'week') {
            $chartTitle = 'Visitantes Únicos de esta semana';
            $chartRaw = \App\Models\PageVisit::select(
                    DB::raw('DATE(visited_at) as visit_date'),
                    DB::raw('COUNT(DISTINCT ip_hash) as visit_count')
                )
                ->where('visited_at', '>=', $periodStart)
                ->where('visited_at', '<=', $periodEnd)
                ->groupBy(DB::raw('DATE(visited_at)'))
                ->pluck('visit_count', 'visit_date')
                ->toArray();

            $dayNames = [0 => 'Dom', 1 => 'Lun', 2 => 'Mar', 3 => 'Mié', 4 => 'Jue', 5 => 'Vie', 6 => 'Sáb'];
            for ($i = 0; $i < 7; $i++) {
                $dt = $periodStart->copy()->addDays($i);
                $dateKey = $dt->format('Y-m-d');
                $chartLabels[] = ($dayNames[$dt->dayOfWeek] ?? '') . ' ' . $dt->format('d/m');
                $chartValues[] = $chartRaw[$dateKey] ?? 0;
            }
        } elseif ($period === 'month') {
            $chartTitle = 'Visitantes Únicos de este mes (' . mb_convert_case($now->translatedFormat('F Y'), MB_CASE_TITLE, "UTF-8") . ')';
            $chartRaw = \App\Models\PageVisit::select(
                    DB::raw('DATE(visited_at) as visit_date'),
                    DB::raw('COUNT(DISTINCT ip_hash) as visit_count')
                )
                ->where('visited_at', '>=', $periodStart)
                ->where('visited_at', '<=', $periodEnd)
                ->groupBy(DB::raw('DATE(visited_at)'))
                ->pluck('visit_count', 'visit_date')
                ->toArray();

            $daysInMonth = $now->daysInMonth;
            for ($i = 1; $i <= $daysInMonth; $i++) {
                $dt = $now->copy()->startOfMonth()->addDays($i - 1);
                $dateKey = $dt->format('Y-m-d');
                $chartLabels[] = $dt->format('d M');
                $chartValues[] = $chartRaw[$dateKey] ?? 0;
            }
        } elseif ($period === 'year') {
            $chartTitle = 'Visitantes Únicos del año ' . $now->year;
            $chartRaw = \App\Models\PageVisit::select(
                    DB::raw('MONTH(visited_at) as mth'),
                    DB::raw('COUNT(DISTINCT ip_hash) as visit_count')
                )
                ->where('visited_at', '>=', $periodStart)
                ->where('visited_at', '<=', $periodEnd)
                ->groupBy(DB::raw('MONTH(visited_at)'))
                ->pluck('visit_count', 'mth')
                ->toArray();

            $monthsNames = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
            for ($m = 1; $m <= 12; $m++) {
                $chartLabels[] = $monthsNames[$m - 1];
                $chartValues[] = $chartRaw[$m] ?? 0;
            }
        } else {
            $chartTitle = 'Visitantes Únicos históricos (Últimos 12 meses)';
            $chartRaw = \App\Models\PageVisit::select(
                    DB::raw("DATE_FORMAT(visited_at, '%Y-%m') as ym"),
                    DB::raw('COUNT(DISTINCT ip_hash) as visit_count')
                )
                ->groupBy(DB::raw("DATE_FORMAT(visited_at, '%Y-%m')"))
                ->pluck('visit_count', 'ym')
                ->toArray();

            for ($i = 11; $i >= 0; $i--) {
                $dt = $now->copy()->subMonths($i);
                $key = $dt->format('Y-m');
                $chartLabels[] = $dt->format('M Y');
                $chartValues[] = $chartRaw[$key] ?? 0;
            }
        }

        // Map data: visitors grouped by city with coordinates for period
        $mapLocationsQuery = \App\Models\PageVisit::select(
                'city', 'country', 'latitude', 'longitude',
                DB::raw('COUNT(*) as visit_count')
            )
            ->whereNotNull('latitude')
            ->whereNotNull('longitude');

        if ($periodStart) $mapLocationsQuery->where('visited_at', '>=', $periodStart);
        if ($periodEnd) $mapLocationsQuery->where('visited_at', '<=', $periodEnd);

        $mapLocations = $mapLocationsQuery->groupBy('city', 'country', 'latitude', 'longitude')
            ->orderByDesc('visit_count')
            ->limit(200)
            ->get();

        // Top referrers for period
        $topReferrersQuery = \App\Models\PageVisit::select('referer', DB::raw('COUNT(*) as ref_count'))
            ->whereNotNull('referer')
            ->where('referer', '!=', '');

        if ($periodStart) $topReferrersQuery->where('visited_at', '>=', $periodStart);
        if ($periodEnd) $topReferrersQuery->where('visited_at', '<=', $periodEnd);

        $topReferrers = $topReferrersQuery->groupBy('referer')
            ->orderByDesc('ref_count')
            ->limit(10)
            ->get()
            ->map(function ($item) {
                $parsed = parse_url($item->referer);
                $item->referer_domain = $parsed['host'] ?? $item->referer;
                return $item;
            });

        // SEO management data
        $seoPages = PageSeo::orderBy('id')->get();

        // Abandoned Quotes Lead Capture for selected period
        BookingController::ensureAbandonedQuotesTableExists();
        $abandonedQuery = \App\Models\AbandonedQuote::query();

        if ($periodStart) $abandonedQuery->where('last_activity_at', '>=', $periodStart);
        if ($periodEnd) $abandonedQuery->where('last_activity_at', '<=', $periodEnd);

        $abandonedQuotes = $abandonedQuery->orderByDesc('last_activity_at')->get();
        $totalAbandonedValue = $abandonedQuotes->where('status', 'DRAFT')->sum('total_price');

        return view('admin.paginas', compact(
            'period', 'currentPeriodLabel', 'totalPeriod', 'uniquePeriod',
            'totalToday', 'totalYesterday', 'totalWeek', 'totalMonth', 'totalAll',
            'topPage', 'pages', 'chartTitle', 'chartLabels', 'chartValues',
            'mapLocations', 'topReferrers', 'seoPages',
            'abandonedQuotes', 'totalAbandonedValue'
        ));
    }

    public function paginasMapData(Request $request)
    {
        $period = $request->input('period', 'month');
        $now = now();
        $periodStart = match($period) {
            'today' => $now->copy()->startOfDay(),
            'yesterday' => $now->copy()->subDay()->startOfDay(),
            'week' => $now->copy()->startOfWeek(),
            'month' => $now->copy()->startOfMonth(),
            'year' => $now->copy()->startOfYear(),
            default => null,
        };

        $periodEnd = match($period) {
            'today' => $now->copy()->endOfDay(),
            'yesterday' => $now->copy()->subDay()->endOfDay(),
            'week' => $now->copy()->endOfWeek(),
            'month' => $now->copy()->endOfMonth(),
            'year' => $now->copy()->endOfYear(),
            default => null,
        };

        $query = \App\Models\PageVisit::select(
                'city', 'country', 'latitude', 'longitude',
                DB::raw('COUNT(*) as visit_count')
            )
            ->whereNotNull('latitude')
            ->whereNotNull('longitude');

        if ($periodStart) $query->where('visited_at', '>=', $periodStart);
        if ($periodEnd) $query->where('visited_at', '<=', $periodEnd);

        $locations = $query->groupBy('city', 'country', 'latitude', 'longitude')
            ->orderByDesc('visit_count')
            ->limit(200)
            ->get();

        return response()->json($locations);
    }

    // ==========================================
    // SEO MANAGEMENT
    // ==========================================

    public function seoUpdate(Request $request)
    {
        $request->validate([
            'seo' => 'required|array',
            'seo.*.seo_title' => 'nullable|string|max:255',
            'seo.*.seo_description' => 'nullable|string|max:500',
        ]);

        foreach ($request->input('seo') as $id => $data) {
            PageSeo::where('id', $id)->update([
                'seo_title' => $data['seo_title'] ?? null,
                'seo_description' => $data['seo_description'] ?? null,
            ]);
        }

        return redirect()->route('admin.paginas')->with('success', 'Metadatos SEO actualizados correctamente.');
    }
}
