@extends('adminlte::page')

@section('title', 'Repositorio')

@section('content_header')
    <h1>Inicio</h1>
@stop

@section('content')

    <div class="container-fluid">
        @can('Dashboard Admin')
            {{-- Cantida de registros --}}
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $users }}</h3>
        
                            <p>Usuarios</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="{{ route('admin.users.index') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $nodes }}</h3>
                            <p>Nodos</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-object-group"></i>
                        </div>
                        <a href="{{ route('admin.nodes.index') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $languages }}</h3>
        
                            <p>Lenguajes</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-language"></i>
                        </div>
                        <a href="{{ route('admin.languages.index') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $typeDocuments }}</h3>
        
                        <p>Tipo Documentos</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <a href="{{ route('admin.typeDocuments.index') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            {{-- Tabla de Inicio de Sesion --}}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        {{-- <div class="card-header">

                        </div> --}}
                        <div class="card-body">
                            <table class="table table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th>Usuario</th>
                                        <th>Sesiones del navegador</th>
                                        <th>Ip</th>
                                        <th>Ultima Actividad</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <tr>
                                        
                                    </tr>
                                </tbody>
                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
        
        {{-- Tabla de Archivos Nodo  --}}
        <livewire:table.table name="home" :model="$file">
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