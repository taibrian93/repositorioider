@extends('adminlte::page')

@section('title', 'Repositorio')

@section('content_header')
    <h1>Editar Tipo Formato</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <x-card-success>
                
            </x-card-success>
            <div class="card">
                
                <div class="card-body">
                    {!! Form::model($typeFormat,['route' => ['admin.typeFormats.update', $typeFormat], 'method' => 'put' ]) !!}
                        @include('admin.typeFormats.partials.form')

                        {!! Form::submit('Actualizar Tipo Formato', ['class' => 'btn btn-primary mt-2']) !!}
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