@extends('adminlte::page')

@section('title', 'Repositorio')

@section('content_header')
    <h1>Lista de Nodos</h1>
@stop

@section('content')
<div class="container-fluid">
    <livewire:table.table name="node" :model="$node">
</div>
    
@stop




@section('css')
    
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop