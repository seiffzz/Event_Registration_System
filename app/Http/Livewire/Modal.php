<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Modal extends Component
{
    public $room_id;

    public function render()
    {
        $room_id = $this->room_id;
        return view('livewire.modal',compact('room_id'));
    }


}
