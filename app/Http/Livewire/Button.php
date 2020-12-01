<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Button extends Component
{
    public $type;

    public function render()
    {
        $type = $this->type;
        return view('livewire.button', compact('type'));
    }
    public function select_operation($operation,$request){
       dd($request);
    }
}
