<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\District;
use App\Models\File;
use App\Models\Language;
use App\Models\Node;
use App\Models\PopulationCenter;
use App\Models\Province;
use App\Models\TypeDocument;
use App\Models\TypeFormat;
use App\Models\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Validator;


class FileController extends Controller
{   

    public function __construct()
    {
        $this->middleware('can:Leer Archivo')->only('index','show');
        $this->middleware('can:Crear Archivo')->only('create', 'store');
        $this->middleware('can:Editar Archivo')->only('edit', 'update');
        $this->middleware('can:Eliminar Archivo')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $file = File::class;

        return view('admin.files.index', compact('file'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::select('id', DB::raw('CONCAT(descripcion, " - ", codigoDepartamental) AS descripcion'))->pluck('descripcion','id');
        $typeDocuments = TypeDocument::pluck('descripcion','id');
        $languages = Language::pluck('descripcion','id');
        return view('admin.files.create',compact('departments','typeDocuments','languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        $rules = array(
            'idDepartment' => 'required',
            'idProvince' => 'required',
            'idDistrict' => 'required',
            'idPopulationCenter' => 'required',
            'idTypeDocument' => 'required',
            'idLanguage' => 'required',
            'titulo' => 'required',
            'descripcion' => 'required',
            'tags' => 'required',
            'archivo' => 'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails()){
            return response()->json([ 'error' => $error->errors() ]);
        }

        $idUser = Auth::id();
        $idNode = User::select('idNode')->where('id', '=', $idUser)->first();
        
        $request->request->add([
            'idUser' => $idUser,
            'idNode' => $idNode->idNode,
        ]);

        $codDepartment = Department::select('codigoDepartamental')->where('id', '=', $request->idDepartment)->first();
        $codProvince = Province::select('codigo')->where('id', '=', $request->idProvince)->first();
        $codDistrict = District::select('codigo')->where('id', '=', $request->idDistrict)->first();
        $codPopulationCenter = PopulationCenter::select('codigo')->where('id', '=', $request->idPopulationCenter)->first();
        $codTypeDocument = TypeDocument::select('codigo')->where('id', '=', $request->idTypeDocument)->first();
        $codLanguage = Language::select('codigo')->where('id', '=', $request->idLanguage)->first();
        $codNode = Node::select('codigo')->where('id', '=', $request->idNode)->first();

        $file = File::create($request->all());
        
        $tags = explode(',', $request->tags);
        $file->tag($tags);
        
        if($request->file('archivo')){

            $year = date('Y');
            $month = date('m');
            $yearMonth = $year.'/'.$month;

            if($request->estado == 1){
                $filePath = 'public/files/'.$yearMonth;
            } else{
                $filePath = 'private/files/'.$yearMonth;
            }
            
            $fileExt = $request->file('archivo')->getClientOriginalExtension();
            $fileSize = $request->file('archivo')->getSize();
            $fileMime = $request->file('archivo')->getMimeType();

            $codTypeFormat = TypeFormat::select('type_formats.codigo','type_formats.id')->leftJoin('type_extensions', 'type_extensions.idTypeFormat', '=', 'type_formats.id')->where('type_extensions.descripcion', '=', $fileExt)->first();
            $codTypeFormat = $codTypeFormat == null ? TypeFormat::select('codigo','id')->where('codigo', '=', '00')->first() : $codTypeFormat;
    
            $codigo = $codDepartment->codigoDepartamental.''.$codProvince->codigo.''.$codDistrict->codigo.''.$codPopulationCenter->codigo.''.$codTypeDocument->codigo.''.$codTypeFormat->codigo.''.$codLanguage->codigo.''.$codNode->codigo.''.$file->id;
            $enlace = $request->file('archivo')->storeAs($filePath, $codigo.'.'.$fileExt);
        }

        $file->codigo = $codigo;
        $file->enlace = $enlace;
        $file->extensionArchivo = $fileExt;
        $file->sizeFile = $fileSize;
        $file->mimeType = $fileMime;
        $file->idTypeFormat = $codTypeFormat->id; 
        $file->save();

        redirect()->route('admin.files.index')->with('info', $codigo);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        $departments = Department::select('id', DB::raw("CONCAT(descripcion,' - ', codigoDepartamental) AS descripcion"))
                    ->pluck('descripcion','id');
        
        $provinces = Province::select('id', DB::raw("CONCAT(provinces.descripcion,' - ', provinces.codigo) AS descripcion"))
                    ->where('idDepartment', '=', $file->idDepartment)
                    ->pluck('descripcion','id');

        $districts = District::select('id', DB::raw("CONCAT(districts.descripcion,' - ', districts.codigo) AS descripcion"))
                    ->where('idProvince', '=', $file->idProvince)
                    ->pluck('descripcion','id');

        $populationCenters = PopulationCenter::select('id', DB::raw("CONCAT(population_centers.descripcion,' - ', population_centers.codigo) AS descripcion"))
                    ->where('idDistrict', '=', $file->idDistrict)
                    ->pluck('descripcion', 'id');

        $typeDocuments = TypeDocument::pluck('descripcion','id');
        $typeFormats = TypeFormat::pluck('descripcion','id');
        $languages = Language::pluck('descripcion','id');

        $file = File::select('files.*','users.name')
                ->leftJoin('users', 'users.id', '=', 'files.idUser')
                ->where('files.id','=',$file->id)
                ->first();

        $nodes = Node::pluck('descripcion','id');

        return view('admin.files.show', compact('file','departments','provinces','districts', 'populationCenters','typeDocuments','nodes','typeFormats','languages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        $departments = Department::pluck('descripcion','id');
        
        $provinces = Province::select('id', DB::raw("CONCAT(provinces.descripcion,' - ', provinces.codigo) AS descripcion"))
                    ->where('idDepartment', '=', $file->idDepartment)
                    ->pluck('descripcion','id');

        $districts = District::select('id', DB::raw("CONCAT(districts.descripcion,' - ', districts.codigo) AS descripcion"))
                    ->where('idProvince', '=', $file->idProvince)
                    ->pluck('descripcion','id');

        $populationCenters = PopulationCenter::select('id', DB::raw("CONCAT(population_centers.descripcion,' - ', population_centers.codigo) AS descripcion"))
                            ->where('idDistrict', '=', $file->idDistrict)
                            ->pluck('descripcion', 'id');

        $typeDocuments = TypeDocument::pluck('descripcion','id');
        $languages = Language::pluck('descripcion','id');

        return view('admin.files.edit', compact('file','departments','provinces','districts','populationCenters','typeDocuments','languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, File $file)
    public function update(Request $request)
    {
        $rules = array(
            'idDepartment' => 'required',
            'idProvince' => 'required',
            'idDistrict' => 'required',
            'idPopulationCenter' => 'required',
            'idTypeDocument' => 'required',
            'idLanguage' => 'required',
            'titulo' => 'required',
            'tags' => 'required',
            'descripcion' => 'required',
        );
        
        $file = File::find($request->id);
        // return response()->json($file);

        $error = Validator::make($request->all(), $rules);

        if($error->fails()){
            return response()->json([ 'error' => $error->errors() ]);
        }

        $idUser = Auth::id();
        $idNode = User::select('idNode')->where('id', '=', $idUser)->first();

        $request->request->add([
            'idUser' => $idUser,
            'idNode' => $idNode->idNode,
        ]);

        $codDepartment = Department::select('codigoDepartamental')->where('id', '=', $request->idDepartment)->first();
        $codProvince = Province::select('codigo')->where('id', '=', $request->idProvince)->first();
        $codDistrict = District::select('codigo')->where('id', '=', $request->idDistrict)->first();
        $codPopulationCenter = PopulationCenter::select('codigo')->where('id', '=', $request->idPopulationCenter)->first();
        $codTypeDocument = TypeDocument::select('codigo')->where('id', '=', $request->idTypeDocument)->first();
        $codLanguage = Language::select('codigo')->where('id', '=', $request->idLanguage)->first();
        $codNode = Node::select('codigo')->where('id', '=', $request->idNode)->first();

        if($request->file('archivo')){

            // Delete File
            Storage::delete($file->enlace);

            // Save File
            $year = date('Y');
            $month = date('m');
            $yearMonth = $year.'/'.$month;

            if($request->estado == 1){
                $filePath = 'public/files/'.$yearMonth;
            } else{
                $filePath = 'private/files/'.$yearMonth;
            }

            $fileExt = $request->file('archivo')->getClientOriginalExtension();
            $fileSize = $request->file('archivo')->getSize();
            $fileMime = $request->file('archivo')->getMimeType();

            $codTypeFormat = TypeFormat::select('type_formats.codigo','type_formats.id')->leftJoin('type_extensions', 'type_extensions.idTypeFormat', '=', 'type_formats.id')->where('type_extensions.descripcion', '=', $fileExt)->first();
            $codTypeFormat = $codTypeFormat == null ? TypeFormat::select('codigo','id')->where('codigo', '=', '00')->first() : $codTypeFormat;
            
            $codigo = $codDepartment->codigoDepartamental.''.$codProvince->codigo.''.$codDistrict->codigo.''.$codPopulationCenter->codigo.''.$codTypeDocument->codigo.''.$codTypeFormat->codigo.''.$codLanguage->codigo.''.$codNode->codigo.''.$file->id;
            $enlace = $request->file('archivo')->storeAs($filePath, $codigo.'.'.$fileExt);

            $request->request->add([
                'enlace' => $enlace,
                'mimeType' => $fileMime,
                'extensionArchivo' => $fileExt,
                'sizeFile' => $fileSize,
                'codigo' => $codigo,
                'idTypeFormat' => $codTypeFormat->id, 
            ]);

        } else{

            $codTypeFormat = TypeFormat::select('type_formats.codigo','type_formats.id')->leftJoin('type_extensions', 'type_extensions.idTypeFormat', '=', 'type_formats.id')->where('type_extensions.descripcion', '=', $file->extensionArchivo)->first();
            $codTypeFormat = $codTypeFormat == null ? TypeFormat::select('codigo','id')->where('codigo', '=', '00')->first() : $codTypeFormat;
            //dd($codTypeFormat->codigo);
            $codigo = $codDepartment->codigoDepartamental.''.$codProvince->codigo.''.$codDistrict->codigo.''.$codPopulationCenter->codigo.''.$codTypeDocument->codigo.''.$codTypeFormat->codigo.''.$codLanguage->codigo.''.$codNode->codigo.''.$file->id;
            
            if($file->estado != $request->estado ){

                $year = date('Y');
                $month = date('m');
                $yearMonth = $year.'/'.$month;

                $storagePath = storage_path();

                $oldPath = $file->enlace;

                if($request->estado == 1){
                    $filePath = 'public/files/'.$yearMonth;
                    
                } else{
                    $filePath = 'private/files/'.$yearMonth;          
                }

                $newPath = $filePath.'/'.$codigo.'.'.$file->extensionArchivo;

                Storage::move($oldPath, $newPath);

                $enlace = $newPath;

                $request->request->add([
                    'enlace' => $enlace, 
                ]);

            } else {

                $enlaceExplode = explode('/', $file->enlace);
                $enlace = $enlaceExplode[0].'/'.$enlaceExplode[1].'/'.$enlaceExplode[2].'/'.$enlaceExplode[3].'/'.$codigo.'.'.$file->extensionArchivo;
                $request->request->add([
                    'enlace' => $enlace, 
                ]);
            }

            $request->request->add([
                'codigo' => $codigo,
                'idTypeFormat' => $codTypeFormat->id, 
            ]);
        }
        
        $file->update($request->all());

        $tags = explode(',', $request->tags);
        $file->retag($tags);

        redirect()->route('admin.files.edit', $file)->with('info', $codigo);
        return response()->json($file->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy($idFile)
    {
        $file = File::find($idFile);
        Storage::delete($file->enlace);
        $file->delete();
    }

    public function privateFile($year, $month, $file){

        $idUser = Auth::id();
        $idNode = User::select('idNode')->where('id', '=', $idUser)->first();
        $explodeFile = explode('.', $file);
        $fileUrl = File::select('enlace', 'idNode')->where('codigo', '=', $explodeFile[0])->first();

        if ($fileUrl->idNode == $idNode->idNode){
            $path = storage_path().'/app/private/files/'.$year.'/'.$month.'/'.$file;
            return response()->file($path);
        } else {
            abort(404);
        }
        
    }
}
