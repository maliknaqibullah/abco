<?php

namespace App\Http\Livewire;

use App\Models\StockHistory;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
class ListStockHistory extends Component
{
    
    public $historyId;
    public $deleteId;
    public $confirmDeletion = false;


    public function render()
    {
     abort_if(Gate::denies('stock-history'), Response::HTTP_FORBIDDEN, 'Forbidden');

    
        return view('livewire.list-stock-history', [
            'stocks' => StockHistory::orderBy('created_at','desc')->paginate(12)
        ]);
    }

     public function delete()
    {
        if ($this->deleteId) {
            StockHistory::find($this->deleteId)->delete();

            $this->emit('saved', 'History Deleted Successfully.');

            $this->confirmDeletion = false;
        }
    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
        $this->confirmDeletion = true;
    }

}
