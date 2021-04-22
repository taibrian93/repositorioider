@extends('adminlte::page')

@section('title', 'Repositorio')

@section('content_header')
    <h1>Editar Usuario</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <x-card-success>
                
                </x-card-success>
                <div class="card">
                    <div class="card-body">
                        {!! Form::model($user,['route' => ['admin.users.update',$user], 'method' => 'put' ]) !!}
                            @include('admin.users.partials.form')

                        {!! Form::submit('Actualizar Usuario', ['class' => 'btn btn-primary mt-2']) !!}

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