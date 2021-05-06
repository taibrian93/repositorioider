@extends('adminlte::page')

@section('title', 'Repositorio')

@section('content_header')
    <h1>Lista de Tipo Documentos</h1>
@stop

@section('content')
<div class="container-fluid">
    <livewire:table.table name="typeDocument" :model="$typeDocument">
</div>
    
@stop


@section('css')
    
@stop

@section('js')
    
@stop