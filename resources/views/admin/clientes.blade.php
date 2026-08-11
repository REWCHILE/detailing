@extends('layouts.admin')

@section('title', 'Clientes | High Contrast Detailing')
@section('title_section', 'Clientes')

@section('content')
<div class="space-y-6">
    <!-- Filter Toolbar -->
    <div class="rounded-2xl bg-white dark:bg-surface/30 border border-black/5 dark:border-white/5 p-4 shadow-sm backdrop-blur-xl">
        <form method="GET" action="{{ route('admin.clientes') }}" class="flex flex-col sm:flex-row gap-4 items-center">
            <!-- Search bar -->
            <div class="relative flex-1 w-full">
                <input type="text" name="search" value="{{ $search }}" placeholder="Buscar por nombre, correo, teléfono..." class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-surface/50 pl-10 pr-4 py-2.5 text-sm text-black dark:text-white outline-none focus:border-brand">
                <div class="absolute left-3 top-3.5 text-black/40 dark:text-white/40">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex items-center gap-3 w-full sm:w-auto">
                <button type="submit" class="flex-1 sm:flex-initial rounded-xl bg-brand hover:bg-brand-dark text-white px-8 py-2.5 text-sm font-semibold shadow-md transition-all">
                    Buscar
                </button>
                <a href="{{ route('admin.clientes') }}" class="flex-1 sm:flex-initial text-center rounded-xl border border-black/10 dark:border-white/10 text-black/75 dark:text-white/75 px-8 py-2.5 text-sm font-semibold hover:bg-black/5 dark:hover:bg-white/5 transition-all">
                    Limpiar
                </a>
            </div>
        </form>
    </div>

    <!-- Clients Table Card -->
    <div class="rounded-2xl bg-white dark:bg-surface/20 border border-black/5 dark:border-white/5 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-black/5 dark:border-white/5 bg-gray-50 dark:bg-surface/10">
                        <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4">Cliente</th>
                        <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4">Contacto</th>
                        <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4 text-center">Reservas Realizadas</th>
                        <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4">Registrado el</th>
                        <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-black/5 dark:divide-white/5">
                    @forelse($customers as $customer)
                        <tr class="hover:bg-black/[0.01] dark:hover:bg-white/[0.01] transition-colors">
                            <td class="px-6 py-4">
                                <p class="text-black dark:text-white text-sm font-semibold">
                                    {{ $customer->first_name }} {{ $customer->last_name }}
                                </p>
                                <p class="text-black/40 dark:text-white/30 text-xs">
                                    ID: {{ $customer->id }}
                                </p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-black/80 dark:text-white/70 text-sm font-medium">
                                    {{ $customer->email ?: 'Sin correo' }}
                                </p>
                                <p class="text-black/40 dark:text-white/30 text-xs">
                                    Tel: {{ $customer->phone }}
                                </p>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center justify-center min-w-8 h-8 rounded-full bg-brand/10 text-brand font-bold text-sm">
                                    {{ $customer->bookings_count }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-black/70 dark:text-white/60 text-sm">
                                {{ $customer->created_at ? $customer->created_at->translatedFormat('d M Y') : 'S/I' }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="/admin/citas?search={{ urlencode($customer->first_name . ' ' . $customer->last_name) }}" class="inline-flex items-center gap-1 text-xs text-brand font-bold hover:text-brand-light transition-colors">
                                    Ver Citas
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7M5 5l7 7-7 7"/></svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colSpan="5" class="px-6 py-12 text-center text-sm text-black/40 dark:text-white/40">
                                No se encontraron clientes que coincidan con la búsqueda.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination links -->
        <div class="px-6 py-4 bg-gray-50 dark:bg-surface/10 border-t border-black/5 dark:border-white/5">
            {{ $customers->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection
