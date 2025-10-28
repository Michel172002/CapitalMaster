@props([
    'label' => '',
    'name' => '',
    'type' => 'text',
    'placeholder' => '',
    'value' => '',
    'model' => '',
    'required' => false,
    'live' => false,
])

<div class="flex flex-col gap-2 w-full">
    @if ($label)
        <label for="{{ $name }}" class="text-sm font-medium">{{ $label }} @if($required) <span class="text-red-500">*</span> @endif</label>
    @endif
    <input 
        type="{{ $type }}" 
        name="{{ $name }}" 
        placeholder="{{ $placeholder }}" 
        value="{{ $value }}"
        @if($live)
            wire:model.live="{{ $model }}"
        @else
            wire:model="{{ $model }}"
        @endif
        class="w-full p-2 border border-[#D9D9D9] text-sm placeholder:text-[#B3B3B3] rounded-md focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary-200"

        {{ $attributes }}
    >
</div>