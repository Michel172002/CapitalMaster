@props([
    'type' => 'button',
    'label' => '',
    'width' => 'fit',
    'color' => 'primaria',
])

<button 
    type="{{ $type }}" 
    class="w-{{ $width }} bg-{{ $color }} text-white px-4 py-2 rounded-md font-semibold text-sm cursor-pointer hover:scale-105 transition-all duration-300"
    {{ $attributes }}
>
    {{ $label }}
</button>