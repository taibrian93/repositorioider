<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Leer Lenguaje')->only('index','show');
        $this->middleware('can:Crear Lenguaje')->only('create', 'store');
        $this->middleware('can:Editar Lenguaje')->only('edit', 'update');
        $this->middleware('can:Eliminar Lenguaje')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $language = Language::class;
        return view('admin.languages.index', compact('language'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.languages.create');
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
            'iso_639_1' => 'required|min:1|max:2|regex:/[a-zA-ZşŞÇçÖöüÜıIiİĞğ]+/|unique:languages,iso_639_1',
            'codigo' => 'required|min:1|max:2|regex:/^[0-9]*$/|unique:languages,codigo',
            'estado' => 'required',
        ]);
        //return $request->all();
        Language::create($request->all());
        return redirect()->route('admin.languages.index')->with('info', $request->codigo);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function show(Language $language)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function edit(Language $language)
    {
        //
        return view('admin.languages.edit', compact('language'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Language $language)
    {
        $request->validate([
            'descripcion' => 'required|min:4',
            'iso_639_1' => 'required|min:1|max:2|regex:/[a-zA-ZşŞÇçÖöüÜıIiİĞğ]+/|unique:languages,iso_639_1,' . $language->id,
            'codigo' => 'required|min:1|max:2|regex:/^[0-9]*$/|unique:languages,codigo,' . $language->id,
            'estado' => 'required',
        ]);
        //return $request->all();
        $language->update($request->all());
        return redirect()->route('admin.languages.edit', $language)->with('info', $language->codigo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function destroy(Language $language)
    {
        //
    }
}
