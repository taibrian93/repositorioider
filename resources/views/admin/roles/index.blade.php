@extends('adminlte::page')

@section('title', 'Repositorio')

@section('content_header')
    <h1>Lista de Roles</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                
                @if (session('info'))
            
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Exito!</h3>
        
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                                </button>
                            </div>
                        <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong>Exito!</strong> {{ session('info') }}
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    
                @endif
                

                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('admin.roles.create') }}">Crear rol</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th colspan="2"></th>
                                </tr>
                            </thead>
                                @forelse ($roles as $role)
                                    <tr>
                                        <td>{{ $role->id }}</td>
                                        <td>{{ $role->name }}</td>

                                        <td width="10px">
                                            <a href="{{ route('admin.roles.edit', $role)}}" class="btn btn-secondary">Editar</a>
                                        </td>

                                        <td width="10px">
                                            <form action="{{ route('admin.roles.destroy', $role) }}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger" type="submit">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">No hay registros</td>
                                    </tr>
                                @endforelse
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="card-footer">

                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    
@stop

@section('js')
    
@stop