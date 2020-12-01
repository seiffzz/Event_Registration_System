<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Route;
use Livewire\Component;

class BookingForm extends Component
{
    public function render()
    {
        $event= Route::current()->parameter('event');
        return view('livewire.booking-form',compact('event'));
    }
}
