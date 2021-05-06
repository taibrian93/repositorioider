@extends('adminlte::page')

@section('title', 'Repositorio')

@section('content_header')
    <h1>Lista de Tipo Extensión</h1>
@stop

@section('content')
<div class="container-fluid">
    <livewire:table.table name="typeExtension" :model="$typeExtension">
</div>
    
@stop


@section('css')
    
@stop

@section('js')
    <script>
        
    </script>
@stop