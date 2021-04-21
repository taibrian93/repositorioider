<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TypeExtension;
use App\Models\TypeFormat;
use Illuminate\Http\Request;

class TypeExtensionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Leer Tipo Extension')->only('index','show');
        $this->middleware('can:Crear Tipo Extension')->only('create', 'store');
        $this->middleware('can:Editar Tipo Extension')->only('edit', 'update');
        $this->middleware('can:Eliminar Tipo Extension')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typeExtension = TypeExtension::class;
        return view('admin.typeExtensions.index', compact('typeExtension'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $typeFormats = TypeFormat::pluck('descripcion','id');
        return view('admin.typeExtensions.create', compact('typeFormats'));
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
            'idTypeFormat' => 'required',
            'descripcion' => 'required|min:2|unique:type_extensions,descripcion',
            'estado' => 'required',
        ]);

        TypeExtension::create($request->all());
        return redirect()->route('admin.typeExtensions.index')->with('info', $request->descripcion);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypeExtension  $typeExtension
     * @return \Illuminate\Http\Response
     */
    public function show(TypeExtension $typeExtension)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypeExtension  $typeExtension
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeExtension $typeExtension)
    {
        $typeFormats = TypeFormat::pluck('descripcion','id');
        return view('admin.typeExtensions.edit', compact('typeExtension', 'typeFormats'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeExtension  $typeExtension
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeExtension $typeExtension)
    {
        $request->validate([
            'idTypeFormat' => 'required',
            'descripcion' => 'required|min:2|unique:type_extensions,descripcion,' . $typeExtension->id,
            'estado' => 'required',
        ]);

        $typeExtension->update($request->all());

        return redirect()->route('admin.typeExtensions.edit', $typeExtension)->with('info', $typeExtension->descripcion);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeExtension  $typeExtension
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeExtension $typeExtension)
    {
        //
    }
}
