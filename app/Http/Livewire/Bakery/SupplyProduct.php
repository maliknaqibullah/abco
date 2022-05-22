<?php

namespace App\Http\Livewire\Bakery;

use App\Models\Bakery;
use App\Models\BakeryOrder;
use App\Models\District;
use App\Models\Product;
use App\Models\Province;
use App\Models\School;
use App\Models\Warehouse;
use Livewire\Component;

class SupplyProduct extends Component
{
    public $schoolId;
     public $distributionDate;
    public $productId;
    public $warehouseId;
    public $bakeryId;
    public $male;
    public $isSupplied;
    public $female;
    public $loaves;
    public $distributedLoaves;
    public $BakeryOrderId;

    public $lowStock = false;
    public $lowStockMessage = '';

    public $deleteId;
    public $isOpen = false;
    public $confirmDeletion = false;

    public $products;
    public $provinces;
    public $districts;
    public $schools;
    public $bakeries;


    public $selectedProvince = null;
    public $selectedDistrict = null;

    protected $rules = [
        'distributionDate' => 'required|date',
        'bakeryId' => 'required',
        'warehouseId' => 'required',
        'schoolId' => 'required',
        'male' => 'required_without:female',
        'female' => 'required_without:male',
        'loaves' => 'required',
        'distributedLoaves' => 'required|lte:loaves',
        'selectedProvince' => 'required',
        'selectedDistrict' => 'required',
    ];


    public function render()
    {


        $this->products = Product::with('warehouse.district')->get();

        return view('livewire.bakery.supply-product', [
            'BakeryOrder' => BakeryOrder::latest()->paginate(6),
            'warehouses' => Warehouse::whereHas('product')->get()
        ]);
    }


    public function create()
    {
        $this->isModalOpen();
        $this->resetInputFields();

    }

    public function edit($id)
    {
//        $record = BakeryOrder::findOrFail($id);
//        $this->BakeryOrderId = $record->id;
//        $this->schoolId = $record->school_id;
//        $this->warehouseId = $record->product->warehouse->id;
//        $this->bakeryId = $record->bakery_id;
//        $this->productId = 2;
//        $this->male = $record->male;
//        $this->female = $record->female;
//        $this->loaves = $record->loaves_qty;
//        $this->isSupplied = $record->is_supplied;
//        $this->districts = District::where('province_id', $record->school->district->province->id)->get();
//        $this->selectedProvince = $record->school->district->province->id;
//        $this->selectedDistrict = $record->school->district->id;
        $this->isModalOpen();

    }


    public function supplyProducts()
    {
        $this->validate();

        if (!$this->isSupplied) $this->isSupplied = 0;
        if (!$this->male) $this->male = 0;
        if (!$this->female) $this->female = 0;
        BakeryOrder::updateOrCreate(['id' => $this->BakeryOrderId], [
            'school_id' => $this->schoolId,
            'order_date' => $this->distributionDate,
            'bakery_id' => $this->bakeryId,
            'warehouse_id' => $this->warehouseId,
            'male' => $this->male,
            'female' => $this->female,
            'loaves_qty' => $this->loaves,
            'distributed_loaves' => $this->distributedLoaves,
            'is_supplied' => $this->isSupplied,
        ]);
        if (!$this->lowStock && $this->isSupplied) {
            foreach ($this->products as $pro) {
                if (strtolower($pro->ingredient->name) == 'flour' ||
                    strtolower($pro->ingredient->name) == 'wheat' ||
                    strtolower($pro->ingredient->name) == 'fortified wheat flour') {
                    Product::with('ingredient')->where('ingredient_id', $pro->ingredient_id)
                        ->decrement('amount',$this->loaves * 0.16);
                }
                if (strtolower($pro->ingredient->name) == 'walnuts' ||
                    strtolower($pro->ingredient->name) == 'walnut') {
                    Product::with('ingredient')->where('ingredient_id', $pro->ingredient_id)
                        ->decrement('amount',$this->loaves * 0.007);
                }

                if (strtolower($pro->ingredient->name) == 'raisins' ||
                    strtolower($pro->ingredient->name) == 'raisin') {
                    Product::with('ingredient')->where('ingredient_id', $pro->ingredient_id)
                        ->decrement('amount', $this->loaves* 0.008);
                }
                if (strtolower($pro->ingredient->name) == 'sugar') {
                    Product::with('ingredient')->where('ingredient_id', $pro->ingredient_id)
                        ->decrement('amount', $this->loaves * 0.01);
                }
            }
        }
        $this->emit('saved', 'bakery successfully Created.');

        $this->isModalClose();
        $this->resetInputFields();
    }

