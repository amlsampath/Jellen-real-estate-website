@props([
    'type' => 'text',
    'label' => null,
    'placeholder' => null,
    'required' => false,
    'disabled' => false,
    'error' => null,
    'help' => null,
    'icon' => null,
    'size' => 'md'
])

@php
$baseClasses = 'block w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors duration-200';
$sizes = [
    'sm' => 'px-3 py-2 text-sm',
    'md' => 'px-4 py-2 text-base',
    'lg' => 'px-4 py-3 text-lg'
];
$errorClasses = $error ? 'border-red-500 focus:ring-red-500 focus:border-red-500' : '';
$disabledClasses = $disabled ? 'bg-gray-100 cursor-not-allowed' : '';
$classes = $baseClasses . ' ' . $sizes[$size] . ' ' . $errorClasses . ' ' . $disabledClasses;
@endphp

<div class="space-y-2">
    @if($label)
        <label class="block text-sm font-medium text-primary">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <div class="relative">
        @if($icon)
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <span class="text-gray-400">
                    {!! $icon !!}
                </span>
            </div>
            <input 
                type="{{ $type }}" 
                {{ $attributes->merge(['class' => $classes . ' pl-10']) }}
                placeholder="{{ $placeholder }}"
                @if($required) required @endif
                @if($disabled) disabled @endif
            />
        @else
            <input 
                type="{{ $type }}" 
                {{ $attributes->merge(['class' => $classes]) }}
                placeholder="{{ $placeholder }}"
                @if($required) required @endif
                @if($disabled) disabled @endif
            />
        @endif
    </div>

    @if($error)
        <p class="text-sm text-red-600">{{ $error }}</p>
    @endif

    @if($help && !$error)
        <p class="text-sm text-gray-500">{{ $help }}</p>
    @endif
</div>
