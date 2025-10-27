<?php

namespace App\Livewire;

use App\Concerns\WithNotifications;
use Livewire\Component;

abstract class BaseComponent extends Component
{
    use WithNotifications;
}

