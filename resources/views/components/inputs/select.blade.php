@props([
    'label' => '',
    'name' => '',
    'placeholder' => 'Selecione uma opção',
    'value' => '',
    'model' => '',
    'required' => false,
    'options' => [],
    'emptyOption' => true,
])

<div class="flex flex-col gap-2 w-full">
    @if ($label)
        <label for="{{ $name }}" class="text-sm font-medium">{{ $label }} @if($required) <span class="text-red-500">*</span> @endif</label>
    @endif
    <select 
        name="{{ $name }}" 
        wire:model="{{ $model }}"
        class="w-full p-2 border border-[#D9D9D9] text-sm text-gray-700 rounded-md focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary-200 bg-white"
    >
        @if ($emptyOption)
            <option value="" disabled>{{ $placeholder }}</option>
        @endif
        
        @foreach ($options as $optionValue => $optionLabel)
            <option 
                value="{{ $optionValue }}" 
                {{ $value == $optionValue || (old($name) == $optionValue) ? 'selected' : '' }}
            >
                {{ $optionLabel }}
            </option>
        @endforeach
    </select>
</div>
