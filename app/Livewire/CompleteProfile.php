<?php

namespace App\Livewire;

use App\Concerns\WithNotifications;
use App\DTOs\RegisterDTO;
use App\Livewire\Forms\RegisterForm;
use App\Services\RegisterUserService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CompleteProfile extends Component
{
    use WithNotifications;
    
    public RegisterForm $registerForm;

    public function render()
    {
        return view('livewire.complete-profile');
    }

    public function validateFinancialInfo()
    {
        try {
            $this->registerForm->validate(
                [
                    'income' => 'required',
                    'currency' => 'required|string',
                    'objective' => 'required|string',
                ],
                [
                    'income.required' => 'A renda mensal é obrigatória',
                    'currency.required' => 'A moeda é obrigatória',
                    'objective.required' => 'O objetivo é obrigatório',
                ]
            );
            $income = str_replace(['.', ','], ['', '.'], $this->registerForm->income);
            $income = floatval($income);
            
            $dataRegister = $this->registerForm->toArray();
            $dataRegister['income'] = $income;

            $registerDTO = RegisterDTO::fromArray($dataRegister);

            app(RegisterUserService::class)->createProfileUser($registerDTO, Auth::user());

            $this->dispararNotificacaoSucesso('Perfil criado com sucesso!');
            $this->redirect(route('dashboard'));
        } catch (\Throwable $th) {
            $this->dispararNotificacaoErro($th);
        }
    }
}
