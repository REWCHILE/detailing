@extends('layouts.admin')

@section('title', 'Servicios | High Contrast Detailing')
@section('title_section', 'Servicios')

@section('content')
@php
    function formatCLP($amount) {
        return '$' . number_format($amount, 0, ',', '.');
    }
@endphp

<div class="space-y-6">
    <!-- Top actions -->
    <div class="flex justify-between items-center">
        <p class="text-sm text-black/50 dark:text-white/40">Catalogo de servicios ofrecidos en el cotizador online.</p>
        <a href="{{ route('admin.servicios.create') }}" class="rounded-xl bg-brand hover:bg-brand-dark text-white px-4 py-2.5 text-sm font-semibold shadow-md transition-all">
            + Nuevo Servicio
        </a>
    </div>

    <!-- Category Order -->
    <div class="rounded-2xl bg-white dark:bg-surface/20 border border-black/5 dark:border-white/5 p-4 shadow-sm">
        <h3 class="text-sm font-bold text-black/70 dark:text-white/70 mb-3 uppercase tracking-wider text-[11px]">Orden de Categorías (Pestañas en Cotizador)</h3>
        <div class="flex gap-3 overflow-x-auto pb-2 scrollbar-none">
            @foreach($categoryOrder as $index => $cat)
                @php $detail = $categoryDetails[$cat] ?? ['label' => $cat, 'style' => 'color: #4b5563; background-color: #f3f4f6; border-color: #e5e7eb;']; @endphp
                <div class="flex items-center gap-2 px-4 py-2 rounded-xl border {{ $detail['style'] === '' ? 'border-black/10' : '' }} shrink-0" style="{{ $detail['style'] }}">
                    <span class="font-bold text-[11px] uppercase tracking-wide">{{ $detail['label'] }}</span>
                    <div class="flex gap-1.5 ml-3">
                        <form action="{{ route('admin.categorias.move-up', $cat) }}" method="POST">
                            @csrf
                            <button type="submit" class="text-current opacity-40 hover:opacity-100 transition-opacity disabled:opacity-10 disabled:cursor-not-allowed" {{ $index === 0 ? 'disabled' : '' }} title="Mover Izquierda">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                            </button>
                        </form>
                        <form action="{{ route('admin.categorias.move-down', $cat) }}" method="POST">
                            @csrf
                            <button type="submit" class="text-current opacity-40 hover:opacity-100 transition-opacity disabled:opacity-10 disabled:cursor-not-allowed" {{ $index === count($categoryOrder) - 1 ? 'disabled' : '' }} title="Mover Derecha">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Services list -->
    <div class="rounded-2xl bg-white dark:bg-surface/20 border border-black/5 dark:border-white/5 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-black/5 dark:border-white/5 bg-gray-50 dark:bg-surface/10">
                        <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4">Orden</th>
                        <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4">Servicio</th>
                        <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4">Categoría</th>
                        <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4">Precios por Vehículo</th>
                        <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4">Duración</th>
                        <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4">Estados</th>
                        <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-black/5 dark:divide-white/5">
                    @forelse($services as $srv)
                        <tr class="hover:bg-black/[0.01] dark:hover:bg-white/[0.01] transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <span class="font-bold text-sm text-black/60 dark:text-white/50 w-6 text-center">#{{ $srv->display_order }}</span>
                                    <div class="flex flex-col gap-0.5">
                                        <form action="{{ route('admin.servicios.move-up', $srv->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-black/30 hover:text-brand transition-colors p-0.5" title="Mover arriba">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m18 15-6-6-6 6"/></svg>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.servicios.move-down', $srv->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-black/30 hover:text-brand transition-colors p-0.5" title="Mover abajo">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-black dark:text-white text-sm font-semibold">
                                    {{ $srv->name }}
                                </p>
                                <p class="text-black/40 dark:text-white/30 text-xs line-clamp-1">
                                    {{ $srv->short_description }}
                                </p>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $categoryLabels = [
                                        'limpieza' => ['label' => 'Limpieza', 'color' => 'bg-blue-500/10 border-blue-500/20 text-blue-600 dark:text-blue-400'],
                                        'correccion' => ['label' => 'Corrección', 'color' => 'bg-amber-500/10 border-amber-500/20 text-amber-600 dark:text-amber-400'],
                                        'ceramico' => ['label' => 'Cerámico', 'color' => 'bg-emerald-500/10 border-emerald-500/20 text-emerald-600 dark:text-emerald-400'],
                                        'especiales' => ['label' => 'Especiales', 'color' => 'bg-purple-500/10 border-purple-500/20 text-purple-600 dark:text-purple-400'],
                                    ];
                                    $cat = $categoryLabels[$srv->category ?? 'especiales'] ?? $categoryLabels['especiales'];
                                @endphp
                                <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-semibold border {{ $cat['color'] }}">
                                    {{ $cat['label'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-xs font-semibold text-black/80 dark:text-white/80">
                                <div class="flex flex-wrap gap-2 max-w-sm">
                                    @foreach($vehicleTypes as $vt)
                                        @php
                                            $vtPrice = $srv->vehicleTypes->firstWhere('id', $vt->id);
                                        @endphp
                                        <span class="inline-flex items-center px-2 py-1 rounded-lg bg-black/[0.03] dark:bg-white/[0.03] border border-black/5 dark:border-white/5 text-[10px]">
                                            <span class="text-black/45 dark:text-white/40 mr-1 font-semibold">{{ $vt->name }}:</span>
                                            <span class="font-bold text-brand">{{ $vtPrice ? formatCLP($vtPrice->pivot->price) : '—' }}</span>
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-6 py-4 text-black/70 dark:text-white/60 text-sm">
                                {{ $srv->duration_minutes }} min
                            </td>
                            <td class="px-6 py-4 space-y-1">
                                <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-semibold border {{ $srv->is_active ? 'bg-green-500/10 border-green-500/20 text-green-600 dark:text-green-400' : 'bg-red-500/10 border-red-500/20 text-red-600 dark:text-red-400' }}">
                                    {{ $srv->is_active ? 'Activo' : 'Inactivo' }}
                                </span>
                                @if($srv->is_featured)
                                    <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-semibold border bg-brand/10 border-brand/20 text-brand">
                                        Destacado
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('admin.servicios.edit', $srv->id) }}" class="text-xs text-blue-600 dark:text-blue-400 font-bold hover:underline">
                                    Editar
                                </a>
                                <form method="POST" action="/admin/servicios/{{ $srv->id }}" class="inline-block" onsubmit="return confirm('¿Seguro que deseas eliminar este servicio?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs text-red-600 dark:text-red-400 font-bold hover:underline">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colSpan="7" class="px-6 py-12 text-center text-sm text-black/40 dark:text-white/40">
                                No hay servicios configurados todavía.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    </div>
</div>
@endsection
