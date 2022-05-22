<?php

namespace App\Http\Livewire\Ingredient;

use App\Models\Ingredient;
use Livewire\Component;

class AddIngredient extends Component
{
    public $name;

    public $deleteId;
    public $isOpen = false;
    public $confirmDeletion = false;
    public $ingredientId;

    protected $rules = [
        'name'=>'required',
    ];

    public function render()
    {
        return view('livewire.ingredient.add-ingredient',[
            'ingredients' => Ingredient::latest()->paginate(6)
        ]);

    }



    public function create()
    {
        $this->isModalOpen();
        $this->resetInputFields();

    }
    public function edit($id)
    {
        $record = Ingredient::findOrFail($id);
        $this->ingredientId = $record->id;
        $this->name = $record->name;
        $this->isModalOpen();

    }


    public function saveIngredient()
    {
        $this->validate();
        Ingredient::updateOrCreate( ['id'=>$this->ingredientId],[
            'name' => $this->name,
        ]);

        $this->isModalClose();
        $this->emit('saved','Product successfully Created.');
        $this->resetInputFields();
    }


    public function delete()
    {
        if($this->deleteId){
            Ingredient::find($this->deleteId)->delete();

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
        $this->ingredientId = '';
        $this->name = '';

    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

}
