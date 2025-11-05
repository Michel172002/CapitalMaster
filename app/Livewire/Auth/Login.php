<?php

namespace App\Livewire\Auth;

use App\Concerns\WithNotifications;
use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    use WithNotifications;
    
    public LoginForm $loginForm;

    public function render()
    {
        return view('livewire.auth.login');
    }

    public function login()
    {
        try {
            $this->loginForm->validate();
            
            $credentials = [
                'email' => $this->loginForm->email,
                'password' => $this->loginForm->password,
            ];

            if (Auth::attempt($credentials, $this->loginForm->remember)) {
                request()->session()->regenerate();
                
                $this->dispararNotificacaoSucesso('Login realizado com sucesso!');
                return $this->redirect('/dashboard', navigate: true);
            } else {
                $this->dispararNotificacaoErro('Credenciais inválidas. Verifique seu email e senha.');
            }
            
        } catch (\Throwable $th) {
            $this->dispararNotificacaoErro($th);
        }
    }
}
