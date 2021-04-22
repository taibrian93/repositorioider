@extends('adminlte::page')

@section('title', 'Repositorio')

@section('content_header')
    <h1>Crear Usuario</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(['route' => 'admin.users.store']) !!}
                            @include('admin.users.partials.form')

                        {!! Form::submit('Crear Usuario', ['class' => 'btn btn-primary mt-2']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop



@section('css')
    
@stop

@section('js')
    <script>
        $('.node').select2();

        $('.dni').keyup(function () {
            this.value = (this.value + '').replace(/[^0-9]/g, '');
        });
    </script>
@stop