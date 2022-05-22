<?php

namespace App\Http\Livewire\Roles;

use App\Models\Permission;
use App\Models\Role;
use Livewire\Component;

class UserRole extends Component
{
    public $title;
    public $selection=[];

    public $deleteId;
    public $isOpen = false;
    public $confirmDeletion = false;

    public $roleId;

    protected $rules = [
        'title'=>'required',
    ];

    public function render()
    {

        return view('livewire.roles.user-role',[
            'roles' => Role::orderBy('title')->paginate(20),
            'permissions' => Permission::all()
        ]);

    }


    public function create()
    {
        $this->isModalOpen();
        $this->resetInputFields();

    }
    public function edit($id)
    {
        $record = Role::findOrFail($id);
        $this->roleId = $record->id;
        $this->title = $record->title;
        $this->isModalOpen();

    }


    public function saveRole()
    {
        $this->validate();
       $role = Role::updateOrCreate( ['id'=>$this->roleId],[
            'title' => $this->title,
        ]);
       $role->permissions()->sync($this->selection);

        $this->isModalClose();
        $this->emit('saved','Role successfully Created.');
        $this->resetInputFields();
    }


    public function delete()
    {
        if($this->deleteId){
            Role::find($this->deleteId)->delete();

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
        $this->roleId = '';
        $this->title = '';

    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

}
