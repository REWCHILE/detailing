@extends('layouts.admin')

@section('title', 'Servicios Adicionales (Extras) | High Contrast Detailing')
@section('title_section', 'Extras')

@section('content')
@php
    function formatCLP($amount) {
        return '$' . number_format($amount, 0, ',', '.');
    }
@endphp

<div x-data="{ filterService: '' }" class="space-y-6">
    <!-- Top actions -->
    <div class="flex justify-between items-center">
        <p class="text-sm text-black/50 dark:text-white/40 hidden md:block">Catalogo de extras adicionales configurables en el cotizador.</p>
        
        <div class="flex items-center gap-4 w-full md:w-auto">
            <!-- Filter by Service -->
            <div class="relative flex-1 md:w-64">
                <select x-model="filterService" class="w-full appearance-none rounded-xl border border-black/10 dark:border-white/10 bg-white dark:bg-surface/50 px-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand shadow-sm">
                    <option value="">Todos los servicios</option>
                    @foreach($services as $srv)
                        <option value="{{ $srv->id }}">{{ $srv->name }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-black/50 dark:text-white/50">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
            </div>

            <a href="{{ route('admin.extras.create') }}" class="shrink-0 rounded-xl bg-brand hover:bg-brand-dark text-white px-4 py-2.5 text-sm font-semibold shadow-md transition-all">
                + Nuevo Extra
            </a>
        </div>
    </div>

    <!-- Extras list -->
    <div class="rounded-2xl bg-white dark:bg-surface/20 border border-black/5 dark:border-white/5 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-black/5 dark:border-white/5 bg-gray-50 dark:bg-surface/10">
                        <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4">Orden</th>
                        <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4">Servicio Extra</th>
                        <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4">Precio</th>
                        <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4">Duración</th>
                        <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4">Estado</th>
                        <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-black/5 dark:divide-white/5">
                    @forelse($extras as $ex)
                        <tr x-show="filterService === '' || {{ json_encode($ex->services->pluck('id')) }}.includes(filterService)" class="hover:bg-black/[0.01] dark:hover:bg-white/[0.01] transition-colors">
                            <td class="px-6 py-4 font-bold text-sm text-black/60 dark:text-white/50">
                                #{{ $ex->display_order }}
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-black dark:text-white text-sm font-semibold">
                                    {{ $ex->name }}
                                </p>
                                <p class="text-black/40 dark:text-white/30 text-xs line-clamp-1">
                                    {{ $ex->description }}
                                </p>
                            </td>
                            <td class="px-6 py-4 font-semibold text-black/85 dark:text-white/85 text-sm">
                                {{ formatCLP($ex->price) }}
                            </td>
                            <td class="px-6 py-4 text-black/70 dark:text-white/60 text-sm">
                                {{ $ex->duration_minutes }} min
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-semibold border {{ $ex->is_active ? 'bg-green-500/10 border-green-500/20 text-green-600 dark:text-green-400' : 'bg-red-500/10 border-red-500/20 text-red-600 dark:text-red-400' }}">
                                    {{ $ex->is_active ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('admin.extras.edit', $ex->id) }}" class="text-xs text-blue-600 dark:text-blue-400 font-bold hover:underline">
                                    Editar
                                </a>
                                <form method="POST" action="/admin/extras/{{ $ex->id }}" class="inline-block" onsubmit="return confirm('¿Seguro que deseas eliminar este extra?')">
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
                            <td colSpan="6" class="px-6 py-12 text-center text-sm text-black/40 dark:text-white/40">
                                No hay extras configurados todavía.
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
