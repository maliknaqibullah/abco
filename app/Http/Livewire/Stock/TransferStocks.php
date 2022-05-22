<?php

namespace App\Http\Livewire\Stock;

use App\Models\Bakery;
use App\Models\Product;
use App\Models\TransferStock;
use App\Models\Warehouse;
use Livewire\Component;

class TransferStocks extends Component
{
    public $source;
    public $selectedProduct;
    public $destinations;
    public $destinationId;

    public $transferredId;

    public $destinationType;
    public $stockQty;
    public $isTransferred = 0;

    public $currentStock;
    public $search = '';

    public $deleteId;
    public $isOpen = false;
    public $confirmDeletion = false;

    public $inStockProducts;


    protected $rules = [
        'source'=>'required',
        'selectedProduct'=>'required',
        'destinationId'=>'required',
        'destinationType'=>'required',
        'stockQty'=>'required',
    ];

    public function render()
    {
        return view('livewire.stock.transfer-stock',[
            'stocks'=>TransferStock::latest()->paginate(10),
            'warehouses'=>Warehouse::whereHas('product')->get()
        ]);
    }

    public function mount()
    {
        $this->inStockProducts = collect();
    }
    public function updatedSource($source)
    {
        if (!is_null($source)) {
            $this->inStockProducts = Product::where('warehouse_id',$source)->get();
            $this->reset('destinationType');
            $this->reset('currentStock');
        }
    }
    public function updatedSelectedProduct($product)
    {
        if (!is_null($product)) {
            $this->currentStock = Product::where('id',$product)->pluck('amount')->first();
        }
    }

    public function updatedDestinationType($type)
    {
        if (!is_null($type)) {
            if($type === '1'){
                $this->destinations = Warehouse::where('id','!=',$this->source)->get();
            }
            if($type ==='2'){
                $this->destinations = Bakery::latest()->get();
            }
        }
    }

    public function create()
    {
        $this->isModalOpen();
        $this->resetInputFields();

    }
//    public function edit($id)
//    {
//        $record = TransferStock::findOrFail($id);
//        $this->transferredId = $record->id;
//        $this->warehouseId = $record->warehouse_id;
//        $this->productId = $record->product_id;
//        $this->destinationId = $record->destination_id;
//        $this->destinationType = $record->destination_type;
//        $this->stockQty = $record->stock_qty;
//        $this->isTransferred = $record->is_transferred;
//        $this->isModalOpen();
//
//    }


    public function saveStock()
    {
        $this->validate();

        if ($this->isTransferred){
            $oldProduct = Product::where('id',$this->selectedProduct)
                                    ->where('warehouse_id',$this->source)->first();
//            $newProduct = Product::where('id',$this->selectedProduct)
//                ->where('warehouse_id',$this->source)->first();
//               if ($this->destinationType === 2)
             TransferStock::updateOrCreate( ['id'=>$this->transferredId],[
                   'warehouse_id' => $this->source,
                   'product_id' => $this->selectedProduct,
                   'destination_type' => $this->destinationType,
                   'destination_id' => $this->destinationId,
                   'stock_qty' => $this->stockQty,
                   'is_transferred' => $this->isTransferred,
               ]);
            $this->emit('saved','Stock transferred successfully Created.');
        }




        $this->isModalClose();

        $this->resetInputFields();
    }


    public function delete()
    {
        if($this->deleteId){
            TransferStock::find($this->deleteId)->delete();

            $this->emit('saved','Transferred Stock Deleted Successfully.');

            $this->confirmDeletion = false;
        }
    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
        $this->confirmDeletion = true;
    }


    public function isModalOpen()
    {
        $this->isOpen = true;
    }

    public function isModalClose()
    {
        $this->isOpen = false;
        $this->resetErrorBag();

    }
    public function resetInputFields()
    {
        $this->stockId = '';
        $this->source = '';
        $this->sourceLocation = 0;
        $this->destinationLocation = '';
        $this->destination = '';
        $this->stockQty = '';
        $this->isTransferred = '';
        $this->selectedDistrict = '';
        $this->selectedProvince = '';



    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
