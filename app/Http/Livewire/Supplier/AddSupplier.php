<?php

namespace App\Http\Livewire\Supplier;

use App\Models\Supplier;
use Livewire\Component;

class AddSupplier extends Component
{
    public $search = '';

    public $isOpen;
    public $deleteId;
    public $confirmDeletion;

    public $name;
    public $phone;
    public $email;
    public $status;
    public $imgUrl;
    public $description;
    public $supplierId;

    protected $rules = [
        'name'=>'required',
    ];

    public function render()
    {
        return view('livewire.supplier.add-supplier',[
        'suppliers' => Supplier::search('name',$this->search)->latest()->paginate(8)
        ]);
    }


    public function create()
    {
        $this->isModalOpen();
        $this->resetInputFields();

    }
    public function edit($id)
    {
        $record = Supplier::findOrFail($id);
        $this->supplierId = $record->id;
        $this->name = $record->name;
        $this->phone = $record->phone;
        $this->email = $record->email;
        $this->imgUrl = $record->imgUrl;
        $this->status = $record->status;
        $this->description = $record->description;
        $this->isModalOpen();

    }


    public function saveSupplier()
    {

        $this->validate();
        if (!$this->status)
            $this->status = 0;
        Supplier::updateOrCreate( ['id'=>$this->supplierId],[
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'imgUrl' => $this->imgUrl,
            'status' => $this->status,
            'description' => $this->description,
        ]);

        $this->isModalClose();
        $this->emit('saved','Supplier successfully Created.');
        $this->resetInputFields();
    }


    public function delete()
    {
        if($this->deleteId){
            Supplier::find($this->deleteId)->delete();
            $this->emit('saved','Supplier Deleted Successfully.');
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
        $this->supplierId = '';
        $this->name = '';
        $this->phone = '';
        $this->email = '';
        $this->imgUrl = '';
        $this->status = '';
        $this->description = '';

    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
