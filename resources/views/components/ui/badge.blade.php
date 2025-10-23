@props([
    'variant' => 'default',
    'size' => 'md',
    'rounded' => 'full'
])

@php
$baseClasses = 'inline-flex items-center font-medium';
$variants = [
    'default' => 'bg-gray-100 text-gray-800',
    'primary' => 'bg-primary text-white',
    'secondary' => 'bg-accent text-primary',
    'success' => 'bg-green-100 text-green-800',
    'warning' => 'bg-yellow-100 text-yellow-800',
    'danger' => 'bg-red-100 text-red-800',
    'info' => 'bg-blue-100 text-blue-800'
];
$sizes = [
    'sm' => 'px-2 py-1 text-xs',
    'md' => 'px-2.5 py-1.5 text-sm',
    'lg' => 'px-3 py-2 text-base'
];
$rounded = [
    'none' => 'rounded-none',
    'sm' => 'rounded-sm',
    'md' => 'rounded-md',
    'lg' => 'rounded-lg',
    'full' => 'rounded-full'
];
$classes = $baseClasses . ' ' . $variants[$variant] . ' ' . $sizes[$size] . ' ' . $rounded[$rounded];
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>
