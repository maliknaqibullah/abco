<?php

namespace App\Http\Livewire\Bakery;

use App\Http\Livewire\Location;
use App\Models\Bakery;
use App\Models\District;
use App\Models\Province;
use Livewire\Component;

class AddBakery extends Component
{
    public $name;

    public $bakeryId;
    public $search = '';
    public $deleteId;
    public $isOpen = false;
    public $confirmDeletion = false;

    public $provinces;
    public $districts;

    public $selectedProvince = null;
    public $selectedDistrict = null;

    protected $rules = [
        'name'=>'required',
        'selectedProvince' => 'required',
        'selectedDistrict' => 'required',
    ];
    private Location $location;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->location = new Location($this);
    }


    public function mount($selectedDistrict = null)
    {
        
        $this->location->mount($selectedDistrict);
    }
    public function updatedSelectedProvince($province)
    {
        if (!is_null($province)) {
            $this->districts = District::where('province_id', $province)->get();
        }
    }

    public function render()
    {
        return view('livewire.bakery.add-bakery',[
            'bakeries' => Bakery::search('name',$this->search)->with('district.bakery')->latest()->paginate(12)
        ]);
    }

    public function create()
    {
        $this->isModalOpen();
        $this->resetInputFields();

    }
    public function edit($id)
    {
        $record = Bakery::findOrFail($id);
        $this->bakeryId = $record->id;
        $this->name = $record->name;
        $this->districts = District::where('province_id', $record->district->province->id)->get();
        $this->selectedDistrict = $record->district_id;
        $this->selectedProvince = $record->district->province->id;
        $this->isModalOpen();

    }


    public function saveBakery()
    {
        $this->validate();
        Bakery::updateOrCreate( ['id'=>$this->bakeryId],[
            'district_id' => $this->selectedDistrict,
            'name' => $this->name,
        ]);

        $this->isModalClose();
        $this->emit('saved','bakery successfully Created.');
        $this->resetInputFields();
    }


    public function delete()
    {
        if($this->deleteId){
            Bakery::find($this->deleteId)->delete();

            $this->emit('saved','Bakery Deleted Successfully.');

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
        $this->bakeryId = '';
        $this->name = '';
        $this->selectedDistrict = '';
        $this->selectedProvince = '';



    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
