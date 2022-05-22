<?php

namespace App\Http\Livewire;

use App\Models\District;
use App\Models\Province;
use Livewire\Component;

class ShowLocations extends Component
{
    public $provinces;
    public $districts;

    public $selectedProvince = null;
    public $selectedDistrict = null;
    protected $rules = [
        'selectedProvince' => 'required',
        'selectedDistrict' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


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
        return view('livewire.show-locations');
    }
    // public function update(){
//        $this->validate();
//        if ($this->update_id){
//            $record = Warehouse::find($this->update_id);
//            $record->update([
//                'name' => $this->name,
//                'province_id' => $this->province,
//                'district' => $this->district,
//                'status' => $this->status,
//                'description' => $this->description,
//            ]);
//            $this->resetInputFields();
//            $this->updateMode = false;
//        }
//}
}
