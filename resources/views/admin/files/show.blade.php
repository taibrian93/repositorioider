@extends('adminlte::page')

@section('title', 'Repositorio')

@section('content_header')
    <h1>Consultar Archivo</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                
                <div class="card-body">
                    {!! Form::model($file,['route' => ['admin.files.update', $file], 'files' => true, 'method' => 'put' ]) !!}
                        @include('admin.files.partials.show')

                    {!! Form::close() !!}
                </div>
                
            </div>
        </div>
    </div>
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
    <script>
         
    </script>
@stop