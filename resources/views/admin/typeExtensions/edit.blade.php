@extends('adminlte::page')

@section('title', 'Repositorio')

@section('content_header')
    <h1>Editar Tipo Extensión</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <x-card-success>
                
            </x-card-success>
            <div class="card">
                
                <div class="card-body">
                    {!! Form::model($typeExtension,['route' => ['admin.typeExtensions.update', $typeExtension], 'method' => 'put' ]) !!}
                        @include('admin.typeExtensions.partials.form')

                        {!! Form::submit('Actualizar Tipo Extensión', ['class' => 'btn btn-primary mt-2']) !!}
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