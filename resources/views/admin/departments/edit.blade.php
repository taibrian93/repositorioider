@extends('adminlte::page')

@section('title', 'Repositorio')

@section('content_header')
    <h1>Editar Departamento</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <x-card-success>
                
            </x-card-success>
            <div class="card">
                
                <div class="card-body">
                    {!! Form::model($department,['route' => ['admin.departments.update', $department], 'method' => 'put' ]) !!}
                        @include('admin.departments.partials.form')

                        {!! Form::submit('Actualizar Departamento', ['class' => 'btn btn-primary mt-2']) !!}
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