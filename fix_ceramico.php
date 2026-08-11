<?php
$content = file_get_contents('c:/laragon/www/detailing-laravel/resources/views/sellado-ceramico.blade.php');

$newGrid = <<<'HTML'
            @php
                if (!function_exists('getVehicleIcon')) {
                    function getVehicleIcon($slug) {
                        $icons = [
                            'sedan' => '🚗',
                            'hatchback' => '🚙',
                            'suv' => '🚙',
                            'camioneta' => '🛻',
                            'deportivo' => '🏎️',
                            'moto' => '🏍️'
                        ];
                        return $icons[$slug] ?? '🚗';
                    }
                }

                $profile = \App\Models\BusinessProfile::first();
                $onlinePaymentsActive = $profile ? ($profile->payment_gateway_enabled || $profile->show_prices) : false;
                $vehicleTypes = \App\Models\VehicleType::where('is_active', true)->orderBy('display_order')->get();
                $categoryServices = \App\Models\Service::with('vehicleTypes')->where('category', 'ceramico')->where('is_active', true)->orderBy('display_order')->get();
            @endphp

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                @foreach($categoryServices as $srv)
                    <div class="relative flex flex-col h-full rounded-[40px] p-8 md:p-10 transition-all duration-500 group premium-pricing-card {{ $srv->is_featured ? 'popular-pricing-card' : '' }}">
                        @if($srv->is_featured)
                            <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-brand text-white text-[10px] font-black uppercase tracking-widest px-4 py-1.5 rounded-full z-10 shadow-lg">
                                Destacado
                            </div>
                        @endif

                        <div class="mb-8">
                            <div class="flex items-center justify-between mb-6">
                                <div class="w-14 h-14 rounded-2xl bg-brand/10 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                                </div>
                                <div class="bg-brand/10 text-brand border border-brand/20 px-3 py-1.5 rounded-full text-xs font-black uppercase tracking-widest flex items-center gap-1.5 shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-brand"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                                    {{ $srv->duration_minutes }} MIN
                                </div>
                            </div>
                            <h3 class="text-2xl font-display font-bold text-black dark:text-white mb-4 transition-colors">
                                {{ $srv->name }}
                            </h3>
                            <p class="text-black/60 dark:text-white/50 text-sm leading-relaxed min-h-[3rem] transition-colors font-medium">
                                {{ $srv->short_description }}
                            </p>
                        </div>

                        <div class="space-y-3 mb-8">
                            @foreach($vehicleTypes as $vt)
                                <div class="flex items-center justify-between p-3 rounded-2xl bg-white/80 dark:bg-white/[0.02] border border-black/5 dark:border-white/5 shadow-sm transition-all duration-300 hover:border-brand/20 hover:bg-white dark:hover:bg-white/[0.04]">
                                    <div class="flex items-center gap-3">
                                        <span class="text-xl leading-none">{{ getVehicleIcon($vt->slug) }}</span>
                                        <span class="text-xs text-black/60 dark:text-white/60 transition-colors font-semibold">{{ $vt->name }}</span>
                                    </div>
                                    <span class="text-base font-display font-bold text-black dark:text-white transition-colors">
                                        @if($onlinePaymentsActive)
                                            ${{ number_format($srv->getPriceForVehicleType($vt->id), 0, ',', '.') }}
                                        @else
                                            Cotizar
                                        @endif
                                    </span>
                                </div>
                            @endforeach
                        </div>

                        <div class="flex-grow">
                            <div class="text-xs font-bold text-black/40 dark:text-white/30 uppercase tracking-widest mb-4 border-b border-black/5 dark:border-white/5 pb-2 transition-colors">
                                Incluye Cobertura
                            </div>
                            <ul class="space-y-3 mb-10">
                                @php
                                    $features = array_filter(array_map('trim', explode("\n", $srv->long_description)));
                                @endphp
                                @foreach($features as $feature)
                                    <li class="flex items-start gap-3 text-sm text-black/70 dark:text-white/60">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand mt-1 shrink-0"><polyline points="20 6 9 17 4 12"/></svg>
                                        <span class="transition-colors font-medium">{{ $feature }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <a 
                            href="/reserva?service={{ $srv->slug }}" 
                            class="w-full py-5 rounded-2xl font-bold transition-all duration-300 text-sm tracking-wider uppercase text-center {{ $srv->is_featured ? 'bg-brand text-white shadow-lg shadow-brand/30 hover:bg-brand-dark hover:scale-[1.02]' : 'bg-black/5 dark:bg-white/5 text-black dark:text-white hover:bg-black/10 dark:hover:bg-white/10 hover:border-brand/40 border border-black/10 dark:border-white/10' }}"
                        >
                            Agendar Turno
                        </a>
                    </div>
                @endforeach
            </div>
HTML;

$pattern = '/@php\s+if \(\!function_exists\(\'getVehicleIcon\'\)\).*?<\/div>\s*@endforeach\s*<\/div>/s';
$content = preg_replace($pattern, $newGrid, $content);

file_put_contents('c:/laragon/www/detailing-laravel/resources/views/sellado-ceramico.blade.php', $content);
echo "Updated sellado-ceramico.blade.php\n";
