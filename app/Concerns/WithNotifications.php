<?php

namespace App\Concerns;

use Exception;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
trait WithNotifications
{
    /**
     * Dispara uma notificação de sucesso
     */
    public function dispararNotificacao(string $message, string $type = 'success'): void
    {
        $this->dispatch('toast-' . $type, message: $message);
    }

    /**
     * Dispara uma notificação de erro
     */
    public function dispararNotificacaoErro($exception): void
    {
        $message = match(true){
            $exception instanceof ValidationException => $exception->errors()[array_key_first($exception->errors())][0] ?? 'Erro de validação.',
            $exception instanceof Exception => $exception->getMessage(),
            is_string($exception) => $exception,
            default => 'Erro interno. Tente novamente.',
        };
        
        $this->dispararNotificacao($message, 'error');
    }

    /**
     * Dispara uma notificação de sucesso
     */
    public function dispararNotificacaoSucesso(string $message): void
    {
        $this->dispararNotificacao($message, 'success');
    }

    /**
     * Dispara uma notificação de informação
     */
    public function dispararNotificacaoInfo(string $message): void
    {
        $this->dispararNotificacao($message, 'info');
    }

    /**
     * Dispara uma notificação de aviso
     */
    public function dispararNotificacaoAviso(string $message): void
    {
        $this->dispararNotificacao($message, 'warning');
    }
}

