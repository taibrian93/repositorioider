@extends('adminlte::page')

@section('title', 'Repositorio')

@section('content_header')
    
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Consultar Archivo</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin">Inicio</a></li>
                <li class="breadcrumb-item"><a href="/admin/files">Archivo</a></li>
                <li class="breadcrumb-item active">Consultar Archivo</li>
            </ol>
        </div> 
    </div>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                
                <div class="card-body">
                    {!! Form::model($file,['route' => ['admin.files.update', $file], 'files' => true, 'method' => 'put' ]) !!}
                        @include('admin.files.partials.show')

                    {!! Form::close() !!}
                </div>
                
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
   
@stop

@section('js')
    <script>
        
    </script>
@stop