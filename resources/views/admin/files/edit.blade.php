@extends('adminlte::page')

@section('title', 'Repositorio')

@section('content_header')
    <h1>Editar Archivo</h1>
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

                        {!! Form::submit('Actualizar Archivo', ['class' => 'btn btn-primary mt-2']) !!}
                    {!! Form::close() !!}
                </div>
                
            </div>
        </div>
    </div>

    @include('admin.files.partials.progress-bar')
</div>
@stop

@section('footer')
    <strong>Copyright &copy; 2019-2021 <a href="https://geoportal.regionloreto.gob.pe">IDER - Loreto</a>.</strong>
    Todos los derechos reservados.
    <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 1.0.0
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    @include('admin.files.partials.script')
@stop