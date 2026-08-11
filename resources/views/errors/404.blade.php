@extends('layouts.public')

@section('title', 'Página No Encontrada | High Contrast Detailing Center')
@section('meta_robots', 'noindex, nofollow')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center px-4 py-20 relative overflow-hidden">
    <div class="max-w-md w-full text-center relative z-10">
        {{-- Badge 404 --}}
        <div class="inline-block px-4 py-1.5 rounded-full bg-brand/10 border border-brand/20 text-brand text-xs font-bold uppercase tracking-widest mb-6">
            Error 404
        </div>

        {{-- Heading & Message --}}
        <h1 class="font-display text-4xl sm:text-5xl font-extrabold text-black dark:text-white mb-4">
            Página No Encontrada
        </h1>
        <p class="text-black/60 dark:text-white/60 text-base leading-relaxed mb-8">
            Lo sentimos, la página que estás buscando no existe o ha sido movida a otra ubicación.
        </p>

        {{-- Action Buttons --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
            <a href="/" 
               class="w-full sm:w-auto px-8 py-3.5 rounded-full bg-brand text-white font-bold text-sm shadow-lg shadow-brand/30 hover:bg-brand-dark transition-all duration-300">
                Volver al Inicio
            </a>
            <a href="/reserva" 
               class="w-full sm:w-auto px-8 py-3.5 rounded-full bg-black/5 dark:bg-white/10 text-black dark:text-white font-semibold text-sm hover:bg-black/10 dark:hover:bg-white/20 transition-all duration-300">
                Ir al Cotizador
            </a>
        </div>
    </div>
</div>
@endsection
