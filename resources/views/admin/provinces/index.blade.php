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



@section('css')
    
@stop

@section('js')
    
@stop