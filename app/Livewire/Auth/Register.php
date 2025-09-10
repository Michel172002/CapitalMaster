<?php

namespace App\Livewire\Auth;

use App\Livewire\Forms\RegisterForm;
use Livewire\Component;

class Register extends Component
{
    public $title = 'Registro';
    public int $currentStep = 1;

    public RegisterForm $registerForm;
    
    public function render()
    {
        return view('livewire.auth.register');
    }

    public function validateStepPersonnalInfo()
    {
        try {
            // $this->registerForm->validate([
            //     'name' => 'required|string|max:255',
            //     'email' => 'required|email|unique:users,email',
            //     'password' => 'required|string|min:8|confirmed:passwordConfirmation',
            //     'passwordConfirmation' => 'required|string|min:8',
            // ]);
        } catch (\Exception $e) {
            $this->dispatch('toast-error', ...[ 'message' => $e->getMessage() ]);
            return;
        }

        $this->currentStep++;
    }

    private function sendValidationCode()
    {
        
    }
}
