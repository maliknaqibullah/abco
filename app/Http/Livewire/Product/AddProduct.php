<?php

namespace App\Http\Livewire\Product;

use App\Models\Ingredient;
use App\Models\Product;
use App\Models\StockHistory;
use App\Models\Supplier;
use App\Models\Warehouse;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AddProduct extends Component
{
    public $name;
    public $amount;
    public $unit;

    public $warehouseId;
    public $supplierId;
    public $ingredientId;
    public $productId;
    public $deleteId;
    public $isSupplied;

    public $isOpen = false;
    public $confirmDeletion = false;

    public $warehouses;
    public $ingredients;

    protected $rules = [
        'name' => 'required',
        'warehouseId' => 'required',
        'supplierId' => 'required',
        'amount' => 'required|numeric|min:0',
        'unit' => 'required',
    ];

    /**
     * @var mixed
     */


    public function mount()
    {

        $this->ingredients = Ingredient::all()->sortBy('name');
        $this->warehouses = Warehouse::where('status', 1)->orderBy('name')->get();
        $this->suppliers = Supplier::where('status', 1)->orderBy('name')->get();

    }

    public function render()
    {
        return view('livewire.product.add-product', [
            'products' => Product::latest()->paginate(20)
        ]);
    }


    public function create()
    {
        $this->isModalOpen();
        $this->resetInputFields();

    }

    public function edit($id)
    {
        $record = Product::findOrFail($id);
        $this->productId = $record->id;
        $this->name = $record->ingredient_id;
        $this->warehouseId = $record->warehouse_id;
        $this->supplierId = $record->supplier_id;
        $this->amount = $record->amount;
        $this->unit = $record->unit;
        $this->isSupplied = $record->is_supplied;
        $this->isModalOpen();

    }


    public function saveProduct()
    {
        $incrementAmount = 0;
        $this->validate();

        if (!$this->isSupplied) $this->isSupplied = 0;

        $productExist = DB::table('products')
            ->where([
                ['ingredient_id', $this->name],
                ['warehouse_id', $this->warehouseId]
            ]);
        if (count($productExist->get()) > 0 && $this->productId == '') {

            if ($this->unit == '1') $incrementAmount += $this->amount / 1000;
            if ($this->unit == '2') $incrementAmount += $this->amount;
            if ($this->unit == '3') $incrementAmount += $this->amount * 1000;


            $productExist->increment('amount', $incrementAmount);
                StockHistory::create([
                'user_id' => auth()->user()->id,
                'warehouse_id' => $this->warehouseId,
                'ingredient_id' => $this->name,
                'supplier_id' => $this->supplierId,
                'unit' => $this->unit,
                'amount' => $this->amount,
            ]);

        }else{
            if ($this->unit == '1')
                $this->amount = $this->amount / 1000;
            if($this->unit== '3')
                $this->amount = $this->amount * 1000;



           $stored =  Product::updateOrCreate(['id' => $this->productId], [
                'warehouse_id' => $this->warehouseId,
                'ingredient_id' => $this->name,
                'supplier_id' => $this->supplierId,
                'is_supplied' => $this->isSupplied,
                'unit' => 2,
                'amount' => $this->amount,
            ]);

        
            if($stored){
                 StockHistory::create([
                'user_id' => auth()->user()->id,
                'warehouse_id' => $this->warehouseId,
                'ingredient_id' => $this->name,
                'supplier_id' => $this->supplierId,
                'unit' => $this->unit,
                'amount' => $this->amount,
            ]);
            }
        }


        $this->isModalClose();
        $this->emit('saved', 'Product successfully Created.');
        $this->resetInputFields();
    }


    public function delete()
    {
        if ($this->deleteId) {
            Product::find($this->deleteId)->delete();

            $this->emit('saved', 'Product Deleted Successfully.');

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
        $this->productId = '';
        $this->name = '';
        $this->amount = '';
        $this->unit = '';
        $this->warehouseId = '';
        $this->supplierId = '';
        $this->isSupplied = 0;


    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
