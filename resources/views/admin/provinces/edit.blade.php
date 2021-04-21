@extends('adminlte::page')

@section('title', 'Repositorio')

@section('content_header')
    <h1>Editar Provincia</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <x-card-success>
                
            </x-card-success>
            <div class="card">
                
                <div class="card-body">
                    {!! Form::model($province,['route' => ['admin.provinces.update', $province], 'method' => 'put' ]) !!}
                        @include('admin.provinces.partials.form')

                        {!! Form::submit('Actualizar Provincia', ['class' => 'btn btn-primary mt-2']) !!}
                    {!! Form::close() !!}
                </div>
                
            </div>
        </div>
    </div>
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
        $(document).ready(function() {

            var meta = $("meta[name='csrf-token']").attr("content");
            var codigoDepartamental = '';
            var codigoProvincial = '';

            $('.department').on('change', function(){
                var idDepartment = $(this).val();
                if (idDepartment != '') {
                    getCodDepartment(idDepartment);
                } else{
                    codigoDepartamental = '';
                    $('.codigoProvincial').val(codigoDepartamental);
                }
            });

            $('.codigo').on('keyup', function(){
                codigoProvincial = $(this).val();
                idDepartment = $('option:selected', '.department').val();
                getCodDepartment(idDepartment);
            });

            function generateCode(codigoDepartamental, codigoProvincial){
                var codigo = codigoDepartamental+''+codigoProvincial;
                $('.codigoProvincial').val(codigo);
            }

            function getCodDepartment(idDepartment){
                $.ajax({
                    method: "POST",
                    url: "{{ route('admin.getDepartment') }}",               
                    dataType: "json",
                    data: {
                        '_token' : meta,
                        'idDepartment' : idDepartment,
                    },
                    success: function(results) {
                        if(results){
                            codigoDepartamental = results['codigoDepartamental'];
                            generateCode(codigoDepartamental, codigoProvincial);
                        }
                    },
                    cache: false
                });
            }
            });
    </script>
@stop