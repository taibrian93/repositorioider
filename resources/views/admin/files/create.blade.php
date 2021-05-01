@extends('adminlte::page')

@section('title', 'Repositorio')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Crear Archivo</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin">Inicio</a></li>
                <li class="breadcrumb-item"><a href="/admin/files">Archivo</a></li>
                <li class="breadcrumb-item active">Crear Archivo</li>
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
                        {!! Form::open([ 'files' => true, 'id' => 'formFile' ]) !!}
                        @include('admin.files.partials.form')

                        {!! Form::submit('Crear Archivo', ['class' => 'btn btn-primary mt-2 btn-submit float-right']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.files.partials.progress-bar')
@stop

@section('js')
    @include('admin.files.partials.script')

@stop