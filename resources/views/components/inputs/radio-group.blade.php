@props([
    'name' => 'radio-group',
    'id' => 'radio-group',
    'value' => '',
    'options' => [],
    'hide_radio' => false,
    'direction' => 'flex-col',
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
            class="flex items-start p-5 space-x-3 bg-white border rounded-md shadow-sm hover:bg-gray-50 border-neutral-200/70 {{ $direction === 'flex-row' ? 'flex-1' : 'w-full' }} h-full"
            :class="{ 
                'ring-2 ring-primaria': selectedValue === '{{ data_get($option, 'value') }}' 
            }"
        >
            <input 
                type="radio" 
                name="{{ $name }}" 
                id="{{ $id }}_{{ $index }}"
                value="{{ data_get($option, 'value') }}"
                class="{{ $hide_radio ? 'hidden' : 'translate-y-px focus:ring-primaria' }}"
            />
            <span class="relative flex flex-col items-center justify-center text-left space-y-1.5 leading-none"
                :class="{ 
                    'text-primaria': selectedValue === '{{ data_get($option, 'value') }}' 
                }"
            >
                @if(data_get($option, 'svg'))
                    {!! data_get($option, 'svg') !!}
                @endif
                @if(data_get($option, 'title'))
                    <span class="font-semibold text-sm">{{ data_get($option, 'title') }}</span>
                @endif
                @if(data_get($option, 'description'))
                    <span class="text-xs text-gray-500">{{ data_get($option, 'description') }}</span>
                @endif
            </span>
        </label>
    @endforeach
</div>