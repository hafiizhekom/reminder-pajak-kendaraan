<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidatorValidator;
use App\Http\Requests\VehicleCreateRequest;
use App\Http\Requests\VehicleEditRequest;
use App\Http\Requests\VehicleDeleteRequest;
use App\Http\Requests\VehicleEditTaxRequest;
use App\Http\Requests\VehicleEditSTNKRequest;


class VehicleController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $data = Vehicle::get();
        return view('vehicle', ['data'=>$data->toJson(), 'page'=>'Vehicle']);
    }

    public function create(VehicleCreateRequest $request)
    {
        $data = $request->validated();
        
        
        $vehicle = new Vehicle();
        $vehicle->area_code = strtoupper($data['area_code']);
        $vehicle->number = $data['number'];
        $vehicle->code = strtoupper($data['code']);
        $vehicle->tax_validity_period = $data['tax_validity_period'];
        $vehicle->stnk_validity_period = $data['stnk_validity_period'];

        if($vehicle->save()){
            return redirect('vehicle');
        }
    }

    public function edit(VehicleEditRequest $request)
    {
        $data = $request->validated();
        
        
        $vehicle = Vehicle::find($data['id']);
        $vehicle->area_code = strtoupper($data['area_code']);
        $vehicle->number = $data['number'];
        $vehicle->code = strtoupper(strtoupper($data['code']));
        $vehicle->tax_validity_period = $data['tax_validity_period'];
        $vehicle->stnk_validity_period = $data['stnk_validity_period'];
        
        if($vehicle->save()){
            return redirect('vehicle');
        }
    }

    public function editTax(VehicleEditTaxRequest $request)
    {
        $data = $request->validated();
        
        
        $vehicle = Vehicle::find($data['id']);
        $currentPeriod = $vehicle->tax_validity_period;
        $currentPeriod = strtotime($currentPeriod);
        $nextPeriod = strtotime('+1 years', $currentPeriod);
        $vehicle->tax_validity_period = date('Y-m-d', $nextPeriod);
        
        if($vehicle->save()){
            return redirect('vehicle');
        }
    }

    public function editSTNK(VehicleEditSTNKRequest $request)
    {
        $data = $request->validated();
        
        
        $vehicle = Vehicle::find($data['id']);
        $currentPeriod = $vehicle->stnk_validity_period;
        $currentPeriod = strtotime($currentPeriod);
        $nextPeriod = strtotime('+5 years', $currentPeriod);
        $vehicle->stnk_validity_period = date('Y-m-d', $nextPeriod);
        
        if($vehicle->save()){
            return redirect('vehicle');
        }
    }


    public function destroy(VehicleDeleteRequest $request)
    {
        $data = $request->validated();
        
        
        $vehicle = Vehicle::find($data['id']);
        
        if($vehicle->delete()){
            return redirect('vehicle');
        }
    }
}
