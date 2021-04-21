<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Node;
use Illuminate\Http\Request;

class NodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Leer Nodo')->only('index','show');
        $this->middleware('can:Crear Nodo')->only('create', 'store');
        $this->middleware('can:Editar Nodo')->only('edit', 'update');
        $this->middleware('can:Eliminar Nodo')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $node = Node::class;
        return view('admin.nodes.index', compact('node'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.nodes.create');
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
            'siglas' => 'required|min:1',
            'codigo' => 'required|min:1|max:4|regex:/^[0-9]*$/|unique:nodes,codigo',
            'estado' => 'required',
        ]);
        //return $request->all();
        Node::create($request->all());
        return redirect()->route('admin.nodes.index')->with('info', $request->codigo);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Node  $node
     * @return \Illuminate\Http\Response
     */
    public function show(Node $node)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Node  $node
     * @return \Illuminate\Http\Response
     */
    public function edit(Node $node)
    {
        return view('admin.nodes.edit', compact('node'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Node  $node
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Node $node)
    {
        $request->validate([
            'descripcion' => 'required|min:4',
            'siglas' => 'required|min:1',
            'codigo' => 'required|min:1|max:4|regex:/^[0-9]*$/|unique:nodes,codigo,' . $node->id,
            'estado' => 'required',
        ]);

        $node->update($request->all());

        return redirect()->route('admin.nodes.edit',$node)->with('info', $node->codigo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Node  $node
     * @return \Illuminate\Http\Response
     */
    public function destroy(Node $node)
    {
        //
    }
}
