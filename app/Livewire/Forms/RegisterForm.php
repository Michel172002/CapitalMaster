<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class RegisterForm extends Form
{
    #[Validate('required|string|max:255')]
    public string $name = '';
    #[Validate('required|email|unique:users,email')]
    public string $email = '';
    #[Validate('required|string|min:8|confirmed:passwordConfirmation')]
    public string $password = '';
    #[Validate('required|string|min:8')]
    public string $passwordConfirmation = '';
    #[Validate('required|string|max:255')]
    public string $code = '';
    #[Validate('required|string|max:255')]
    public string $income = '';
    #[Validate('required|string|max:255')]
    public string $currency = '';
    #[Validate('required|string|max:255')]
    public string $objective = '';

    public function messages()
    {
        return [
            'name.required' => 'O nome é obrigatório',
            'email.required' => 'O email é obrigatório',
            'email.email' => 'O email deve ser um email válido',
            'email.unique' => 'O email já está em uso',
            'password.required' => 'A senha é obrigatória',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres',
            'passwordConfirmation.required' => 'A confirmação de senha é obrigatória',
            'passwordConfirmation.confirmed' => 'A confirmação de senha não confere',
            'password.confirmed' => 'A senha não confere',
        ];
    }
}
