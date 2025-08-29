@props(['name' => 'code', 'id' => 'code', 'value' => '', 'maxLength' => 5])

<div
    x-data="{
        inputValues: Array({{ $maxLength }}).fill(''),
        updateValues(text) {
            const cleanText = text.slice(0, {{ $maxLength }});
            
            this.inputValues = Array({{ $maxLength }}).fill('').map((_, i) => cleanText[i] || '');
            this.$refs.hiddenInput.value = cleanText;

            this.$nextTick(() => {
                const lastFilledIndex = Math.max(0, cleanText.length - 1);
                const inputs = Array.from(this.$el.querySelectorAll('input[type=\'text\']'));
                inputs[lastFilledIndex]?.focus();
            });
        }
    }"
    class="flex gap-2 justify-center"
    @paste.prevent="
        const text = $event.clipboardData.getData('text');
        updateValues(text);
    "
>
    @for ($i = 1; $i <= $maxLength; $i++)
        <input
            type="text"
            maxlength="1"
            x-model="inputValues[{{ $i - 1 }}]"
            class="w-12 h-12 text-center text-xl uppercase border-2 border-gray-300 rounded focus:border-blue-500 focus:ring-blue-500"
            x-on:input="
                inputValues[{{ $i - 1 }}] = $el.value;
                $refs.hiddenInput.value = inputValues.join('');
                if ($el.value && {{ $i }} < {{ $maxLength }}) {
                    $el.nextElementSibling?.focus();
                }
            "
            x-on:keydown.backspace="
                if (!$el.value && {{ $i }} > 1) {
                    $el.previousElementSibling?.focus();
                }
            "
        >
    @endfor
    <input 
        type="hidden" 
        name="{{ $name }}" 
        id="{{ $id }}" 
        value="{{ $value }}"
        x-ref="hiddenInput"
    >
</div>