<?php

namespace App\Services;

use App\Actions\Fortify\CreateNewUser;
use App\DTOs\RegisterDTO;
use App\Models\ProfileUser;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RegisterUserService
{
    public function __construct(
        private CreateNewUser $createNewUser
    ) {
        //
    }

    public function registerUser(RegisterDTO $registerDTO): User
    {
        try {
            return DB::transaction(function () use ($registerDTO) {
                $user = $this->createNewUser->create([
                    'name' => $registerDTO->name,
                    'email' => $registerDTO->email,
                    'password' => $registerDTO->password,
                    'password_confirmation' => $registerDTO->passwordConfirmation,
                ]);

                $this->createProfileUser($registerDTO, $user);

                return $user;
            });
        } catch (\Exception $e) {
            throw new \Exception('Erro ao registrar usuário: ' . $e->getMessage());
        }
    }

    public function createProfileUser(RegisterDTO $registerDTO, User $user): ProfileUser
    {
        return ProfileUser::create([
            'user_id' => $user->id,
            'income' => $registerDTO->income,
            'currency' => $registerDTO->currency,
            'objective' => $registerDTO->objective,
        ]);
    }
}