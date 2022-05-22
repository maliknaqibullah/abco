<?php

namespace App\Http\Livewire\AddPermission;

use App\Models\Permission;
use Livewire\Component;

class AddPermission extends Component
{
    public $title;

    public $deleteId;
    public $isOpen = false;
    public $confirmDeletion = false;
    public $permissionId;

    protected $rules = [
        'title'=>'required',
    ];

    public function render()
    {
        return view('livewire.permission.permission',[
            'permissions' => Permission::orderBy('title')->paginate(20)
        ]);

    }



    public function create()
    {
        $this->isModalOpen();
        $this->resetInputFields();

    }
    public function edit($id)
    {
        $record = Permission::findOrFail($id);
        $this->permissionId = $record->id;
        $this->title = $record->title;
        $this->isModalOpen();

    }


    public function savePermission()
    {
        $this->validate();
        Permission::updateOrCreate( ['id'=>$this->permissionId],[
            'title' => $this->title,
        ]);

        $this->isModalClose();
        $this->emit('saved','Permission successfully Created.');
        $this->resetInputFields();
    }


    public function delete()
    {
        if($this->deleteId){
            Permission::find($this->deleteId)->delete();

            $this->emit('saved','Item Deleted Successfully.');

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
        $this->permissionId = '';
        $this->title = '';

    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

}
