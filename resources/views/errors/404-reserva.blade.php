@extends('layouts.public')

@section('title', 'Reserva No Encontrada | High Contrast Detailing Center')
@section('meta_robots', 'noindex, nofollow')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center px-4 py-20 relative overflow-hidden">
    <div class="max-w-md w-full text-center relative z-10">
        {{-- Icon --}}
        <div class="w-20 h-20 rounded-3xl bg-brand/10 border border-brand/20 flex items-center justify-center mx-auto mb-6 text-brand shadow-xl backdrop-blur-xl">
            <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 4h.01" />
            </svg>
        </div>

        {{-- Heading & Message --}}
        <h1 class="font-display text-3xl font-extrabold text-black dark:text-white mb-3">
            Reserva No Encontrada
        </h1>
        <p class="text-black/60 dark:text-white/60 text-sm leading-relaxed mb-6">
            No se encontró ninguna reserva asociada al código <code class="px-2 py-1 rounded bg-black/5 dark:bg-white/10 text-brand font-mono font-bold">{{ $publicId }}</code>.
        </p>

        <div class="p-4 rounded-2xl bg-black/5 dark:bg-white/5 border border-black/10 dark:border-white/10 text-xs text-black/50 dark:text-white/40 mb-8 text-left space-y-1">
            <p><strong>Sugerencias:</strong></p>
            <ul class="list-disc list-inside space-y-1">
                <li>Verifica que el enlace enviado a tu correo o WhatsApp sea el correcto.</li>
                <li>Si crees que se trata de un error, contáctanos directamente.</li>
            </ul>
        </div>

        {{-- Action Buttons --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
            <a href="/reserva" 
               class="w-full sm:w-auto px-6 py-3.5 rounded-full bg-brand text-white font-bold text-sm shadow-lg shadow-brand/30 hover:bg-brand-dark transition-all duration-300">
                Cotizar Nueva Reserva
            </a>
            <a href="/" 
               class="w-full sm:w-auto px-6 py-3.5 rounded-full bg-black/5 dark:bg-white/10 text-black dark:text-white font-semibold text-sm hover:bg-black/10 dark:hover:bg-white/20 transition-all duration-300">
                Volver al Inicio
            </a>
        </div>
    </div>
</div>
@endsection
