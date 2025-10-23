@props([
    'variant' => 'default',
    'padding' => 'md',
    'shadow' => 'md',
    'rounded' => 'lg',
    'hover' => false
])

@php
$baseClasses = 'bg-white border border-gray-200 transition-all duration-200';
$variants = [
    'default' => '',
    'featured' => 'border-2 border-accent',
    'outlined' => 'border-2 border-primary',
    'elevated' => 'border-0'
];
$paddings = [
    'none' => 'p-0',
    'sm' => 'p-4',
    'md' => 'p-6',
    'lg' => 'p-8',
    'xl' => 'p-10'
];
$shadows = [
    'none' => 'shadow-none',
    'sm' => 'shadow-sm',
    'md' => 'shadow-md',
    'lg' => 'shadow-lg',
    'xl' => 'shadow-xl'
];
$rounded = [
    'none' => 'rounded-none',
    'sm' => 'rounded-sm',
    'md' => 'rounded-md',
    'lg' => 'rounded-lg',
    'xl' => 'rounded-xl',
    '2xl' => 'rounded-2xl'
];
$hover = $hover ? 'hover:shadow-lg hover:-translate-y-1' : '';
$classes = $baseClasses . ' ' . $variants[$variant] . ' ' . $paddings[$padding] . ' ' . $shadows[$shadow] . ' ' . $rounded[$rounded] . ' ' . $hover;
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>
