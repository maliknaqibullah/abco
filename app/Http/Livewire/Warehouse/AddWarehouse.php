<?php

namespace App\Http\Livewire\Warehouse;

use App\Models\District;
use App\Models\Province;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Response;

class AddWarehouse extends Component
{
    public $isModalOpen = false;
    public $name;
    public $status = 0;
    public $description;

    public $confirmDeletion = false;


    public $provinces;
    public $districts;
    public $warehouse_id;

    public $selectedProvince = null;
    public $selectedDistrict = null;

    public $isUpdating = null;
    protected $rules = [
        'name'=>'required|min:3',
        'selectedProvince' => 'required',
        'selectedDistrict' => 'required',
    ];
    /**
     * @var mixed
     */
    public $deleteId;


    public function mount($selectedDistrict = null)
    {


        $this->provinces = Province::orderBy('name')->get();
        $this->districts = collect();
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
        }
    }



    public function render()
    {

        abort_if(Gate::denies('warehouse'), Response::HTTP_FORBIDDEN, ' Forbidden');

        return view('livewire.warehouse.add-warehouse', [
            'warehouses' => Warehouse::with('district.warehouse')->latest()->paginate(6)]);
    }
    public function create()
    {
        $this->isModalOpen();
        $this->resetInputFields();

    }



    public function saveWarehouse($selectedDistrict = null)
    {
        $this->validate();

        if (!$this->status)
            $this->status = 0;
      Warehouse::updateOrCreate( ['id'=>$this->warehouse_id],[
            'name' => $this->name,
            'district_id' => $this->selectedDistrict,
            'status' => $this->status,
            'description' => $this->description,
        ]);

        $this->isModalClose();
        $this->emit('saved','Warehouse successfully Created.');
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->warehouse_id = '';
        $this->selectedDistrict = '';
        $this->selectedProvince = '';
        $this->status = 0;
        $this->description = '';
    }

    public function edit($id)
    {
        $record = Warehouse::findOrFail($id);
        $this->districts = District::where('province_id', $record->district->province->id)->get();
        $this->selectedDistrict = $record->district_id;
        $this->selectedProvince = $record->district->province->id;
        $this->warehouse_id = $record->id;
        $this->name = $record->name;
        $this->status = $record->status;
        $this->description = $record->description;
        $this->isModalOpen();

    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
        $this->confirmDeletion = true;
    }
    public function delete()
    {
        if($this->deleteId){
             Warehouse::find($this->deleteId)->delete();
            session()->flash('message', 'Warehouse Deleted Successfully.');
            $this->confirmDeletion = false;
        }
    }


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function isModalOpen()
    {
        $this->isModalOpen = true;
    }

    public function isModalClose()
    {
        $this->isModalOpen = false;
        $this->resetErrorBag();

    }

}

