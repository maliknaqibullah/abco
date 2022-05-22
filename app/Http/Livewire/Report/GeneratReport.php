<?php

namespace App\Http\Livewire\Report;

use App\Exports\OrderExport;
use App\Models\BakeryOrder;
use App\Models\District;
use App\Models\Province;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Sheet;

class GeneratReport extends Component
{
    public $provinces;
    public $districts;
    public $selected = [];
    public $startDate;
    public $endDate;

    public $selectedProvince = null;
    public $selectedDistrict = null;

    public $filteredOrder;

    protected $rules = [
        'startDate' => 'required|date|before:endDate',
        'endDate' => 'required|date|after:startDate',
        'selectedProvince' => 'required',
    ];

    public function mount()
    {
        $this->filteredOrder = collect();
        // $this->selected = collect();

        $this->provinces = Province::orderBy('name')->get();
        $this->districts = collect();
    }


    public function updatedSelectedProvince($province)
    {
        if (!is_null($province)) {
            $this->districts = District::where('province_id', $province)->get();
        }
    }

    public function generateReport()
    {
        
        $this->validate();

        if (!$this->selectedDistrict) {
            $this->filteredOrder = BakeryOrder::whereHas('school', function (Builder $query) {
                $query->whereIn('district_id', $this->districts->pluck('id'));
            })
                ->where('order_date', '>=', $this->startDate . ' 00:00:00')
                ->where('order_date', '<=', $this->endDate . ' 23:59:59')
                ->get();
        } else {
            $this->filteredOrder = BakeryOrder::whereHas('school', function (Builder $query) {
                $query->where('district_id', $this->selectedDistrict);
            })
                ->where('created_at', '>=', $this->startDate . ' 00:00:00')
                ->where('created_at', '<=', $this->endDate . ' 23:59:59')
                ->get();

        }

    }

    public function resetFields()
    {
        $this->selectedDistrict = '';
        $this->selectedProvince = '';
        $this->filteredOrder = collect();
    }

    public function render()
    {

        return view('livewire.report.generat-report');
    }

    private function getSelectedProducts()
    {
        // return $this->selected->filter(fn($p) => $p)->keys();
        return $this->selected;
    }

      public function updatedSelectAll($value){
        if($value){
            
            $this->selected = $this->filteredOrder->pluck('id');
        }else{
            $this->selected = [];
        }
    }

    public function export(Sheet $excel, $ext)
    {

        return Excel::download(new OrderExport($this->getSelectedProducts()), 'products.' . $ext);
    }
}
