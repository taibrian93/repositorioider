@extends('adminlte::page')

@section('title', 'Repositorio')

@section('content_header')
    <h1>Editar Nodo</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <x-card-success>
                
            </x-card-success>
            <div class="card">
                
                <div class="card-body">
                    {!! Form::model($language,['route' => ['admin.languages.update', $language], 'method' => 'put' ]) !!}
                        @include('admin.languages.partials.form')

                        {!! Form::submit('Actualizar Lenguaje', ['class' => 'btn btn-primary mt-2']) !!}
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