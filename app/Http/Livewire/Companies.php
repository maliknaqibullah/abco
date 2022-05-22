<?php

namespace App\Http\Livewire;

use App\Models\District;
use App\Models\Company;
use App\Models\Province;
use App\Models\Location;
use Livewire\Component;

class Companies extends Component
{
    public $countries;
    public $cities;

    public $name;
    public $country;
    public $city;

    public $designTemplate = 'tailwind';

    public function mount()
    {
//        $this->countries = Province::all();
        $this->countries = Location::where('id','<=',34)->orderBy('title')->get();
        $this->cities = collect();
    }

    public function render()
    {
//        return view('livewire.'. $this->designTemplate .'.companies', [
//            'companies' => Company::with('city.country')->latest()->take(5)->get()
//        ]);
        return view('livewire.tailwind.companies');
    }

    public function updatedCountry($value)
    {
        $this->cities = Location::where('parent_id', $value)->orderBy('title')->get();
//        $this->city = $this->cities->first()->id ?? null;
    }

    public function storeCompany()
    {
        $this->validate([
            'name' => 'required',
            'city' => 'required',
        ]);

        Company::create([
            'name' => $this->name,
            'city_id' => $this->city,
        ]);

        $this->name = '';
        $this->country = '';
        $this->city = '';
        $this->cities = collect();
    }
}
