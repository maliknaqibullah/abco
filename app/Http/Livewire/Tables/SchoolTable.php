<?php

namespace App\Http\Livewire\Tables;

use App\Models\School;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class SchoolTable extends LivewireDatatable
{
    public function builder()
    {
        return School::query();
    }

    public function columns()
    {
        return [
            NumberColumn::name('school_id')
                ->label('School ID')
                ->sortBy('school_id')
                ->searchable(),

            Column::name('name')
                ->hideable()
                ->sortBy('name')
                 ->searchable(),
            Column::name('type')
                ->label('Type')
                ->sortBy('type')
                ->hideable(),
            NumberColumn::name('male')
                ->label('Male')
                ->hideable(),
          NumberColumn::name('female')
                    ->label('Female')
                    ->hideable(),
            Column::name('district.province.name')
                ->label('Province')
                ->searchable()
                ->defaultSort('desc')
                ->hideable(),
            Column::name('district.name')
                ->label('District')
                ->searchable()
                ->hideable(),
            NumberColumn::name('distance')
                ->label('Distance')
                ->hideable(),

            Column::callback(['id', 'name'], function ($id, $name) {
                return view('table-action', ['id' => $id, 'name' => $name]);
            })->unsortable()


        ];
    }
}
