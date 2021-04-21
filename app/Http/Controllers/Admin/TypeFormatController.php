<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TypeFormat;
use Illuminate\Http\Request;

class TypeFormatController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Leer Tipo Formato')->only('index','show');
        $this->middleware('can:Crear Tipo Formato')->only('create', 'store');
        $this->middleware('can:Editar Tipo Formato')->only('edit', 'update');
        $this->middleware('can:Eliminar Tipo Formato')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $typeFormat = TypeFormat::class;
        return view('admin.typeFormats.index', compact('typeFormat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.typeFormats.create');
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
            'codigo' => 'required|min:1|max:2|regex:/^[0-9]*$/|unique:type_formats,codigo',
            'estado' => 'required',
        ]);

        TypeFormat::create($request->all());
        return redirect()->route('admin.typeFormats.index')->with('info', $request->codigo);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypeFormat  $typeFormat
     * @return \Illuminate\Http\Response
     */
    public function show(TypeFormat $typeFormat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypeFormat  $typeFormat
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeFormat $typeFormat)
    {
        return view('admin.typeFormats.edit', compact('typeFormat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeFormat  $typeFormat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeFormat $typeFormat)
    {
        $request->validate([
            'descripcion' => 'required|min:4',
            'codigo' => 'required|min:1|max:2|regex:/^[0-9]*$/|unique:type_formats,codigo,' . $typeFormat->id,
            'estado' => 'required',
        ]);

        $typeFormat->update($request->all());

        return redirect()->route('admin.typeFormats.edit', $typeFormat)->with('info', $typeFormat->codigo);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeFormat  $typeFormat
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeFormat $typeFormat)
    {
        //
    }
}
