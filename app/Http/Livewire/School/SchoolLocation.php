<?php

namespace App\Http\Livewire\School;

use App\Models\District;
use App\Models\Province;

class SchoolLocation
{

    private  $addSchool;

    public function __construct($addSchool)
    {
        $this->addSchool = $addSchool;
    }

    public function updatedSelectedProvince($province)
    {
        if (!is_null($province)) {
            $this->addSchool->districts = District::where('province_id', $province)->get();
        }
    }

    public function mount($selectedDistrict = null)
    {
        $this->addSchool->provinces = Province::orderBy('name')->get();
        $this->addSchool->districts = collect();
        $this->addSchool->selectedDistrict = $selectedDistrict;

        if (!is_null($selectedDistrict)) {
            $district = District::with('province')->find($selectedDistrict);
            if ($district) {
                $this->addSchool->districts = District::where('province_id', $district->province_id)->get();
                $this->addSchool->selectedProvince = $district->province_id;
            }
        }
    }
}
