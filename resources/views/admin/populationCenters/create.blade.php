@extends('adminlte::page')

@section('title', 'Repositorio')

@section('content_header')
    <h1>Crear Centro Poblado</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(['route' => 'admin.populationCenters.store']) !!}
                        @include('admin.populationCenters.partials.form')

                        {!! Form::submit('Crear Centro Poblado', ['class' => 'btn btn-primary mt-2']) !!}
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
    @include('admin.populationCenters.partials.script')
@stop