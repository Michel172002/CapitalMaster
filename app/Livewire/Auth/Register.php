<?php

namespace App\Livewire\Auth;

use App\DTOs\RegisterDTO;
use App\Livewire\Forms\RegisterForm;
use App\Mail\EmailVerificationMail;
use App\Services\EmailVerificationService;
use App\Livewire\BaseComponent;
use App\Services\RegisterUserService;
use Illuminate\Support\Facades\Mail;

class Register extends BaseComponent
{
    public int $currentStep = 1;
    public bool $validatedCode = false;

    public RegisterForm $registerForm;
    
    private EmailVerificationService $emailVerificationService;
    private RegisterUserService $registerUserService;
    
    public function boot()
    {
        $this->emailVerificationService = app(EmailVerificationService::class);
        $this->registerUserService = app(RegisterUserService::class);
    }
    
    public function render()
    {
        return view('livewire.auth.register');
    }

    public function validateStepPersonnalInfo()
    {
        try {
            $this->registerForm->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8|confirmed:passwordConfirmation',
                'passwordConfirmation' => 'required|string|min:8',
            ], [
                'name.required' => 'O nome é obrigatório',
                'email.required' => 'O email é obrigatório',
                'email.email' => 'O email deve ser um email válido',
                'email.unique' => 'O email já está em uso',
                'password.required' => 'A senha é obrigatória',
                'password.min' => 'A senha deve ter pelo menos 8 caracteres',
                'password.confirmed' => 'A confirmação de senha não confere',
                'passwordConfirmation.required' => 'A confirmação de senha é obrigatória',
            ]);

            if(!$this->validatedCode){
                $this->sendValidationCode();
            }

            $this->currentStep = 2;

        } catch (\Exception $e) {
            $this->dispararNotificacaoErro($e);
        }
    }

    public function validateFinancialInfo()
    {
        try {
            $this->registerForm->validate([
                'income' => 'required',
                'currency' => 'required|string',
                'objective' => 'required|string',
            ], [
                'income.required' => 'A renda mensal é obrigatória',
                'currency.required' => 'A moeda é obrigatória',
                'currency.string' => 'A moeda deve ser uma texto',
                'objective.required' => 'O objetivo é obrigatório',
                'objective.string' => 'O objetivo deve ser uma texto',
            ]);
            
            $income = str_replace(['.', ','], ['', '.'], $this->registerForm->income);
            $income = floatval($income);

            $dataRegister = $this->registerForm->toArray();
            $dataRegister['income'] = $income;

            $registerDTO = RegisterDTO::fromArray($dataRegister);

            $this->registerUserService->registerUser($registerDTO);

            $this->dispararNotificacaoSucesso('Usuário registrado com sucesso!');
            $this->redirect(route('login'));
        }
        catch (\Exception $e) {
            $this->dispararNotificacaoErro($e);
        }
    }

    public function validateCode()
    {
        try {
            $this->registerForm->validate([
                'code' => 'required|string|size:5',
            ], [
                'code.required' => 'O código é obrigatório',
                'code.size' => 'O código deve ter exatamente 5 dígitos',
            ]);

            $email = $this->registerForm->email;

            $this->emailVerificationService->validateCode($email, $this->registerForm->code);

            $this->currentStep = 3;
            $this->validatedCode = true;
            $this->dispararNotificacaoSucesso('Email verificado com sucesso!');

        }catch (\Exception $e) {
            $this->dispararNotificacaoErro($e);
        }
    }

    public function resendCode()
    {
        try {
            if (empty($this->registerForm->email)) {
                $this->dispararNotificacaoErro('Email não encontrado!');
                return;
            }

            $this->sendValidationCode();
            $this->dispararNotificacaoSucesso('Código reenviado com sucesso!');

        } catch (\Exception $e) {
            $this->dispararNotificacaoErro($e);
        }
    }

    private function sendValidationCode()
    {
        try {
            $email = $this->registerForm->email;
            $verificationCode = $this->emailVerificationService->createForEmail($email);
            
            Mail::to($email)->send(
                new EmailVerificationMail($verificationCode->code, $email)
            );

            $this->dispararNotificacaoSucesso('Código de verificação enviado para seu email!');
        } catch (\Exception $e) {
            $this->dispararNotificacaoErro($e);
        }
    }

    public function nextStep()
    {
        $this->currentStep++;
    }

    public function previousStep()
    {
        $this->currentStep--;
    }

    public function updatedRegisterFormEmail()
    {
        $this->validatedCode = false;
    }
}
