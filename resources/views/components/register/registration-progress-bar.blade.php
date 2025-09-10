@props([
    'currentStep' => 1,
])

<div 
    x-data="{
        steps: [	
            {
                icon: 'user',
                label: 'Perfil'
            },
            {
                icon: 'lock',
                label: 'Segurança'
            },
            {
                icon: 'money',
                label: 'Pagamento'
            }
        ]
    }"
    class="w-full"
>
    <div class="flex items-center justify-between relative">

        <div 
            class="absolute top-[40%] left-0 w-1/2 h-1 bg-gray-300 transform -translate-y-1/2"
            :class="{
                'bg-primary': {{ $currentStep }} > 1,
                'bg-gray-300': {{ $currentStep }} <= 1
            }"
        ></div>
        <div 
            class="absolute top-[40%] left-1/2 w-1/2 h-1 bg-gray-300 transform -translate-y-1/2"
            :class="{
                'bg-primary': {{ $currentStep }} > 2,
                'bg-gray-300': {{ $currentStep }} <= 2
            }"
        ></div>
            
        <template x-for="(step, index) in steps" :key="step.icon">
            <div class="relative z-10 flex flex-col items-center">
                <div 
                    class="w-8 h-8 rounded-full flex items-center justify-center mb-2"
                    :class="{
                        'bg-primary': {{ $currentStep }} > index,
                        'bg-gray-400': {{ $currentStep }} <= index
                    }"
                >
                    <svg x-show="step.icon === 'user'" x-on:click="{{ $currentStep }} > 1 ? $wire.set('currentStep', 1) : null" class="w-4 h-4 text-white cursor-pointer" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                    </svg>
                    <svg x-show="step.icon === 'lock'" x-on:click="currentStep > 2 ? $wire.set('currentStep', 2) : null" class="w-4 h-4 text-white cursor-pointer" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                    </svg>
                    <svg x-show="step.icon === 'money'" x-on:click="currentStep > 3 ? $wire.set('currentStep', 3) : null" class="w-4 h-4 text-white cursor-pointer" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"></path>
                    </svg>
                </div>
            </div>
        </template>
    </div>
</div> 