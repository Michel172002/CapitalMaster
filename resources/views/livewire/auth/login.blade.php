<div
    id="main" 
    class="w-full h-screen flex items-center justify-center px-16"
>
    <x-side-banner 
        :infos="[
            [
                'title' => 'Bem-vindo de volta! Faça login em sua conta CapitalMaster',
                'description' => 'Acesse sua conta CapitalMaster e acompanhe sua saúde financeira com clareza e controle.',
                'image' => 'images/svg/Dashboard-pana.svg'
            ],
        ]"
    />
    
    <div class="w-[35%] flex gap-2 flex-col items-center justify-center p-4">
        <img src="{{ asset('images/logo_preta.png') }}" alt="logo" class="h-12">
    
        <div class="bg-white border border-gray-200/70 rounded-3xl py-4 px-6 w-full min-h-[550px] flex flex-col items-center gap-2 shadow-lg">
            <h1 class="text-xl font-bold">Entrar</h1>
            <p class="text-xs text-gray-500/70 font-semibold text-center">
                Bem Vindo de volta! Por favor insira seus dados.
            </p>
    
            <div class="w-full flex flex-col gap-4 my-auto">
                <form class="w-full flex flex-col gap-2">
                    <x-inputs.input label="Email" name="email" type="email" placeholder="Digite seu email" model="loginForm.email" />
                    <x-inputs.input label="Senha" name="password" type="password" placeholder="Digite sua senha" model="loginForm.password" />

                    <div class="flex flex-row items-center justify-between gap-2">
                    <x-inputs.checkbox label="Lembrar-se por 30 dias" size="sm" name="remember" model="loginForm.remember" />

                        <a href="#" wire:navigate class="text-xs text-primary-500 font-semibold">Esqueceu sua senha?</a>

                    </div>
                </form>

                <div class="w-full flex flex-col items-center justify-between gap-4">
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
                    
                    <div class="w-full flex items-center justify-between gap-4">
                        <hr class="w-full border-gray-500/70">
                        <p class="text-sm text-gray-500/70 font-semibold text-center">ou</p>
                        <hr class="w-full border-gray-500/70">
                    </div>
                    
                    <x-buttons.oauth-google width="full" />
                </div>
            </div>
    
            <p class="text-sm text-gray-500/70 font-semibold mt-auto">
                não tem uma conta? <a href="{{ route('register') }}" wire:navigate class="text-black cursor-pointer"> Inscrever-se</a>
            </p>
        </div>
    </div>
</div>