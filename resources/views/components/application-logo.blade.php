@if(isset($shopProfile) && $shopProfile->logo)
    <img src="{{ asset($shopProfile->logo) }}" alt="{{ $shopProfile->business_name }}" {{ $attributes->merge(['class' => 'object-contain']) }}>
@else
    <img src="{{ asset('assets/logos/main-logo.png') }}" alt="Logo" {{ $attributes->merge(['class' => 'object-contain']) }}>
@endif
