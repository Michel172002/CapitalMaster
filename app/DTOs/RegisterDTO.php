<?php

namespace App\DTOs;

class RegisterDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public string $passwordConfirmation,
        public string $code,
        public float $income,
        public string $currency,
        public string $objective,
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->passwordConfirmation = $passwordConfirmation;
        $this->code = $code;
        $this->income = $income;
        $this->currency = $currency;
        $this->objective = $objective;
    }

    /**
     * Cria uma instância do DTO a partir de um array
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['name'],
            $data['email'],
            $data['password'],
            $data['passwordConfirmation'],
            $data['code'],
            $data['income'],
            $data['currency'],
            $data['objective'],
        );
    }

    /**
     * Converte o DTO para array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'passwordConfirmation' => $this->passwordConfirmation,
            'code' => $this->code,
            'income' => $this->income,
            'currency' => $this->currency,
            'objective' => $this->objective,
        ];
    }

    /**
     * Converte o DTO para JSON
     */
    public function toJson(): string
    {
        return json_encode($this->toArray());
    }
}