@props([
    'width' => 'fit',
])

<a 
    class="w-{{ $width }} h-full bg-white text-gray-500 px-4 py-2 rounded-md font-medium text-sm border border-gray-500/50 flex items-center justify-center gap-2 cursor-pointer hover:scale-105 transition-all duration-300"
    href="{{ route('google.redirect') }}"
>
    <img src="{{ asset('images/svg/google.svg') }}" alt="Google" class="w-4 h-4">
    Entrar com Google
</a>