<div 
    x-data="{
        currentStep: 1,
    }"
    id="main" 
    class="w-full h-screen flex items-center justify-center px-16"
>
    <x-register.form-card />
    <x-side-banner 
        :infos="[
            [
                'title' => 'Bem-vindo ao CapitalMaster, seu novo aliado na jornada financeira.',
                'description' => 'Registre-se e dê o primeiro passo rumo a uma vida mais organizada e próspera.',
                'image' => 'images/svg/Mobile login-pana.svg'
            ],
            [
                'title' => 'Crie sua conta no CapitalMaster e comece a transformar suas finanças.',
                'description' => 'Controle seus gastos, acompanhe seus investimentos e alcance suas metas financeiras com clareza.',
                'image' => 'images/svg/Money income-bro.svg'
            ],
            [
                'title' => 'Comece agora com o CapitalMaster. Sua liberdade financeira começa aqui.',
                'description' => 'Crie sua conta e assuma o controle dos seus gastos, investimentos e metas.',
                'image' => 'images/svg/Manage money-rafiki.svg'
            ],
            [
                'title' => 'Descubra uma nova forma de gerenciar sua vida financeira com o CapitalMaster.',
                'description' => 'Crie sua conta e visualize seu progresso financeiro de forma simples e inteligente.',
                'image' => 'images/svg/App monetization-bro.svg'
            ],
        ]"
    />
</div>