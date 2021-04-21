<?php

namespace App\Http\Livewire\Table;

use Illuminate\Support\Facades\Auth;
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


    public function get_pagination_data ()
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
                $files = $this->model::where('idUser','=', Auth::user()->id)
                        ->where('idNode', '=', Auth::user()->idNode)
                        ->where($this->selectFilter,'LIKE','%'. $this->search .'%')
                        ->orderBy('id','desc')
                        ->paginate(10);
                return [
                    "view" => 'livewire.table.file',
                    "files" => $files,
                ];
            break;

            case 'home':
                $files = $this->model::where('idNode', '=', Auth::user()->idNode)
                        ->where($this->selectFilter,'LIKE','%'. $this->search .'%')
                        ->orderBy('id','desc')
                        ->paginate(10);
                return [
                    "view" => 'livewire.table.home',
                    "files" => $files,
                ];
            break;

            case 'guest':
                $files = $this->model::where('estado', '=', 1)
                        ->where($this->selectFilter,'LIKE','%'. $this->search .'%')
                        ->orderBy('id','desc')
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
