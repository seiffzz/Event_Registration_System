<?php

namespace App\Http\Livewire;

use Livewire\Component;

class WarningModal extends Component
{
    public $message;
    public function render()
    {
        $message = $this->message;
        return view('livewire.warning-modal',compact('message'));
    }
}
