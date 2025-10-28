@props([
    'currentStep' => 1,
])

<div class="w-[35%] flex gap-2 flex-col items-center justify-center p-4">
    <img src="{{ asset('images/logo_preta.png') }}" alt="logo" class="h-12">

    <div class="bg-white border border-gray-200/70 rounded-3xl py-4 px-6 w-full min-h-[550px] flex flex-col items-center gap-2 shadow-lg">
        <h1 class="text-xl font-bold">Crie sua conta</h1>
        <p class="text-xs text-gray-500/70 font-semibold text-center">
            Registre-se e dê o primeiro passo para dominar suas finanças.
        </p>

        <x-register.registration-progress-bar :currentStep="$currentStep" />
        @if ($currentStep == 1)
            <div class="w-full flex flex-col gap-4 my-auto">
                <form class="w-full flex flex-col gap-2">
                    <x-inputs.input label="Nome" name="name" type="text" placeholder="Digite seu nome" model="registerForm.name" />
                    <x-inputs.input label="Email" name="email" type="email" placeholder="Digite seu email" model="registerForm.email" :live="true" />
                    <x-inputs.input label="Senha" name="password" type="password" placeholder="Digite sua senha" model="registerForm.password" />
                    <x-inputs.input label="Confirmar senha" name="password_confirmation" type="password" placeholder="Digite sua senha novamente" model="registerForm.passwordConfirmation" />
                </form>

                <div class="w-full flex items-center justify-between gap-4">
                    <x-buttons.oauth-google width="full" />
                    <x-buttons.button 
                        label="Próximo" 
                        wire:click="validateStepPersonnalInfo()" 
                        width="full" 
                        color="primary"
                        wire:loading.attr="disabled"
                        wire:target="validateStepPersonnalInfo"
                    >
                        <span wire:loading.remove wire:target="validateStepPersonnalInfo">Próximo</span>
                        <span wire:loading wire:target="validateStepPersonnalInfo">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4 animate-spin inline mr-2" fill="currentColor" viewBox="0 0 640 640">
                                <path d="M272 112C272 85.5 293.5 64 320 64C346.5 64 368 85.5 368 112C368 138.5 346.5 160 320 160C293.5 160 272 138.5 272 112zM272 528C272 501.5 293.5 480 320 480C346.5 480 368 501.5 368 528C368 554.5 346.5 576 320 576C293.5 576 272 554.5 272 528zM112 272C138.5 272 160 293.5 160 320C160 346.5 138.5 368 112 368C85.5 368 64 346.5 64 320C64 293.5 85.5 272 112 272zM480 320C480 293.5 501.5 272 528 272C554.5 272 576 293.5 576 320C576 346.5 554.5 368 528 368C501.5 368 480 346.5 480 320zM139 433.1C157.8 414.3 188.1 414.3 206.9 433.1C225.7 451.9 225.7 482.2 206.9 501C188.1 519.8 157.8 519.8 139 501C120.2 482.2 120.2 451.9 139 433.1zM139 139C157.8 120.2 188.1 120.2 206.9 139C225.7 157.8 225.7 188.1 206.9 206.9C188.1 225.7 157.8 225.7 139 206.9C120.2 188.1 120.2 157.8 139 139zM501 433.1C519.8 451.9 519.8 482.2 501 501C482.2 519.8 451.9 519.8 433.1 501C414.3 482.2 414.3 451.9 433.1 433.1C451.9 414.3 482.2 414.3 501 433.1z"/>
                            </svg>
                            Carregando...
                        </span>
                    </x-buttons.button>
                </div>
            </div>
        @endif

        @if ($currentStep == 2)
            <div wire:show="!validatedCode" class="w-full flex flex-col gap-8 my-auto">
                <span class="text-sm text-gray-500/70 font-semibold text-center">
                    Enviamos um código de 5 dígitos para o seu e-mail.<br> 
                    Insira-o abaixo para confirmar sua conta.
                </span>
                
                <form class="w-full flex flex-col gap-2">
                    <x-inputs.validate-input 
                        id="code" 
                        name="code" 
                        model="registerForm.code" 
                        placeholder="Digite o código de 5 dígitos"
                    />
                </form>

                    
                <div wire:target="resendCode" wire:loading.remove class="text-center flex flex-col gap-0.5 justify-center items-center text-sm text-gray-500/70 font-semibold mt-auto">
                    <span>
                        Não recebeu o código?
                    </span>
                    <button wire:click="resendCode()" class="text-black cursor-pointer">Clique aqui para reenviar</button>
                </div>
                <div wire:target="resendCode" wire:loading class="text-center flex flex-col gap-0.5 justify-center items-center text-sm text-gray-500/70 font-semibold mt-auto">
                    <span>
                        Enviando código...
                    </span>
                </div>

                <div class="w-full flex flex-col gap-4">
                    <div class="flex items-center justify-between gap-4">
                        <x-buttons.button 
                            label="Validar Código" 
                            wire:click="validateCode()" 
                            width="full" 
                            color="primary" 
                        />
                    </div>
                </div>
            </div>
            <div wire:show="validatedCode" class="w-full flex flex-col gap-8 my-auto">
                <span class="text-sm text-gray-500/70 font-semibold text-center">
                    Email validado com sucesso!
                </span>
                <div class="flex items-center justify-between gap-4">
                    <x-buttons.button 
                        label="Continuar" 
                        wire:click="nextStep()" 
                        width="full" 
                        color="primary" 
                    />
                </div>
            </div>
        @endif

        @if ($currentStep == 3)
            <div class="w-full flex flex-col gap-4 my-auto">
                <x-inputs.radio-group 
                    name="objective"
                    :hide_radio="true"
                    direction="flex-row"
                    model="registerForm.objective"
                    :options="[
                        [
                            'title' => 'Poupar',
                            'svg' => '<svg xmlns=\'http://www.w3.org/2000/svg\' class=\'size-8\' fill=\'currentColor\' viewBox=\'0 0 640 640\'><path d=\'M320 32C373 32 416 75 416 128C416 181 373 224 320 224C267 224 224 181 224 128C224 75 267 32 320 32zM80 368C80 297.9 127 236.6 197.1 203.1C222.4 244.4 268 272 320 272C375.7 272 424.1 240.3 448 194C463.8 182.7 483.1 176 504 176L523.5 176C533.9 176 541.5 185.8 539 195.9L521.9 264.2C531.8 276.6 540.1 289.9 546.3 304L568 304C581.3 304 592 314.7 592 328L592 440C592 453.3 581.3 464 568 464L528 464C511.5 486 489.5 503.6 464 514.7L464 544C464 561.7 449.7 576 432 576L399 576C384.7 576 372.2 566.5 368.2 552.8L361.1 528L278.8 528L271.7 552.8C267.8 566.5 255.3 576 241 576L208 576C190.3 576 176 561.7 176 544L176 514.7C119.5 490 80 433.6 80 368zM456 384C469.3 384 480 373.3 480 360C480 346.7 469.3 336 456 336C442.7 336 432 346.7 432 360C432 373.3 442.7 384 456 384z\'/></svg>',
                            'value' => 'poupar'
                        ],
                        [
                            'title' => 'Investir',
                            'svg' => '<svg xmlns=\'http://www.w3.org/2000/svg\' class=\'size-8\' fill=\'currentColor\' viewBox=\'0 0 640 640\'><path d=\'M544 72C544 58.7 533.3 48 520 48L418.2 48C404.9 48 394.2 58.7 394.2 72C394.2 85.3 404.9 96 418.2 96L462.1 96L350.8 207.3L255.7 125.8C246.7 118.1 233.5 118.1 224.5 125.8L112.5 221.8C102.4 230.4 101.3 245.6 109.9 255.6C118.5 265.6 133.7 266.8 143.7 258.2L240.1 175.6L336.5 258.2C346 266.4 360.2 265.8 369.1 256.9L496.1 129.9L496.1 173.8C496.1 187.1 506.8 197.8 520.1 197.8C533.4 197.8 544.1 187.1 544.1 173.8L544 72zM112 320C85.5 320 64 341.5 64 368L64 528C64 554.5 85.5 576 112 576L528 576C554.5 576 576 554.5 576 528L576 368C576 341.5 554.5 320 528 320L112 320zM159.3 376C155.9 396.1 140.1 412 119.9 415.4C115.5 416.1 111.9 412.5 111.9 408.1L111.9 376.1C111.9 371.7 115.5 368.1 119.9 368.1L151.9 368.1C156.3 368.1 160 371.7 159.2 376.1zM159.3 520.1C160 524.5 156.4 528.1 152 528.1L120 528.1C115.6 528.1 112 524.5 112 520.1L112 488.1C112 483.7 115.6 480 120 480.8C140.1 484.2 156 500 159.4 520.2zM520 480.7C524.4 480 528 483.6 528 488L528 520C528 524.4 524.4 528 520 528L488 528C483.6 528 479.9 524.4 480.7 520C484.1 499.9 499.9 484 520.1 480.6zM480.7 376C480 371.6 483.6 368 488 368L520 368C524.4 368 528 371.6 528 376L528 408C528 412.4 524.4 416.1 520 415.3C499.9 411.9 484 396.1 480.6 375.9zM256 448C256 412.7 284.7 384 320 384C355.3 384 384 412.7 384 448C384 483.3 355.3 512 320 512C284.7 512 256 483.3 256 448z\'/></svg>',
                            'value' => 'investir'
                        ],
                        [
                            'title' => 'Quitar Dívidas',
                            'svg' => '<svg xmlns=\'http://www.w3.org/2000/svg\' class=\'size-8\' fill=\'currentColor\' viewBox=\'0 0 640 640\'><path d=\'M142 66.2C150.5 62.3 160.5 63.7 167.6 69.8L208 104.4L248.4 69.8C257.4 62.1 270.7 62.1 279.6 69.8L320 104.4L360.4 69.8C369.4 62.1 382.6 62.1 391.6 69.8L432 104.4L472.4 69.8C479.5 63.7 489.5 62.3 498 66.2C506.5 70.1 512 78.6 512 88L512 552C512 561.4 506.5 569.9 498 573.8C489.5 577.7 479.5 576.3 472.4 570.2L432 535.6L391.6 570.2C382.6 577.9 369.4 577.9 360.4 570.2L320 535.6L279.6 570.2C270.6 577.9 257.3 577.9 248.4 570.2L208 535.6L167.6 570.2C160.5 576.3 150.5 577.7 142 573.8C133.5 569.9 128 561.4 128 552L128 88C128 78.6 133.5 70.1 142 66.2zM232 200C218.7 200 208 210.7 208 224C208 237.3 218.7 248 232 248L408 248C421.3 248 432 237.3 432 224C432 210.7 421.3 200 408 200L232 200zM208 416C208 429.3 218.7 440 232 440L408 440C421.3 440 432 429.3 432 416C432 402.7 421.3 392 408 392L232 392C218.7 392 208 402.7 208 416zM232 296C218.7 296 208 306.7 208 320C208 333.3 218.7 344 232 344L408 344C421.3 344 432 333.3 432 320C432 306.7 421.3 296 408 296L232 296z\'/></svg>',
                            'value' => 'quitar_dividas'
                        ]
                    ]" 
                />
                <div class="flex flex-row gap-2">
                    <div class="w-1/2">
                        <x-inputs.input label="Qual a sua Renda Mensal?" name="income" type="text" placeholder="Sua renda mensal aproximada" model="registerForm.income" x-mask:dynamic="$money($input, ',')" />
                    </div>
                    <div class="w-1/2">
                        <x-inputs.select label="Qual a sua moeda?" name="currency" placeholder="Selecione uma opção" model="registerForm.currency" 
                        :options="['BRL' => 'R$ (Real Brasileiro)', 'USD' => 'US$ (Dólar Americano)', 'EUR' => '€ (Euro)']" />
                    </div>
                </div>
                
                <div class="w-full flex flex-col items-center justify-between gap-4">
                    <x-buttons.button 
                        label="Finalizar Cadastro" 
                        wire:click="validateFinancialInfo()" 
                        width="full" 
                    />
                </div>
            </div>
        @endif

        <p class="text-sm text-gray-500/70 font-semibold mt-auto">
            Já tem uma conta? <a href="{{ route('login') }}" class="text-black cursor-pointer">Faça login</a>
        </p>
    </div>
</div>