<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\District;
use App\Models\PopulationCenter;
use App\Models\Province;
use Illuminate\Http\Request;

class PopulationCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $populationCenter = PopulationCenter::class;
        return view('admin.populationCenters.index', compact('populationCenter'));
    }

    public function getListPopulationCenters(Request $request){
        $populationCenters = PopulationCenter::select('population_centers.*')
                    ->leftJoin('districts', 'districts.id', '=', 'population_centers.idDistrict')
                    ->where('districts.codigoDistrital', '=', $request->codigoDistrital)
                    ->orderBy('codigo', 'asc')
                    ->get();
        
        echo json_encode($populationCenters);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $departments = Department::pluck('descripcion','id');
        return view('admin.populationCenters.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'idDepartment' => 'required',
            'idProvince' => 'required',
            'idDistrict' => 'required',
            'descripcion' => 'required|min:4',
            'codigoCentroPoblado' => 'required|min:10|max:10|regex:/^[0-9]*$/|unique:population_centers,codigoCentroPoblado',
            'codigo' => 'required|min:4|max:4',
            'estado' => 'required',
        ]);

        PopulationCenter::create($request->all());
        return redirect()->route('admin.populationCenters.index')->with('info', $request->codigoCentroPoblado);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PopulationCenter  $populationCenter
     * @return \Illuminate\Http\Response
     */
    public function show(PopulationCenter $populationCenter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PopulationCenter  $populationCenter
     * @return \Illuminate\Http\Response
     */
    public function edit(PopulationCenter $populationCenter)
    {
        //
        $departments = Department::pluck('descripcion','id');

        $populationCenter = PopulationCenter::select('population_centers.*', 'provinces.id AS idProvince', 'departments.id AS idDepartment', 'districts.id AS idDistrict')
                            ->leftJoin('districts', 'districts.id', '=', 'population_centers.idDistrict')
                            ->leftJoin('provinces', 'provinces.id', '=', 'districts.idProvince')
                            ->leftJoin('departments', 'departments.id', '=', 'provinces.idDepartment')
                            ->where('population_centers.id', '=', $populationCenter->id)
                            ->first();

        $districts = District::select('descripcion', 'id')
                    ->where('idProvince', '=', $populationCenter->idProvince)
                    ->pluck('descripcion','id');
        
        $provinces = Province::select('descripcion', 'id')
                    ->where('idDepartment', '=', $populationCenter->idDepartment)
                    ->pluck('descripcion','id');

        //return  $district;

        return view('admin.populationCenters.edit',compact('districts', 'departments', 'provinces', 'populationCenter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PopulationCenter  $populationCenter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PopulationCenter $populationCenter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PopulationCenter  $populationCenter
     * @return \Illuminate\Http\Response
     */
    public function destroy(PopulationCenter $populationCenter)
    {
        //
    }
}
