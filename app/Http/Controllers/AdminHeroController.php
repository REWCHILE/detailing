<?php

namespace App\Http\Controllers;

use App\Models\HeroSlide;
use App\Models\BusinessProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AdminHeroController extends Controller
{
    public function index()
    {
        // Auto-seed default slides if table is empty
        if (HeroSlide::count() === 0) {
            $defaultSlides = [
                [
                    'id' => (string) Str::ulid(),
                    'title' => 'HIGH',
                    'title_gradient' => 'CONTRAST',
                    'subtitle' => 'El estándar más alto en detallado automotriz. Protección, brillo y perfección absoluta para tu vehículo.',
                    'media_type' => 'video',
                    'media_path' => '/assets/videos/hero-banner.mp4',
                    'button_primary_text' => 'Cotiza tu servicio',
                    'button_primary_url' => '/reserva',
                    'button_secondary_text' => 'Explorar servicios',
                    'button_secondary_url' => '#servicios',
                    'display_order' => 1,
                    'is_active' => true,
                ],
                [
                    'id' => (string) Str::ulid(),
                    'title' => 'SELLADO',
                    'title_gradient' => 'CERÁMICO',
                    'subtitle' => 'Protección extrema de nivel profesional con tecnología Gtechniq Platinum. Hasta 9 años de protección y brillo permanente.',
                    'media_type' => 'video',
                    'media_path' => '/assets/videos/hero-gtechniq.mp4',
                    'button_primary_text' => 'Cotizar Sellado',
                    'button_primary_url' => '/reserva?category=ceramic',
                    'button_secondary_text' => 'Saber más',
                    'button_secondary_url' => '/sellado-ceramico',
                    'display_order' => 2,
                    'is_active' => true,
                ],
                [
                    'id' => (string) Str::ulid(),
                    'title' => 'CORRECCIÓN DE',
                    'title_gradient' => 'PINTURA',
                    'subtitle' => 'Restauramos la claridad de tu pintura mediante pulido técnico multi-etapa, eliminando micro-rayas y devolviendo el acabado espejo.',
                    'media_type' => 'image',
                    'media_path' => 'https://images.unsplash.com/photo-1507136566006-cfc505b114fc?auto=format&fit=crop&q=80&w=1920',
                    'button_primary_text' => 'Cotizar Pulido',
                    'button_primary_url' => '/reserva?category=correccion',
                    'button_secondary_text' => 'Ver Detalles',
                    'button_secondary_url' => '/pulido-de-autos-santiago',
                    'display_order' => 3,
                    'is_active' => true,
                ],
                [
                    'id' => (string) Str::ulid(),
                    'title' => 'DETALLADO de',
                    'title_gradient' => 'INTERIOR',
                    'subtitle' => 'Limpieza a vapor, sanitización completa y acondicionamiento protector de cuero y plásticos con sellantes premium.',
                    'media_type' => 'image',
                    'media_path' => 'https://images.unsplash.com/photo-1607860108855-64acf2078ed9?auto=format&fit=crop&q=80&w=1920',
                    'button_primary_text' => 'Cotizar Detallado',
                    'button_primary_url' => '/reserva?category=limpieza',
                    'button_secondary_text' => 'Ver Más',
                    'button_secondary_url' => '/detailing-interior',
                    'display_order' => 4,
                    'is_active' => true,
                ]
            ];

            foreach ($defaultSlides as $slideData) {
                HeroSlide::create($slideData);
            }
        }

        $slides = HeroSlide::orderBy('display_order')->get();
        
        // Load business profile for layout sidebar logo, etc.
        $shopProfile = BusinessProfile::firstOrCreate(['id' => 'default'], [
            'business_name' => 'High Contrast Detailing Center',
            'email' => 'contacto@highcontrastdetailing.cl',
            'phone' => '+56 9 1234 5678',
            'address_line1' => 'Chicureo, Colina',
            'city' => 'Colina',
            'region' => 'Región Metropolitana',
        ]);
        
        return view('admin.sliders', compact('slides', 'shopProfile'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'title_gradient' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'media_type' => 'required|in:image,video',
            'media_file' => 'nullable|file|max:51200', // up to 50MB for video
            'media_url' => 'nullable|string|max:2048',
            'button_primary_text' => 'nullable|string|max:255',
            'button_primary_url' => 'nullable|string|max:2048',
            'button_secondary_text' => 'nullable|string|max:255',
            'button_secondary_url' => 'nullable|string|max:2048',
            'display_order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        try {
            $mediaPath = $request->input('media_url');

            if ($request->hasFile('media_file')) {
                $file = $request->file('media_file');
                
                // Extra validation for file types based on media_type
                $mimeType = $file->getMimeType();
                if ($request->input('media_type') === 'image' && !Str::startsWith($mimeType, 'image/')) {
                    return back()->withInput()->with('error', 'El archivo subido no es una imagen válida.');
                }
                if ($request->input('media_type') === 'video' && !Str::startsWith($mimeType, 'video/')) {
                    return back()->withInput()->with('error', 'El archivo subido no es un video válido.');
                }

                $extension = $file->guessExtension() ?? $file->getClientOriginalExtension();
                $filename = 'slide_' . time() . '_' . Str::random(5) . '.' . $extension;
                $file->storeAs('uploads/slides', $filename, 'public');
                $mediaPath = 'storage/uploads/slides/' . $filename;
            }

            HeroSlide::create([
                'id' => (string) Str::ulid(),
                'title' => $request->input('title'),
                'title_gradient' => $request->input('title_gradient'),
                'subtitle' => $request->input('subtitle'),
                'media_type' => $request->input('media_type'),
                'media_path' => $mediaPath,
                'button_primary_text' => $request->input('button_primary_text'),
                'button_primary_url' => $request->input('button_primary_url'),
                'button_secondary_text' => $request->input('button_secondary_text'),
                'button_secondary_url' => $request->input('button_secondary_url'),
                'display_order' => $request->input('display_order', 0),
                'is_active' => $request->boolean('is_active', true),
            ]);

            return redirect()->route('admin.sliders')->with('success', 'Slide creado correctamente.');
        } catch (\Exception $e) {
            Log::error("[AdminHero] Store error: " . $e->getMessage());
            return back()->withInput()->with('error', 'Error al crear el slide.');
        }
    }

    public function update(Request $request, $id)
    {
        $slide = HeroSlide::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'title_gradient' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'media_type' => 'required|in:image,video',
            'media_file' => 'nullable|file|max:51200',
            'media_url' => 'nullable|string|max:2048',
            'button_primary_text' => 'nullable|string|max:255',
            'button_primary_url' => 'nullable|string|max:2048',
            'button_secondary_text' => 'nullable|string|max:255',
            'button_secondary_url' => 'nullable|string|max:2048',
            'display_order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        try {
            $mediaPath = $request->input('media_url') ?: $slide->media_path;

            if ($request->hasFile('media_file')) {
                $file = $request->file('media_file');
                
                $mimeType = $file->getMimeType();
                if ($request->input('media_type') === 'image' && !Str::startsWith($mimeType, 'image/')) {
                    return back()->withInput()->with('error', 'El archivo subido no es una imagen válida.');
                }
                if ($request->input('media_type') === 'video' && !Str::startsWith($mimeType, 'video/')) {
                    return back()->withInput()->with('error', 'El archivo subido no es un video válido.');
                }

                $extension = $file->guessExtension() ?? $file->getClientOriginalExtension();
                $filename = 'slide_' . time() . '_' . Str::random(5) . '.' . $extension;
                $file->storeAs('uploads/slides', $filename, 'public');
                
                // Delete old media file from disk if it was an uploaded file
                if ($slide->media_path && Str::contains($slide->media_path, 'storage/uploads/slides')) {
                    $oldFile = str_replace('storage/uploads/slides/', '', $slide->media_path);
                    Storage::disk('public')->delete('uploads/slides/' . $oldFile);
                }

                $mediaPath = 'storage/uploads/slides/' . $filename;
            }

            $slide->update([
                'title' => $request->input('title'),
                'title_gradient' => $request->input('title_gradient'),
                'subtitle' => $request->input('subtitle'),
                'media_type' => $request->input('media_type'),
                'media_path' => $mediaPath,
                'button_primary_text' => $request->input('button_primary_text'),
                'button_primary_url' => $request->input('button_primary_url'),
                'button_secondary_text' => $request->input('button_secondary_text'),
                'button_secondary_url' => $request->input('button_secondary_url'),
                'display_order' => $request->input('display_order', 0),
                'is_active' => $request->boolean('is_active', true),
            ]);

            return redirect()->route('admin.sliders')->with('success', 'Slide actualizado correctamente.');
        } catch (\Exception $e) {
            Log::error("[AdminHero] Update error: " . $e->getMessage());
            return back()->withInput()->with('error', 'Error al actualizar el slide.');
        }
    }

    public function destroy($id)
    {
        $slide = HeroSlide::findOrFail($id);

        try {
            // Delete media file from disk
            if ($slide->media_path && Str::contains($slide->media_path, 'storage/uploads/slides')) {
                $oldFile = str_replace('storage/uploads/slides/', '', $slide->media_path);
                Storage::disk('public')->delete('uploads/slides/' . $oldFile);
            }

            $slide->delete();
            return redirect()->route('admin.sliders')->with('success', 'Slide eliminado correctamente.');
        } catch (\Exception $e) {
            Log::error("[AdminHero] Destroy error: " . $e->getMessage());
            return back()->with('error', 'Error al eliminar el slide.');
        }
    }
}
