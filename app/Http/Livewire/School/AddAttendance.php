<?php

namespace App\Http\Livewire\School;

use App\Models\District;
use App\Models\Province;
use App\Models\School;
use App\Models\SchoolAttendance;
use Livewire\Component;

class AddAttendance extends Component
{

    public $male = 0;
    public $female = 0;
    public $className;
    public $attendanceId;

    public $search = '';

    public $deleteId;
    public $isOpen = false;
    public $confirmDeletion = false;

    public $provinces;
    public $schools;
    public $districts;

    public $selectedProvince = null;
    public $selectedSchool = null;
    public $selectedDistrict = null;


    protected $rules = [
        'male' => 'required_without:female',
        'selectedSchool' => 'required',
        'selectedProvince' => 'required',
        'selectedDistrict' => 'required',
        'female' => 'required_without:male',
    ];

    public function mount($selectedDistrict = null)
    {

        $this->provinces = Province::orderBy('name')->get();
        $this->districts = collect();
        $this->schools = collect();
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

    public function updatedSelectedDistrict($district)
    {
        if (!is_null($district)) {
            $this->schools = School::where('district_id', $district)->get();
        }
    }


    public function render()
    {
        return view('livewire.school.add-attendance', [
            'attendances' => SchoolAttendance::with('school')->latest()->paginate(10)
        ]);
    }

    public function create()
    {
        $this->isModalOpen();
        $this->resetInputFields();

    }

    public function edit($id)
    {

        $record = SchoolAttendance::findOrFail($id);
        $this->attendanceId = $record->id;
        $this->selectedSchool = $record->school_id;
        $this->male = $record->male;
        $this->female = $record->female;
        $this->className = $record->class_name;
        $this->districts = District::where('province_id', $record->school->district->province->id)->get();
        $this->selectedProvince = $record->school->district->province->id;
        $this->selectedDistrict = $record->school->district_id;
        $this->schools = School::where('district_id', $this->selectedDistrict)->get();

        $this->isModalOpen();

    }


    public function saveSchool()
    {

        $this->validate();
        if(!$this->male) $this->male = null;
        if(!$this->female) $this->female = null;
        SchoolAttendance::updateOrCreate(['id' => $this->attendanceId], [
            'school_id' => $this->selectedSchool,
            'male' => $this->male,
            'female' => $this->female,
            'class_name' => $this->className,
        ]);

        $this->isModalClose();
        $this->emit('saved', 'Attendance successfully added.');
//        $this->emit('refreshDatatable');
        $this->resetInputFields();
    }


    public function delete()
    {
        if ($this->deleteId) {
            SchoolAttendance::find($this->deleteId)->delete();

            $this->emit('saved', 'Attendance Deleted Successfully.');

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
        $this->selectedSchool = '';
        $this->attendanceId = '';
        $this->className = '';
        $this->male = '';
        $this->female = '';
        $this->selectedDistrict = '';
        $this->selectedProvince = '';
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
