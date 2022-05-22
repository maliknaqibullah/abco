<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Bakery\AddBakery;
use App\Models\District;
use App\Models\Province;

class Location
{

    private AddBakery $addBakery;

    public function __construct(AddBakery $addBakery)
    {
        $this->addBakery = $addBakery;
    }

    public function mount($selectedDistrict = null)
    {
        $this->addBakery->provinces = Province::orderBy('name')->get();
        $this->addBakery->districts = collect();
        $this->addBakery->selectedDistrict = $selectedDistrict;

        if (!is_null($selectedDistrict)) {
            $district = District::with('province')->find($selectedDistrict);
            if ($district) {
                $this->addBakery->districts = District::where('province_id', $district->province_id)->get();
                $this->addBakery->selectedProvince = $district->province_id;
            }
        }
    }
}
