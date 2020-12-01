@if($type==='print')
    <button  wire:click="select_operation('print','request')" class="px-3 py-2 text-center bg-blue-400 rounded font-bold text-white w-40 mr-3"
            type="submit" form="form">Print Room
    </button>
@elseif($type==='mail')
@elseif($type==='paid')
@elseif($type==='edit')
@elseif($type==='delete')
@endif
