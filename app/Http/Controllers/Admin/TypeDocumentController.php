<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TypeDocument;
use Illuminate\Http\Request;

class TypeDocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Leer Tipo Documento')->only('index','show');
        $this->middleware('can:Crear Tipo Documento')->only('create', 'store');
        $this->middleware('can:Editar Tipo Documento')->only('edit', 'update');
        $this->middleware('can:Eliminar Tipo Documento')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $typeDocument = TypeDocument::class;
        return view('admin.typeDocuments.index',compact('typeDocument'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.typeDocuments.create');
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
            'codigo' => 'required|min:1|max:4|regex:/^[0-9]*$/|unique:type_documents,codigo',
            'estado' => 'required',
        ]);
        //return $request->all();
        TypeDocument::create($request->all());
        return redirect()->route('admin.typeDocuments.index')->with('info', $request->codigo);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeDocument $typeDocument)
    {
        return view('admin.typeDocuments.edit', compact('typeDocument'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeDocument $typeDocument)
    {
        $request->validate([
            'descripcion' => 'required|min:4',
            'codigo' => 'required|min:1|max:4|regex:/^[0-9]*$/|unique:type_documents,codigo,' . $typeDocument->id,
            'estado' => 'required',
        ]);

        $typeDocument->update($request->all());

        return redirect()->route('admin.typeDocuments.edit',$typeDocument)->with('info', $typeDocument->codigo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
