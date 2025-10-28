<?php

namespace App\Services;

use App\Models\EmailVerificationCode;
use Carbon\Carbon;
use Exception;

class EmailVerificationService
{
    public function generateCode()
    {
        return str_pad(random_int(0, 99999), 5, '0', STR_PAD_LEFT);
    }

    public function createForEmail($email)
    {
        EmailVerificationCode::where('email', $email)->delete();
        
        $code = self::generateCode();
        
        return EmailVerificationCode::create([
            'email' => $email,
            'code' => $code,
            'expires_at' => Carbon::now()->addMinutes(10)
        ]);
    }

    public function validateCode(string $email, string $code)
    {
        $verificationCode = EmailVerificationCode::where('email', $email)
        ->where('code', $code)
        ->where('used', false)
        ->first();
        
        if (!$verificationCode || $verificationCode->isExpired()) {
            throw new Exception('Código inválido ou expirado!', 1);
        }

        $verificationCode->update(['used' => true]);
    }
}