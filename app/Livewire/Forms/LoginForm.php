<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class LoginForm extends Form
{
    #[Validate('required|email')]
    public string $email = '';
    #[Validate('required')]
    public string $password = '';
    #[Validate('boolean')]
    public bool $remember = false;

    public function messages()
    {
        return [
            'email.required' => 'O email é obrigatório',
            'email.email' => 'O email deve ser um email válido',
            'password.required' => 'A senha é obrigatória',
        ];
    }
}
