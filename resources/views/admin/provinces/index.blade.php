@extends('adminlte::page')

@section('title', 'Repositorio')

@section('content_header')
    <h1>Lista de Provincias</h1>
@stop

@section('content')
<div class="container-fluid">
    <livewire:table.table name="province" :model="$province">
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
    <script> console.log('Hi!'); </script>
@stop