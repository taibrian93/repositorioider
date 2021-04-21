<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Leer Departamento')->only('index','show');
        $this->middleware('can:Crear Departamento')->only('create', 'store');
        $this->middleware('can:Editar Departamento')->only('edit', 'update');
        $this->middleware('can:Eliminar Departamento')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $department = Department::class;
        return view('admin.departments.index',compact('department'));
    }


    public function getDepartment(Request $request){
        $department = Department::select('codigoDepartamental')->where('id','=', $request->idDepartment)->first();
        echo json_encode($department);
    }

    public function allDepartment(Request $request){
        $allDepartment = Department::select('provinces.id AS idProvince',  'provinces.descripcion AS province', 'districts.id AS idDistrict', 'districts.descripcion AS district', 'population_centers.id AS idPopulationCenter',  'population_centers.descripcion AS populationCenter')
                        ->leftJoin('provinces', 'provinces.idDepartment', '=', 'departments.id')
                        ->leftJoin('districts', 'districts.idProvince', '=', 'provinces.id')
                        ->leftJoin('population_centers', 'population_centers.idDistrict', '=', 'districts.id')
                        ->where('provinces.codigo','=', $request->codigo)->get();
        echo json_encode($allDepartment);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.departments.create');
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
            'descripcion' => 'required|min:4',
            'codigoDepartamental' => 'required|min:1|max:2|regex:/^[0-9]*$/|unique:departments,codigoDepartamental',
            'estado' => 'required',
        ]);
        //return $request->all();
        Department::create($request->all());
        return redirect()->route('admin.departments.index')->with('info', $request->codigoDepartamental);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        return view('admin.departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'descripcion' => 'required|min:4',
            'codigoDepartamental' => 'required|min:1|max:2|regex:/^[0-9]*$/|unique:departments,codigoDepartamental,' . $department->id,
            'estado' => 'required',
        ]);

        $department->update($request->all());

        return redirect()->route('admin.departments.edit',$department)->with('info', $department->codigoDepartamental);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy($idDeparment)
    {
        //
        //$department->delete();
        Department::find($idDeparment)->delete();
    }
}
