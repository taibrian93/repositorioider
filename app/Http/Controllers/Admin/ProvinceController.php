<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProvinceController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Leer Provincia')->only('index','show');
        $this->middleware('can:Crear Provincia')->only('create', 'store');
        $this->middleware('can:Editar Provincia')->only('edit', 'update');
        $this->middleware('can:Eliminar Provincia')->only('destroy');
    }
    public function getProvince(Request $request){
        $province = Province::select('codigo','codigoProvincial')->where('id','=', $request->idProvince)->first();
        echo json_encode($province);
    }

    public function allProvince(Request $request){
        $allProvince = Province::select('districts.id AS idDistrict', 'districts.descripcion AS district', 'population_centers.id AS idPopulationCenter',  'population_centers.descripcion AS populationCenter')
                        ->leftJoin('districts', 'districts.idProvince', '=', 'provinces.id')
                        ->leftJoin('population_centers', 'population_centers.idDistrict', '=', 'districts.id')
                        ->where('provinces.codigo','=', $request->codigo)->get();
        echo json_encode($allProvince);
    }

    public function getListProvinces(Request $request){
        $provinces = Province::select('provinces.*')
                    ->leftJoin('departments', 'departments.id', '=', 'provinces.idDepartment')
                    ->where('departments.codigoDepartamental', '=', $request->codigoDepartamental)
                    ->orderBy('codigo', 'asc')
                    ->get();
        
        echo json_encode($provinces);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $province = Province::class;
        return view('admin.provinces.index',compact('province'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::pluck('descripcion','id');
        return view('admin.provinces.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'idDepartment' => 'required',
            'descripcion' => 'required|min:4',
            'codigoProvincial' => 'required|min:4|max:4|regex:/^[0-9]*$/|unique:provinces,codigoProvincial',
            'codigo' => 'required',
            'estado' => 'required',
        ]);

        Province::create($request->all());
        return redirect()->route('admin.provinces.index')->with('info', $request->codigo);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function show(Province $province)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function edit(Province $province)
    {
        $departments = Department::pluck('descripcion','id');
        return view('admin.provinces.edit', compact('province','departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Province $province)
    {
        $request->validate([
            'idDepartment' => 'required',
            'descripcion' => 'required|min:4',
            'codigoProvincial' => 'required|min:4|max:4|regex:/^[0-9]*$/|unique:provinces,codigoProvincial,' . $province->id,
            'codigo' => 'required',
            'estado' => 'required',
        ]);

        $province->update($request->all());
        return redirect()->route('admin.provinces.edit', $province)->with('info', $province->codigo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function destroy(Province $province)
    {
        //
    }
}