    public function mount($selectedDistrict = null)
    {
        $this->provinces = Province::orderBy('name')->get();
        $this->districts = collect();
        $this->schools = collect();
        $this->bakeries = collect();
//        $this->selectedDistrict = $selectedDistrict;
//
//        if (!is_null($selectedDistrict)) {
//            $district = District::with('province')->find($selectedDistrict);
//            if ($district) {
//                $this->districts = District::where('province_id', $district->province_id)->get();
//                $this->selectedProvince = $district->province_id;
//            }
//        }

    }

    public function updatedSelectedProvince($province)
    {
        if (!is_null($province)) {
            $this->districts = District::where('province_id', $province)->get();
            $tem_pro = Province::find($province)->district->pluck('id');

            $this->bakeries = Bakery::whereIn('district_id', $tem_pro)->get();
        }
    }

    public function updatedSelectedDistrict($district)
    {
        if (!is_null($district)) {
            $this->schools = School::where('district_id', $district)->get();
        }
    }

    public function delete()
    {
        if ($this->deleteId) {
            BakeryOrder::find($this->deleteId)->delete();

            $this->emit('saved', 'Order Deleted Successfully.');

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
        $this->BakeryOrderId = '';
          $this->distributionDate = '';
        $this->schoolId = '';
        $this->bakeryId = '';
        $this->productId = '';
        $this->male = '';
        $this->female = '';
        $this->loaves = '';
        $this->distributedLoaves = '';
        $this->isSupplied = '';
        $this->selectedDistrict = '';
        $this->selectedProvince = '';


    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedLoaves($value)
    {
        $this->lowStock = false;
        $this->lowStockMessage = '';
        $this->products = Product::where('warehouse_id', $this->warehouseId)->get();
        if (count($this->products) > 3) {
            foreach ($this->products as $product) {

                if (strtolower($product->ingredient->name) == 'flour' ||
                    strtolower($product->ingredient->name) == 'wheat' ||
                    strtolower($product->ingredient->name) == 'fortified wheat flour') {

                    if ($product->amount < intval($this->loaves) * 0.16) {
                        $this->lowStock = true;
                        $this->lowStockMessage = 'Fortified Wheat Flour quantity is not enough to bake ';
                    }

                }
                if (strtolower($product->ingredient->name) == 'walnuts' ||
                    strtolower($product->ingredient->name) == 'walnut') {

                    if ($product->amount < intval($this->loaves) * 0.007) {
                        $this->lowStock = true;
                        $this->lowStockMessage = 'Walnuts quantity is not enough to bake';
                    }
                }
                if (strtolower($product->ingredient->name) == 'sugar') {

                    if ($product->amount < intval($this->loaves) * 0.01) {
                        $this->lowStock = true;
                        $this->lowStockMessage = 'Sugar quantity is not enough to bake';
                    }
                }
                if (strtolower($product->ingredient->name) == 'raisins' ||
                    strtolower($product->ingredient->name) == 'raisin') {

                    if ($product->amount < intval($this->loaves) * 0.008) {
                        $this->lowStock = true;
                        $this->lowStockMessage = 'Raisins quantity is not enough to bake';
                    }
                }
            }
        } else {
            $this->lowStock = true;
            $this->lowStockMessage = 'Sorry Not enough products in stock!!!';
        }


    }
}
