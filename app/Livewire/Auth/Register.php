<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Register extends Component
{
    public $title = 'Registro';
    
    public function render()
    {
        return view('livewire.auth.register');
    }
}
