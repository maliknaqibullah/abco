<?php

namespace App\Http\Livewire\Warehouse;

use App\Models\Warehouse;
use Livewire\Component;

class ShowWarehouse extends Component
{
    public $warehouse;
    public function mount($id){
        $this->warehouse = Warehouse::find($id);
    }
    public function render()
    {
        return view('livewire.warehouse.show-warehouse',[
            'warehouse' => Warehouse::with('province.warehouse')
        ]);
    }
}
