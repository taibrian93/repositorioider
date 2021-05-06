@extends('adminlte::page')

@section('title', 'Repositorio')

@section('content_header')
    <h1>Crear Departamento</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(['route' => 'admin.departments.store']) !!}
                        @include('admin.departments.partials.form')

                        {!! Form::submit('Crear Departamento', ['class' => 'btn btn-primary mt-2']) !!}
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
    
@stop