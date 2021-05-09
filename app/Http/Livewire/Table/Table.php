<?php

namespace App\Http\Livewire\Table;

use App\Models\Department;
use App\Models\Language;
use App\Models\Node;
use App\Models\TypeDocument;
use App\Models\TypeFormat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $model;
    public $name;
    public $search = '';
    public $selectFilter = 'titulo';
    public $check = 0;
    public $result = 0;

    public $idDepartment = 0;
    public $idProvince = 0;
    public $idDistrict = 0;
    public $idPopulationCenter = 0;
    public $idTypeDocument = 0;
    public $idTypeFormat = 0;
    public $idTypeExtension = 0;
    public $idLanguage = 0;
    public $idNode = 0;
    public $titulo = "";
    public $descripcion = "";

    protected $listeners = [
        'getIdDepartment',
        'getIdProvince',
        'getIdDistrict',
        'getIdPopulationCenter',
        'getIdTypeDocument',
        'getIdTypeFormat',
    ];

    public function getIdDepartment($idDepartment){
        $idDepartment > 0 ? $this->idDepartment = $idDepartment : $this->idDepartment = 0;
    }

    public function getIdProvince($idProvince){
        $idProvince > 0 ? $this->idProvince = $idProvince : $this->idProvince = 0;
    }

    public function getIdDistrict($idDistrict){
        $idDistrict > 0 ? $this->idDistrict = $idDistrict : $this->idDistrict = 0;
    }

    public function getIdPopulationCenter($idPopulationCenter){
        $idPopulationCenter > 0 ? $this->idPopulationCenter = $idPopulationCenter : $this->idPopulationCenter = 0;
    }

    public function getIdTypeDocument($idTypeDocument){
        $idTypeDocument > 0 ? $this->idTypeDocument = $idTypeDocument : $this->idTypeDocument = 0;
    }

    public function getIdTypeFormat($idTypeFormat){
        $idTypeFormat > 0 ? $this->idTypeFormat = $idTypeFormat : $this->idTypeFormat = 0;
    }

    public function hydrate()
    {
        $this->emit('select2');
    }

    public function get_pagination_data()
    {
        switch ($this->name) {

            case 'user':
                $users = $this->model::where('name','LIKE','%'. $this->search .'%')
                        ->orWhere('email','LIKE','%'. $this->search .'%')
                        ->paginate(10);

                return [
                    "view" => 'livewire.table.user',
                    "users" => $users,
                ];
            break;

            case 'node':
                $nodes = $this->model::where('descripcion','LIKE','%'. $this->search .'%')
                        ->orWhere('codigo','LIKE','%'. $this->search .'%')
                        ->orderBy('codigo','asc')
                        ->paginate(10);

                return [
                    "view" => 'livewire.table.node',
                    "nodes" => $nodes,
                ];
            break;

            case 'language':
                $languages = $this->model::where('descripcion','LIKE','%'. $this->search .'%')
                        ->orWhere('codigo','LIKE','%'. $this->search .'%')
                        ->orderBy('codigo','asc')
                        ->paginate(10);

                return [
                    "view" => 'livewire.table.language',
                    "languages" => $languages,
                ];
            break;

            case 'typeDocument':
                $typeDocuments = $this->model::where('descripcion','LIKE','%'. $this->search .'%')
                        ->orWhere('codigo','LIKE','%'. $this->search .'%')
                        ->orderBy('codigo','asc')
                        ->paginate(10);

                return [
                    "view" => 'livewire.table.typeDocument',
                    "typeDocuments" => $typeDocuments,
                ];
            break;

            case 'department':
                $departments = $this->model::where('descripcion','LIKE','%'. $this->search .'%')
                        ->orWhere('codigoDepartamental','LIKE','%'. $this->search .'%')
                        ->orderBy('codigoDepartamental','asc')
                        ->paginate(10);

                return [
                    "view" => 'livewire.table.department',
                    "departments" => $departments,
                ];
            break;

            case 'province':
                $provinces = $this->model::where('descripcion','LIKE','%'. $this->search .'%')
                        ->orWhere('codigoProvincial','LIKE','%'. $this->search .'%')
                        ->orderBy('codigo','asc')
                        ->paginate(10);

                return [
                    "view" => 'livewire.table.province',
                    "provinces" => $provinces,
                ];
            break;

            case 'district':
                $districts = $this->model::where('descripcion','LIKE','%'. $this->search .'%')
                        ->orWhere('codigoDistrital','LIKE','%'. $this->search .'%')
                        ->orderBy('codigo','asc')
                        ->paginate(10);

                return [
                    "view" => 'livewire.table.district',
                    "districts" => $districts,
                ];
            break;

            case 'populationCenter':
                $populationCenters = $this->model::where('descripcion','LIKE','%'. $this->search .'%')
                        ->orWhere('codigoCentroPoblado','LIKE','%'. $this->search .'%')
                        ->orderBy('codigo','asc')
                        ->paginate(10);

                return [
                    "view" => 'livewire.table.populationCenter',
                    "populationCenters" => $populationCenters,
                ];
            break;

            case 'typeFormat':
                $typeFormats = $this->model::where('descripcion','LIKE','%'. $this->search .'%')
                        ->orWhere('codigo','LIKE','%'. $this->search .'%')
                        ->orderBy('codigo','asc')
                        ->paginate(10);

                return [
                    "view" => 'livewire.table.typeFormat',
                    "typeFormats" => $typeFormats,
                ];
            break;

            case 'typeExtension':
                $typeExtensions = $this->model::where('descripcion','LIKE','%'. $this->search .'%')
                        ->paginate(10);
                //dd($typeExtensions);
                return [
                    "view" => 'livewire.table.typeExtension',
                    "typeExtensions" => $typeExtensions,
                ];
            break;

            case 'file':

                if($this->check == 0){

                    $files = $this->model::select('files.*', 'type_documents.descripcion AS tipoDocumento')
                            ->leftJoin('type_documents', 'type_documents.id', '=', 'files.idTypeDocument')
                            ->where('idUser','=', Auth::user()->id)
                            ->where('idNode', '=', Auth::user()->idNode)
                            ->where('files.'.$this->selectFilter,'LIKE','%'. $this->search .'%')
                            ->orderBy('id','desc')
                            ->paginate(10);

                } elseif($this->check == 1) {
                    
                    $files = $this->model::where('idUser', '=', Auth::user()->id)
                            ->where('idNode', '=', Auth::user()->idNode)
                            ->orderBy('id','desc');
                            
                    
                    if($this->idDepartment > 0){
                        $files = $files->where('idDepartment', '=', $this->idDepartment);
                    }

                    if($this->idProvince > 0){
                        $files = $files->where('idProvince', '=', $this->idProvince);
                    }

                    if($this->idDistrict > 0){
                        $files = $files->where('idDistrict', '=', $this->idDistrict);
                    }

                    if($this->idPopulationCenter > 0){
                        $files = $files->where('idPopulationCenter', '=', $this->idPopulationCenter);
                    }

                    if($this->idTypeDocument > 0){
                        $files = $files->where('idTypeDocument', '=', $this->idTypeDocument);
                    }

                    if($this->idTypeFormat > 0){
                        $files = $files->where('idTypeFormat', '=', $this->idTypeFormat);
                    }

                    if($this->idTypeExtension > 0){
                        $files = $files->where('idTypeExtension', '=', $this->idTypeExtension);
                    }

                    if($this->idLanguage > 0){
                        $files = $files->where('idLanguage', '=', $this->idLanguage);
                    }

                    // if($this->idNode > 0){
                    //     $files = $files->where('idNode', '=', $this->idNode);
                    // }

                    if($this->titulo != ''){
                        $files = $files->where('titulo', 'LIKE', '%'.$this->titulo.'%');
                    }

                    if($this->descripcion != ''){
                        $files = $files->where('descripcion', 'LIKE', '%'.$this->descripcion.'%');
                    }


                    $files = $files->paginate(10);
                }

                $this->result = $this->idPopulationCenter;

                $departments = Department::select('id', DB::raw('CONCAT(descripcion, " - ", codigoDepartamental) AS descripcion'))->pluck('descripcion','id');               
                $typeDocuments = TypeDocument::pluck('descripcion','id');
                $languages = Language::pluck('descripcion','id');
                $typeFormats = TypeFormat::pluck('descripcion', 'id');
                $nodes = Node::pluck('descripcion', 'id');

                return [
                    "view" => 'livewire.table.file',
                    "files" => $files,
                    "departments" => $departments,
                    "typeDocuments" => $typeDocuments,
                    "languages" => $languages,
                    "typeFormats" => $typeFormats,
                    "nodes" => $nodes,
                ];
            break;

            case 'home':
                $files = $this->model::select('files.*', 'nodes.siglas')
                        ->leftJoin('nodes', 'nodes.id', '=', 'files.idNode')
                        ->where('idNode', '=', Auth::user()->idNode)
                        ->where('files.'.$this->selectFilter,'LIKE','%'. $this->search .'%')
                        ->orderBy('id','desc')
                        ->paginate(10);
                return [
                    "view" => 'livewire.table.home',
                    "files" => $files,
                ];
            break;

            case 'guest':
                $files = $this->model::select('files.*', 'nodes.siglas', 'type_documents.descripcion AS tipoDocumento')
                        ->leftJoin('type_documents', 'type_documents.id', '=', 'files.idTypeDocument')
                        ->leftJoin('nodes', 'nodes.id', '=', 'files.idNode')
                        ->where('files.estado', '=', 1)
                        ->where('files.'.$this->selectFilter,'LIKE','%'. $this->search .'%')
                        ->orderBy('files.id','desc')
                        ->paginate(10);
                
                return [
                    "view" => 'livewire.table.guest',
                    "files" => $files,
                ];
            break;

            default:
                # code...
            break;
        }
    }

    public function cleanPage(){
        $this->reset('page');
    }

    public function render()
    {  
        $data = $this->get_pagination_data();
        return view($data['view'], $data);
    }
}
