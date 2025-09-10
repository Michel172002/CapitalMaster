@props([
    'name' => 'radio-group',
    'id' => 'radio-group',
    'value' => '',
    'options' => [],
    'hide_radio' => false,
    'direction' => 'flex-col',
    'model' => '',
])

<div 
    x-data="{
        selectedValue: '{{ $value }}'
    }" 
    class="space-y-3 flex {{ $direction }} gap-4"
>
    @foreach($options as $index => $option)
        <label 
            x-on:click="selectedValue = '{{ data_get($option, 'value') }}'" 
            class="flex items-center justify-center tw-w-full p-5 space-x-3 bg-white border rounded-md shadow-sm hover:bg-gray-50 border-neutral-200/70 {{ $direction === 'flex-row' ? 'flex-1' : 'w-full' }} h-28"
            :class="{ 
                'ring-2 ring-primary': selectedValue === '{{ data_get($option, 'value') }}' 
            }"
        >
            <input 
                type="radio" 
                name="{{ $name }}" 
                id="{{ $id }}_{{ $index }}"
                value="{{ data_get($option, 'value') }}"
                class="{{ $hide_radio ? 'hidden' : 'translate-y-px focus:ring-primary' }}"
                wire:model="{{ $model }}"
            />
            <span class="relative flex flex-col items-center justify-center text-left space-y-1.5 leading-none text-gray-500"
                :class="{ 
                    'text-primary': selectedValue === '{{ data_get($option, 'value') }}' 
                }"
            >
                @if(data_get($option, 'svg'))
                    {!! data_get($option, 'svg') !!}
                @endif
                @if(data_get($option, 'title'))
                    <span class="font-semibold text-sm text-center">{{ data_get($option, 'title') }}</span>
                @endif
                @if(data_get($option, 'description'))
                    <span class="text-xs text-gray-500">{{ data_get($option, 'description') }}</span>
                @endif
            </span>
        </label>
    @endforeach
</div>