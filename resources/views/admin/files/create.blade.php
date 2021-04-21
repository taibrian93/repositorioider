@extends('adminlte::page')

@section('title', 'Repositorio')

@section('content_header')
    <h1>Crear Archivo</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open([ 'files' => true, 'id' => 'formFile' ]) !!}
                        @include('admin.files.partials.form')

                        {!! Form::submit('Crear Archivo', ['class' => 'btn btn-primary mt-2 btn-submit']) !!}
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