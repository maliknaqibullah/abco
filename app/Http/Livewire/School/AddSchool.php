<?php

namespace App\Http\Livewire\School;

use App\Models\District;
use App\Models\Province;
use App\Models\School;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Response;

class AddSchool extends Component
{
    public $male;
    public $type;
    public $female;
    public $name;
    public $schoolID;
    public $distance;

    public $search = '';
    public $schoolId;

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
        'type' => 'required',
    ];
    private SchoolLocation $schoolLocation;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->schoolLocation = new SchoolLocation($this);
    }

    public function mount($selectedDistrict = null)
    {
        $this->schoolLocation->mount($selectedDistrict);
    }


    public function render()
    {
        abort_if(Gate::denies('schools'), Response::HTTP_FORBIDDEN, 'Forbidden');

        return view('livewire.school.add-school',[
            'schools' => School::search('name',$this->search)->with('district.school')->latest()->paginate(20)
        ]);
    }
    public function updatedSelectedProvince($province)
    {
        $this->schoolLocation->updatedSelectedProvince($province);
    }

    public function create()
    {
        $this->isModalOpen();
        $this->resetInputFields();

    }
    public function edit($id)
    {
        $record = School::findOrFail($id);
        $this->schoolId = $record->id;
        $this->schoolID = $record->school_id;
        $this->name = $record->name;
        $this->type = $record->type;
        $this->male = $record->male;
        $this->female = $record->female;
        $this->distance = $record->distance;
        $this->districts = District::where('province_id',$record->district->province->id)->get();
        $this->selectedProvince = $record->district->province->id;
        $this->selectedDistrict = $record->district_id;
        $this->isModalOpen();

    }


    public function saveSchool()
    {
        if(!$this->male) $this->male = null;
        if(!$this->female) $this->female = null;
        if(!$this->distance) $this->distance = null;

        $this->validate();
        School::updateOrCreate( ['id'=>$this->schoolId],[
            'district_id' => $this->selectedDistrict,
            'school_id' => $this->schoolID,
            'name' => $this->name,
            'type' => $this->type,
            'male' => $this->male,
            'female' => $this->female,
            'distance' => $this->distance
        ]);

        $this->isModalClose();
        $this->emit('saved','School successfully Created.');
        $this->emit('refreshDatatable');
        $this->resetInputFields();
    }


    public function delete()
    {
        if($this->deleteId){
            School::find($this->deleteId)->delete();

            $this->emit('saved','School Deleted Successfully.');

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
        $this->schoolID = '';
        $this->name = '';
        $this->type = 0;
        $this->male = '';
        $this->female = '';
        $this->distance = '';
        $this->selectedDistrict = '';
        $this->selectedProvince = '';



    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
