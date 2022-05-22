<?php

namespace App\Http\Controllers;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{

    private function validateFields($request){
        $request->validate([
            'name'=>'required|min:3',
        ]);
    }

    public function index()
    {

        return view("web.warehouse.warehouse",[
            'warehouses' => Warehouse::with('province.warehouse')->latest()->paginate(6)]);

    }


    public function create()
    {
        return view("web.warehouse.add-warehouse");

    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $warehouse = Warehouse::find($id);
        return view('web.warehouse.update-warehouse',['warehouse'=>$warehouse]);
    }


    public function update(Request $request, $id)
    {
        $this->validateFields($request);
        $warehouse = Warehouse::find($id);

        $warehouse->name = $request->get('name');
        $warehouse->province_id = $request->get('province');
        $warehouse->district = $request->get('district');
        is_null($request->get('status')) ? $warehouse->status = 0: $warehouse->status =   1;

        $warehouse->description = $request->get('description');
        $warehouse->save();


       return redirect()->route('warehouse.index')->with('message','Warehouse Updated successfully');
    }


    public function destroy($id)
    {

        Warehouse::find($id)->delete();
        return redirect()->route('warehouse.index')
            ->with('success','Product deleted successfully');
    }
}
