@extends('adminlte::page')

@section('title', 'Repositorio')

@section('content_header')
    <h1>Crear Distrito</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(['route' => 'admin.districts.store']) !!}
                        @include('admin.districts.partials.form')

                        {!! Form::submit('Crear Distrito', ['class' => 'btn btn-primary mt-2']) !!}
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
            var codigoDepartamental = $('option:selected', '.department').val() != '' ? $('option:selected', '.department').val() : '';
            var codigoProvincial = $('option:selected', '.province').val() != '' ? $('option:selected', '.province').val() : '';
            var codigoDistrital = '';

            // Get Id Department
            $('.department').on('change', function(){
                var idDepartment = $(this).val();
                codigoProvincial = '';
                if (idDepartment != '') {
                    getCodDepartment(idDepartment, false);
                } else{
                    codigoDepartamental = '';
                    codigoProvincial = '';
                    generateCode(codigoDepartamental, codigoProvincial, codigoDistrital);
                }
            });

            // Get COD Department/List Provinces
            function getCodDepartment(idDepartment, validate){
                $.ajax({
                    method: "POST",
                    url: "{{ route('admin.getDepartment') }}",               
                    dataType: "json",
                    data: {
                        '_token' : meta,
                        'idDepartment' : idDepartment,
                    },
                    success: function(results) {
                        if(results && validate == false){
                            codigoDepartamental = results['codigoDepartamental'];
                            generateCode(codigoDepartamental, codigoProvincial, codigoDistrital);
                            getListProvinces(codigoDepartamental);
                        } else if (results && validate == true){
                            codigoDepartamental = results['codigoDepartamental'];
                        }
                    },
                    cache: false
                });
            }

            //Get List Provinces
            function getListProvinces(codigoDepartamental){
                $.ajax({
                    method: "POST",
                    url: "{{ route('admin.getListProvinces') }}",               
                    dataType: "json",
                    data: {
                        '_token' : meta,
                        'codigoDepartamental' : codigoDepartamental,
                    },
                    success: function(results) {
                        
                        if(results.length > 0){
                            results.forEach(function(result) {
                                $('.province').append('<option value="'+result.id+'">'+result.descripcion+'</option>');
                            });    
                        } else {
                            $('.province').find("option:not(:first)").remove();
                        }
                    },
                    cache: false
                });
            }

            // Get Id Province
            $('.province').on('change', function(){
                var idProvince = $(this).val();
                if (idProvince != '') {
                    getCodProvince(idProvince, false);
                } else{
                    codigoProvincial = '';
                    generateCode(codigoDepartamental, codigoProvincial, codigoDistrital);
                }
            });

            // Get COD Province
            function getCodProvince(idProvince, validate){
                $.ajax({
                    method: "POST",
                    url: "{{ route('admin.getProvince') }}",               
                    dataType: "json",
                    data: {
                        '_token' : meta,
                        'idProvince' : idProvince,
                    },
                    success: function(results) {
                        if(results && validate == false){
                            codigoProvincial = results['codigo'];
                            generateCode(codigoDepartamental, codigoProvincial, codigoDistrital);
                        } else if(results && validate == true){
                            codigoProvincial = results['codigo'];
                        }
                    },
                    cache: false
                });
            }

            $('.codigo').on('keyup', function(){
                codigoDistrital = $(this).val();
                idDepartment = $('option:selected', '.department').val();
                getCodDepartment(idDepartment, true);
                idProvince = $('option:selected', '.province').val();
                getCodProvince(idProvince, true);
                
                generateCode(codigoDepartamental, codigoProvincial, codigoDistrital);
            });

            // Generate COD Ubigeo
            function generateCode(codigoDepartamental, codigoProvincial, codigoDistrital){
                var codigo = codigoDepartamental+''+codigoProvincial+''+codigoDistrital;
                
                $('.codigoDistrital').val(codigo);
            }
        });
    </script>
@stop