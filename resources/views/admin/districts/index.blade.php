@extends('adminlte::page')

@section('title', 'Repositorio')

@section('content_header')
    <h1>Lista de Distritos</h1>
@stop

@section('content')
<div class="container-fluid">
    <livewire:table.table name="district" :model="$district">
</div>
    
@stop

@section('css')
    
@stop

@section('js')
    
@stop