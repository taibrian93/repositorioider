<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Leer Distrito')->only('index','show');
        $this->middleware('can:Crear Distrito')->only('create', 'store');
        $this->middleware('can:Editar Distrito')->only('edit', 'update');
        $this->middleware('can:Eliminar Distrito')->only('destroy');
    }

    public function getDistrict(Request $request){
        $district = District::select('codigo', 'codigoDistrital')->where('id','=', $request->idDistrict)->first();
        echo json_encode($district);
    }

    public function getListDistricts(Request $request){
        $districts = District::select('districts.*')
                    ->leftJoin('provinces', 'provinces.id', '=', 'districts.idProvince')
                    ->where('provinces.codigoProvincial', '=', $request->codigoProvincial)
                    ->orderBy('codigo', 'asc')
                    ->get();
        
        echo json_encode($districts);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $district = District::class;
        return view('admin.districts.index', compact('district'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::pluck('descripcion','id');
        return view('admin.districts.create',compact('departments'));
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
            'idProvince' => 'required',
            'descripcion' => 'required|min:4',
            'codigoDistrital' => 'required|min:6|max:6|regex:/^[0-9]*$/|unique:districts,codigoDistrital',
            'codigo' => 'required|min:2|max:2',
            'estado' => 'required',
        ]);

        District::create($request->all());
        return redirect()->route('admin.districts.index')->with('info', $request->codigoDistrital);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function show(District $district)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function edit(District $district)
    {
        $departments = Department::pluck('descripcion','id');
        $district = District::select('districts.*', 'departments.id AS idDepartment')
                    ->leftJoin('provinces', 'provinces.id', '=', 'districts.idProvince')
                    ->leftJoin('departments', 'departments.id', '=', 'provinces.idDepartment')
                    ->where('districts.id', '=', $district->id)
                    ->first();
        
        $provinces = Province::select('descripcion', 'id')
                    ->where('idDepartment', '=', $district->idDepartment)
                    ->pluck('descripcion','id');

        return view('admin.districts.edit',compact('district', 'departments', 'provinces'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, District $district)
    {
        $request->validate([
            'idDepartment' => 'required',
            'idProvince' => 'required',
            'descripcion' => 'required|min:4',
            'codigoDistrital' => 'required|min:6|max:6|regex:/^[0-9]*$/|unique:districts,codigoDistrital,' . $district->id,
            'codigo' => 'required|min:2|max:2',
            'estado' => 'required',
        ]);

        $district->update($request->all());

        return redirect()->route('admin.districts.edit',$district)->with('info', $request->codigoDistrital);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function destroy(District $district)
    {
        //
    }
}
