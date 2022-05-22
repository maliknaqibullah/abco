<?php

namespace App\Http\Livewire\Dashboard;
use App\Models\BakeryOrder;
use App\Models\Product;
use Asantibanez\LivewireCharts\Models\AreaChartModel;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use App\Models\School;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    public $types = ['sugar', 'flour', 'raisins', 'walnuts'];
    public $columnType = ['school', 'male', 'female', 'loaves_qty','distributed_loaves'];
    public $colors = [
        'sugar' => '#F519B6',
        'flour' => '#f56642',
        'oil' => '#90cdf4',
        'raisins' => '#66DA26',
        'walnuts' => '#f6ad55',
    ];

    public $firstRun = true;
    protected $listeners = [
        'onPointClick' => 'handleOnPointClick',
        'onSliceClick' => 'handleOnSliceClick',
        'onColumnClick' => 'handleOnColumnClick',
    ];
    public function handleOnPointClick($point)
    {
        dd($point);
    }
    public function handleOnSliceClick($slice)
    {
        dd($slice);
    }
    public function handleOnColumnClick($column)
    {
        dd($column);
    }
    public function render()
    {

        $products = Product::with(['ingredient' => function ($query) {
            $query->whereIn('name',$this->types);
        }])
           ->select(DB::raw('sum(amount) as amount,ingredient_id'))
           ->groupBy('ingredient_id')->get();


        $orders = BakeryOrder::all();
        $orders = BakeryOrder::with('school','warehouse','bakery')
            ->select(
                DB::raw("SUM(loaves_qty) as Total_Bread_Baked"),
                DB::raw("SUM(distributed_loaves) as Total_Distributed_Breads"),
                DB::raw("school_id as school"),
                DB::raw("id as id"),
            )
            ->orderBy("created_at")
            ->groupBy(DB::raw("year(created_at)"),DB::raw('id'),DB::raw('school_id'))
            ->get();



        $pieChartModel = $products->groupBy('type')
            ->reduce(function (PieChartModel $pieChartModel, $data) {
              foreach ($data as $stock){
                  $name = strtolower($stock->ingredient->name);
                  $value = $stock->amount;
                   $pieChartModel->addSlice($name, $value, $this->colors[$name]);
              }
              return $pieChartModel;
            }, (new PieChartModel())
                ->setAnimated($this->firstRun)
                ->setOpacity(100)
                ->withOnSliceClickEvent('onSliceClick')
            );


        $columnChartModel = $orders->groupBy('columnType')
            ->reduce(function (ColumnChartModel $columnChartModel, $data) {
                $columnChartModel->addColumn('Total Loaves Baked',
                    BakeryOrder::where('is_supplied',1)->sum('loaves_qty'),'#f56642');
                $columnChartModel->addColumn('Total Loaves Distributed',
                    BakeryOrder::where('is_supplied',1)->sum('distributed_loaves'),'#f6ad55');
//                $columnChartModel->addColumn('Total Schools Covered',
//                    DB::table('bakery_orders')->where('is_supplied',1)
//                        ->distinct('school_id')->count('school_id'),'#3374FF');
                $columnChartModel->addColumn('Total Male Covered',
                    BakeryOrder::where('is_supplied',1)->sum('male'),'#3374FF');
                $columnChartModel->addColumn('Total Female Covered',
                    BakeryOrder::where('is_supplied',1)->sum('female'),'#AF33FF');

                return $columnChartModel;
            }, (new ColumnChartModel())
                ->setAnimated($this->firstRun)
                ->setOpacity(100)
                ->withOnColumnClickEventName('onColumnClick')
            );
        $lineChartModel = $orders
            ->reduce(function (LineChartModel $lineChartModel, $data) use ($orders) {
                $index = $orders->search($data);
                $amountSum = $orders->take($index + 1)->sum('loaves_qty');
                if ($index == 6) {
                    $lineChartModel->addMarker(7, $amountSum);
                }
                if ($index == 11) {
                    $lineChartModel->addMarker(12, $amountSum);
                }

                    return $lineChartModel->addPoint(0, $amountSum, ['id' => $data->id]);


            }, (new LineChartModel())
                ->setTitle('Baked Bread+')
                ->setAnimated($this->firstRun)
                ->withOnPointClickEvent('onPointClick')
            );
//        $areaChartModel = $expenses
//            ->reduce(function (AreaChartModel $areaChartModel, $data) use ($expenses) {
//                return $areaChartModel->addPoint($data->description, $data->amount, ['id' => $data->id]);
//            }, (new AreaChartModel())
//                ->setTitle('Expenses Peaks')
//                ->setAnimated($this->firstRun)
//                ->setColor('#f6ad55')
//                ->withOnPointClickEvent('onAreaPointClick')
//                ->setXAxisVisible(false)
//                ->setYAxisVisible(true)
//            );
        $schools = School::all();
        $this->firstRun = false;
        return view('livewire.dashboard.dashboard')
            ->with([
                'columnChartModel' => $columnChartModel,
                'pieChartModel' => $pieChartModel,
                'schools' => $schools,
                'lineChartModel' => $lineChartModel,
//                'areaChartModel' => $areaChartModel,
            ]);
    }

}
