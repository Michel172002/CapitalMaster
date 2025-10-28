@props([
    'name' => '',
    'id' => null,
    'value' => '1',
    'checked' => false,
    'disabled' => false,
    'required' => false,
    'label' => '',
    'size' => 'md', // sm, md, lg
    'color' => 'primary', // primary, secondary, success, warning, error
    'class' => '',
    'labelClass' => '',
    'inputClass' => ''
])

@php
    $id = $id ?? $name;
    $sizeClasses = [
        'sm' => 'w-3 h-3',
        'md' => 'w-4 h-4',
        'lg' => 'w-5 h-5'
    ];
    
    $colorClasses = [
        'primary' => 'text-blue-600 focus:ring-blue-500',
        'secondary' => 'text-gray-600 focus:ring-gray-500',
        'success' => 'text-green-600 focus:ring-green-500',
        'warning' => 'text-yellow-600 focus:ring-yellow-500',
        'error' => 'text-red-600 focus:ring-red-500'
    ];
    
    $sizeLabelClasses = [
        'sm' => 'text-sm',
        'md' => 'text-base',
        'lg' => 'text-lg'
    ];
@endphp

<div class="flex items-start {{ $class }}">
    <div class="flex items-center h-5">
        <input 
            type="checkbox" 
            name="{{ $name }}"
            id="{{ $id }}"
            value="{{ $value }}"
            {{ $checked ? 'checked' : '' }}
            {{ $disabled ? 'disabled' : '' }}
            {{ $required ? 'required' : '' }}
            class="rounded border-gray-300 {{ $sizeClasses[$size] }} {{ $colorClasses[$color] }} focus:ring-2 {{ $inputClass }}"
        />
    </div>
    
    @if($label)
        <div class="ml-3 text-sm">
            @if($label)
                <label for="{{ $id }}" class="font-medium text-xs text-gray-700 {{ $sizeLabelClasses[$size] }} {{ $labelClass }}">
                    {{ $label }}
                    @if($required)
                        <span class="text-red-500">*</span>
                    @endif
                </label>
            @endif
        </div>
    @endif
</div>