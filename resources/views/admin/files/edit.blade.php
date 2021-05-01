@extends('adminlte::page')

@section('title', 'Repositorio')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Editar Archivo</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin">Inicio</a></li>
                <li class="breadcrumb-item"><a href="/admin/files">Archivo</a></li>
                <li class="breadcrumb-item active">Editar Archivo</li>
            </ol>
        </div> 
    </div>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            <x-card-success>
                
            </x-card-success>

            <div class="card">
                
                <div class="card-body">
                    {!! Form::model($file,[ 'files' => true, 'id' => 'formFileUpdate' ]) !!}
                        @include('admin.files.partials.form')

                        {!! Form::submit('Actualizar Archivo', ['class' => 'btn btn-primary mt-2 btn-submit float-right']) !!}
                    {!! Form::close() !!}
                </div>
                
            </div>
        </div>
    </div>

    @include('admin.files.partials.progress-bar')
</div>
@stop

@section('css')
    
@stop

@section('js')
    @include('admin.files.partials.script')
@stop