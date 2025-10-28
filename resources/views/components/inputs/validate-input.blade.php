@props(['name' => 'code', 'id' => 'code', 'value' => '', 'maxLength' => 5, 'model' => ''])

<div
    x-data="{
        inputValues: Array({{ $maxLength }}).fill(''),
        value: @js($value),
        updateValues(text) {
            const cleanText = text.slice(0, {{ $maxLength }});
            this.value = cleanText;
            this.inputValues = Array({{ $maxLength }}).fill('').map((_, i) => cleanText[i] || '');
            this.$nextTick(() => {
                const lastFilledIndex = Math.max(0, cleanText.length - 1);
                const inputs = Array.from(this.$el.querySelectorAll('input[type=\'text\']'));
                inputs[lastFilledIndex]?.focus();
            });
        },
        syncValue() {
            this.value = this.inputValues.join('');
        }
    }"
    x-init="$watch('value', value => $wire.set('{{$model}}', value))"
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
            class="w-12 h-12 text-center text-xl uppercase border-2 border-gray-300 rounded focus:border-primary-500 focus:ring-primary-500"
            x-on:input="
                inputValues[{{ $i - 1 }}] = $el.value;
                syncValue();
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
        x-model="value"
        x-ref="hiddenInput"
    >
</div>