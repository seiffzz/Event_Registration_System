<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Route;
use Livewire\Component;

class BookingForm extends Component
{

    public $data;

    public function render()
    {
        if ($this->data != null) {
            $data = $this->data;
            return view('livewire.booking-form', compact('data'));
        }

        $event = Route::current()->parameter('event');
        return view('livewire.booking-form', compact('event'));
    }
}
