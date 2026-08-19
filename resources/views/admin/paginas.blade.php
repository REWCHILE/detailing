@extends('layouts.admin')

@section('title', 'Páginas & Analíticas | Admin')
@section('title_section', 'Páginas & Analíticas')

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
<style>
    #traffic-map { height: 420px; border-radius: 1rem; z-index: 1; }
    .period-btn { transition: all 0.2s; }
    .period-btn.active {
        background: var(--brand-color, #E3A008);
        color: #000;
        border-color: transparent;
    }
</style>
@endsection

@section('content')
<div class="space-y-8">

    {{-- Period Filter --}}
    <div class="flex items-center gap-2 flex-wrap">
        <span class="text-sm text-black/50 dark:text-white/40 mr-2 font-medium">Período:</span>
        @foreach(['today' => 'Hoy', 'yesterday' => 'Ayer', 'week' => 'Semana', 'month' => 'Mes', 'year' => 'Año', 'all' => 'Todo'] as $key => $label)
            <a href="?period={{ $key }}"
               class="period-btn px-4 py-2 rounded-xl text-sm font-semibold border transition-all duration-200
                      {{ $period === $key ? 'active bg-brand text-black border-brand shadow-sm font-bold' : 'border-black/10 dark:border-white/10 text-black/60 dark:text-white/50 hover:bg-black/5 dark:hover:bg-white/5' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>

    {{-- Summary Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        {{-- Card: Period Visits --}}
        <div class="p-6 rounded-2xl bg-white dark:bg-surface/30 border border-black/5 dark:border-white/5 shadow-sm transition-all hover:-translate-y-1 hover:shadow-md">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-xl bg-brand/10 flex items-center justify-center text-brand">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </div>
            </div>
            <p class="text-black/40 dark:text-white/40 text-sm mb-1">Visitas ({{ $currentPeriodLabel }})</p>
            <p class="font-display text-3xl font-bold text-black dark:text-white">{{ number_format($totalPeriod) }}</p>
        </div>

        {{-- Card: Unique Visitors --}}
        <div class="p-6 rounded-2xl bg-white dark:bg-surface/30 border border-black/5 dark:border-white/5 shadow-sm transition-all hover:-translate-y-1 hover:shadow-md">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-xl bg-blue-500/10 flex items-center justify-center text-blue-500 dark:text-blue-400">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
            </div>
            <p class="text-black/40 dark:text-white/40 text-sm mb-1">Visitantes únicos ({{ $currentPeriodLabel }})</p>
            <p class="font-display text-3xl font-bold text-black dark:text-white">{{ number_format($uniquePeriod) }}</p>
        </div>

        {{-- Card: Top page --}}
        <div class="p-6 rounded-2xl bg-white dark:bg-surface/30 border border-black/5 dark:border-white/5 shadow-sm transition-all hover:-translate-y-1 hover:shadow-md">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-xl bg-purple-500/10 flex items-center justify-center text-purple-500 dark:text-purple-400">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                </div>
            </div>
            <p class="text-black/40 dark:text-white/40 text-sm mb-1">Página top ({{ $currentPeriodLabel }})</p>
            <p class="font-display text-lg font-bold text-black dark:text-white truncate">{{ $topPage->page_title ?? 'Sin datos' }}</p>
            @if($topPage)
                <p class="text-brand text-sm font-semibold">{{ number_format($topPage->visit_count) }} visitas</p>
            @endif
        </div>

        {{-- Card: Total All --}}
        <div class="p-6 rounded-2xl bg-white dark:bg-surface/30 border border-black/5 dark:border-white/5 shadow-sm transition-all hover:-translate-y-1 hover:shadow-md">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-xl bg-green-500/10 flex items-center justify-center text-green-500 dark:text-green-400">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                </div>
            </div>
            <p class="text-black/40 dark:text-white/40 text-sm mb-1">Total histórico</p>
            <p class="font-display text-3xl font-bold text-black dark:text-white">{{ number_format($totalAll) }}</p>
        </div>
    </div>

    {{-- Chart --}}
    <div class="rounded-2xl bg-white dark:bg-surface/30 border border-black/5 dark:border-white/5 shadow-sm p-6">
        <h2 class="font-display text-lg font-bold text-black dark:text-white mb-4">{{ $chartTitle }}</h2>
        <div class="relative" style="height: 260px;">
            <canvas id="visits-chart" width="100%" height="260"></canvas>
        </div>
    </div>

    {{-- Pages Table --}}
    <div>
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-display text-lg font-bold text-black dark:text-white">Todas las páginas</h2>
            <span class="text-xs text-black/50 dark:text-white/40 font-medium">Ordenado por visitas en {{ $currentPeriodLabel }}</span>
        </div>
        <div class="rounded-2xl bg-white dark:bg-surface/20 border border-black/5 dark:border-white/5 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-black/5 dark:border-white/5 bg-gray-50 dark:bg-surface/10">
                            <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4">Página</th>
                            <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4">URL</th>
                            <th class="text-xs font-bold text-brand px-6 py-4 text-center bg-brand/5">Visitas ({{ $currentPeriodLabel }})</th>
                            <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4 text-center">Hoy</th>
                            <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4 text-center">Semana</th>
                            <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4 text-center">Mes</th>
                            <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4 text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-black/5 dark:divide-white/5">
                        @forelse($pages as $page)
                            <tr class="hover:bg-black/[0.01] dark:hover:bg-white/[0.01] transition-colors">
                                <td class="px-6 py-4">
                                    <p class="text-black dark:text-white text-sm font-semibold">{{ $page->page_title }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ $page->page_path }}" target="_blank"
                                       class="text-brand text-sm font-medium hover:underline inline-flex items-center gap-1">
                                        {{ $page->page_path }}
                                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-center bg-brand/5">
                                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold border bg-brand/20 text-black dark:text-white border-brand/40">
                                        {{ number_format($page->period_visits) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="text-black/80 dark:text-white/70 text-sm font-semibold">{{ number_format($page->today_visits) }}</span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="text-black/80 dark:text-white/70 text-sm font-semibold">{{ number_format($page->week_visits) }}</span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="text-black/80 dark:text-white/70 text-sm font-semibold">{{ number_format($page->month_visits) }}</span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="text-black/60 dark:text-white/50 text-sm font-medium">
                                        {{ number_format($page->total_visits) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-sm text-black/40 dark:text-white/40">
                                    Aún no hay visitas registradas para el período seleccionado.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Traffic Map --}}
    <div class="rounded-2xl bg-white dark:bg-surface/30 border border-black/5 dark:border-white/5 shadow-sm p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-display text-lg font-bold text-black dark:text-white">🗺️ Mapa de tráfico</h2>
            <span class="text-xs text-black/40 dark:text-white/30">{{ $mapLocations->count() }} ubicaciones</span>
        </div>
        <div id="traffic-map"></div>
        @if($mapLocations->isEmpty())
            <p class="text-center text-sm text-black/40 dark:text-white/40 mt-4">
                Sin datos geográficos para el período seleccionado.
            </p>
        @endif
    </div>

    {{-- Top Referrers --}}
    @if($topReferrers->isNotEmpty())
    <div>
        <h2 class="font-display text-lg font-bold text-black dark:text-white mb-4">🔗 Principales fuentes de tráfico</h2>
        <div class="rounded-2xl bg-white dark:bg-surface/20 border border-black/5 dark:border-white/5 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-black/5 dark:border-white/5 bg-gray-50 dark:bg-surface/10">
                            <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4">Fuente</th>
                            <th class="text-xs text-black/50 dark:text-white/40 font-semibold px-6 py-4 text-right">Visitas</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-black/5 dark:divide-white/5">
                        @foreach($topReferrers as $ref)
                            <tr class="hover:bg-black/[0.01] dark:hover:bg-white/[0.01] transition-colors">
                                <td class="px-6 py-3">
                                    <span class="text-black/80 dark:text-white/70 text-sm font-medium">{{ $ref->referer_domain }}</span>
                                </td>
                                <td class="px-6 py-3 text-right">
                                    <span class="text-brand text-sm font-bold">{{ number_format($ref->ref_count) }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

    {{-- Stats footer --}}
    <p class="text-center text-xs text-black/30 dark:text-white/20 pt-4">
        Total acumulado: {{ number_format($totalAll) }} visitas registradas
    </p>

    {{-- ============================== --}}
    {{-- SEO MANAGEMENT SECTION --}}
    {{-- ============================== --}}
    <div class="mt-12">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 rounded-xl bg-emerald-500/10 flex items-center justify-center text-emerald-500">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <div>
                <h2 class="font-display text-lg font-bold text-black dark:text-white">SEO de Páginas</h2>
                <p class="text-sm text-black/40 dark:text-white/40">Administra el título y descripción que aparecen en Google para cada página</p>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-700 dark:text-emerald-400 text-sm font-medium flex items-center gap-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.paginas.seo') }}" method="POST" id="seo-form">
            @csrf
            <div class="space-y-4">
                @foreach($seoPages as $seoPage)
                    <div class="rounded-2xl bg-white dark:bg-surface/30 border border-black/5 dark:border-white/5 shadow-sm overflow-hidden transition-all hover:shadow-md group"
                         x-data="{ expanded: false }">
                        {{-- Header row --}}
                        <button type="button" @click="expanded = !expanded"
                                class="w-full flex items-center justify-between px-6 py-4 cursor-pointer select-none">
                            <div class="flex items-center gap-4">
                                <div class="w-8 h-8 rounded-lg bg-brand/10 flex items-center justify-center text-brand text-xs font-bold">
                                    {{ $loop->iteration }}
                                </div>
                                <div class="text-left">
                                    <p class="text-sm font-bold text-black dark:text-white">{{ $seoPage->page_name }}</p>
                                    <p class="text-xs text-black/40 dark:text-white/30 font-mono">{{ $seoPage->page_path }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                {{-- Status badge --}}
                                @php
                                    $titleLen = mb_strlen($seoPage->seo_title ?? '');
                                    $descLen = mb_strlen($seoPage->seo_description ?? '');
                                    $titleOk = $titleLen > 0 && $titleLen <= 60;
                                    $descOk = $descLen > 0 && $descLen <= 160;
                                @endphp
                                @if($titleOk && $descOk)
                                    <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20">
                                        ✓ Optimizado
                                    </span>
                                @else
                                    <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/20">
                                        ⚠ Revisar
                                    </span>
                                @endif
                                {{-- Chevron --}}
                                <svg class="w-5 h-5 text-black/30 dark:text-white/30 transition-transform duration-300" :class="expanded ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                        </button>

                        {{-- Expandable content --}}
                        <div x-show="expanded" x-collapse x-cloak class="px-6 pb-6 border-t border-black/5 dark:border-white/5">
                            <div class="pt-5 space-y-5">
                                {{-- SEO Title --}}
                                <div x-data="{ charCount: {{ mb_strlen($seoPage->seo_title ?? '') }} }">
                                    <div class="flex items-center justify-between mb-2">
                                        <label class="text-sm font-semibold text-black/70 dark:text-white/60">
                                            <svg class="w-4 h-4 inline-block mr-1 -mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/></svg>
                                            Título SEO
                                        </label>
                                        <span class="text-xs font-mono"
                                              :class="charCount === 0 ? 'text-black/30 dark:text-white/20' : (charCount <= 60 ? 'text-emerald-500' : 'text-red-500')">
                                            <span x-text="charCount"></span>/60
                                        </span>
                                    </div>
                                    <input type="text"
                                           name="seo[{{ $seoPage->id }}][seo_title]"
                                           value="{{ old('seo.' . $seoPage->id . '.seo_title', $seoPage->seo_title) }}"
                                           @input="charCount = $el.value.length"
                                           placeholder="Título que aparecerá en Google..."
                                           class="w-full px-4 py-3 rounded-xl border border-black/10 dark:border-white/10 bg-gray-50 dark:bg-surface/20 text-black dark:text-white text-sm font-medium placeholder:text-black/30 dark:placeholder:text-white/20 focus:outline-none focus:ring-2 focus:ring-brand/40 focus:border-brand transition-all">
                                    {{-- Progress bar --}}
                                    <div class="mt-2 h-1 rounded-full bg-black/5 dark:bg-white/5 overflow-hidden">
                                        <div class="h-full rounded-full transition-all duration-300"
                                             :style="'width: ' + Math.min(100, (charCount / 60) * 100) + '%'"
                                             :class="charCount === 0 ? 'bg-black/10 dark:bg-white/10' : (charCount <= 60 ? 'bg-emerald-500' : 'bg-red-500')"></div>
                                    </div>
                                </div>

                                {{-- SEO Description --}}
                                <div x-data="{ charCount: {{ mb_strlen($seoPage->seo_description ?? '') }} }">
                                    <div class="flex items-center justify-between mb-2">
                                        <label class="text-sm font-semibold text-black/70 dark:text-white/60">
                                            <svg class="w-4 h-4 inline-block mr-1 -mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7"/></svg>
                                            Meta Descripción
                                        </label>
                                        <span class="text-xs font-mono"
                                              :class="charCount === 0 ? 'text-black/30 dark:text-white/20' : (charCount <= 160 ? 'text-emerald-500' : 'text-red-500')">
                                            <span x-text="charCount"></span>/160
                                        </span>
                                    </div>
                                    <textarea name="seo[{{ $seoPage->id }}][seo_description]"
                                              @input="charCount = $el.value.length"
                                              rows="3"
                                              placeholder="Descripción que aparecerá debajo del título en Google..."
                                              class="w-full px-4 py-3 rounded-xl border border-black/10 dark:border-white/10 bg-gray-50 dark:bg-surface/20 text-black dark:text-white text-sm placeholder:text-black/30 dark:placeholder:text-white/20 focus:outline-none focus:ring-2 focus:ring-brand/40 focus:border-brand transition-all resize-none">{{ old('seo.' . $seoPage->id . '.seo_description', $seoPage->seo_description) }}</textarea>
                                    {{-- Progress bar --}}
                                    <div class="mt-2 h-1 rounded-full bg-black/5 dark:bg-white/5 overflow-hidden">
                                        <div class="h-full rounded-full transition-all duration-300"
                                             :style="'width: ' + Math.min(100, (charCount / 160) * 100) + '%'"
                                             :class="charCount === 0 ? 'bg-black/10 dark:bg-white/10' : (charCount <= 160 ? 'bg-emerald-500' : 'bg-red-500')"></div>
                                    </div>
                                </div>

                                {{-- Google Preview --}}
                                <div class="p-4 rounded-xl bg-gray-50 dark:bg-surface/10 border border-black/5 dark:border-white/5">
                                    <p class="text-xs text-black/40 dark:text-white/30 mb-2 font-semibold uppercase tracking-wider">Vista previa en Google</p>
                                    <div class="space-y-1" x-data="{ 
                                        titleEl: null, descEl: null,
                                        init() {
                                            this.titleEl = this.$el.closest('[x-show]').querySelector('input[name*=seo_title]');
                                            this.descEl = this.$el.closest('[x-show]').querySelector('textarea[name*=seo_description]');
                                        }
                                    }">
                                        <p class="text-[#1a0dab] dark:text-blue-400 text-base font-medium truncate cursor-pointer hover:underline"
                                           x-text="(titleEl && titleEl.value) ? titleEl.value : '{{ addslashes($seoPage->seo_title ?? 'Sin título') }}'"
                                           x-effect="if(titleEl) $el.textContent = titleEl.value || '{{ addslashes($seoPage->seo_title ?? 'Sin título') }}'">
                                            {{ $seoPage->seo_title ?? 'Sin título' }}
                                        </p>
                                        <p class="text-emerald-700 dark:text-emerald-500 text-xs">{{ url($seoPage->page_path) }}</p>
                                        <p class="text-sm text-black/60 dark:text-white/40 line-clamp-2"
                                           x-text="(descEl && descEl.value) ? descEl.value : '{{ addslashes($seoPage->seo_description ?? 'Sin descripción') }}'"
                                           x-effect="if(descEl) $el.textContent = descEl.value || '{{ addslashes($seoPage->seo_description ?? 'Sin descripción') }}'">
                                            {{ $seoPage->seo_description ?? 'Sin descripción' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Save button --}}
            <div class="mt-6 flex justify-end">
                <button type="submit"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-brand text-black font-bold text-sm shadow-lg shadow-brand/20 hover:shadow-xl hover:shadow-brand/30 hover:-translate-y-0.5 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    Guardar SEO
                </button>
            </div>
        </form>
    </div>

</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
<script>
document.addEventListener('DOMContentLoaded', function() {

    // ===========================
    // INTERACTIVE BAR CHART (Chart.js)
    // ===========================
    const canvas = document.getElementById('visits-chart');
    if (canvas) {
        const ctx = canvas.getContext('2d');
        const labels = @json($chartLabels);
        const values = @json($chartValues);

        const isDark = document.documentElement.classList.contains('dark');
        const textColor = isDark ? 'rgba(255, 255, 255, 0.5)' : 'rgba(0, 0, 0, 0.5)';
        const gridColor = isDark ? 'rgba(255, 255, 255, 0.05)' : 'rgba(0, 0, 0, 0.05)';

        // Create sleek gradient fill
        const gradient = ctx.createLinearGradient(0, 0, 0, 260);
        gradient.addColorStop(0, '#E3A008');
        gradient.addColorStop(1, isDark ? 'rgba(227, 160, 8, 0.15)' : 'rgba(227, 160, 8, 0.35)');

        const hoverGradient = ctx.createLinearGradient(0, 0, 0, 260);
        hoverGradient.addColorStop(0, '#FB2C6B');
        hoverGradient.addColorStop(1, 'rgba(251, 44, 107, 0.4)');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Visitas',
                    data: values,
                    backgroundColor: gradient,
                    hoverBackgroundColor: hoverGradient,
                    borderColor: '#E3A008',
                    hoverBorderColor: '#FB2C6B',
                    borderWidth: 1,
                    borderRadius: 6,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 800,
                    easing: 'easeOutQuart'
                },
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: isDark ? 'rgba(20, 20, 20, 0.95)' : 'rgba(255, 255, 255, 0.95)',
                        titleColor: isDark ? '#ffffff' : '#000000',
                        bodyColor: '#E3A008',
                        borderColor: isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)',
                        borderWidth: 1,
                        padding: 12,
                        cornerRadius: 12,
                        titleFont: { family: 'Outfit, Inter, sans-serif', size: 13, weight: '700' },
                        bodyFont: { family: 'Inter, sans-serif', size: 14, weight: '700' },
                        displayColors: false,
                        callbacks: {
                            title: function(context) {
                                return context[0].label;
                            },
                            label: function(context) {
                                const val = context.raw || 0;
                                return `${val.toLocaleString()} ${val === 1 ? 'visitante único' : 'visitantes únicos'}`;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            color: textColor,
                            font: { family: 'Inter, sans-serif', size: 11 },
                            maxRotation: 0,
                            autoSkip: true,
                            maxTicksLimit: labels.length > 20 ? 10 : labels.length
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: gridColor,
                            drawBorder: false
                        },
                        ticks: {
                            color: textColor,
                            font: { family: 'Inter, sans-serif', size: 11 },
                            precision: 0,
                            stepSize: Math.ceil(Math.max(...values, 1) / 4) || 1
                        }
                    }
                }
            }
        });
    }

    // ===========================
    // LEAFLET MAP
    // ===========================
    const mapEl = document.getElementById('traffic-map');
    if (mapEl) {
        const locations = @json($mapLocations);

        // Dark-friendly tile layer
        const isDarkMap = document.documentElement.classList.contains('dark');
        const tileUrl = isDarkMap
            ? 'https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png'
            : 'https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png';

        const map = L.map('traffic-map', {
            scrollWheelZoom: false,
        }).setView([-33.45, -70.66], 6); // Centered on Santiago, Chile

        L.tileLayer(tileUrl, {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OSM</a> &copy; <a href="https://carto.com/">CARTO</a>',
            maxZoom: 18,
        }).addTo(map);

        if (locations.length > 0) {
            const maxVisits = Math.max(...locations.map(l => l.visit_count));
            const bounds = [];

            locations.forEach(loc => {
                if (!loc.latitude || !loc.longitude) return;

                const radius = Math.max(8, Math.min(40, (loc.visit_count / maxVisits) * 40));
                const marker = L.circleMarker([loc.latitude, loc.longitude], {
                    radius: radius,
                    fillColor: '#E3A008',
                    color: '#fff',
                    weight: 2,
                    opacity: 0.9,
                    fillOpacity: 0.65,
                });

                marker.bindPopup(`
                    <div style="font-family: Inter, sans-serif; min-width: 140px;">
                        <p style="font-weight: 700; font-size: 14px; margin: 0 0 4px;">${loc.city || 'Desconocida'}</p>
                        <p style="color: #888; font-size: 12px; margin: 0 0 6px;">${loc.region || ''}, ${loc.country || ''}</p>
                        <p style="font-weight: 800; font-size: 18px; color: #E3A008; margin: 0;">${loc.visit_count} <span style="font-size:12px;font-weight:500;color:#888;">visitas</span></p>
                    </div>
                `);

                marker.addTo(map);
                bounds.push([loc.latitude, loc.longitude]);
            });

            if (bounds.length > 1) {
                map.fitBounds(bounds, { padding: [30, 30] });
            } else if (bounds.length === 1) {
                map.setView(bounds[0], 10);
            }
        }
    }

});
</script>
@endsection
