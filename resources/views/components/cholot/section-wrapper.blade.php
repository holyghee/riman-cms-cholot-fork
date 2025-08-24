@props([
    'background' => 'white', // 'white', 'off-white', 'dark'
    'containerClass' => 'cholot-container',
    'paddingY' => 'large' // 'small', 'medium', 'large'
])

@php
$bgClass = match($background) {
    'off-white' => 'cholot-section-off-white',
    'dark' => 'cholot-section-dark',
    default => 'cholot-section-white'
};

$paddingClass = match($paddingY) {
    'small' => 'py-16',
    'medium' => 'py-24', 
    'large' => '',
    default => ''
};
@endphp

<!-- Cholot Section Wrapper - AUTHENTIC WordPress Theme Style -->
<section class="{{ $bgClass }} {{ $paddingClass }}" style="
    @if($background === 'white')
        background: var(--pure-white);
    @elseif($background === 'off-white') 
        background: var(--off-white);
    @elseif($background === 'dark')
        background: var(--dark-charcoal);
        color: var(--pure-white);
    @endif
    padding-top: {{ $paddingY === 'large' ? 'var(--space-4xl)' : 'inherit' }};
    padding-bottom: {{ $paddingY === 'large' ? 'var(--space-4xl)' : 'inherit' }};
">
    <div class="{{ $containerClass }}">
        {{ $slot }}
    </div>
</section>

<!-- Responsive padding adjustments -->
<style>
@media (max-width: 768px) {
    .cholot-section-white,
    .cholot-section-off-white,
    .cholot-section-dark {
        padding-top: var(--space-3xl) !important;
        padding-bottom: var(--space-3xl) !important;
    }
    
    .py-24 {
        padding-top: var(--space-2xl) !important;
        padding-bottom: var(--space-2xl) !important;
    }
    
    .py-16 {
        padding-top: var(--space-xl) !important;
        padding-bottom: var(--space-xl) !important;
    }
}
</style>