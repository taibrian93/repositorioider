@extends('adminlte::page')

@section('title', 'Repositorio')

@section('content_header')
    <h1>Editar Centro Poblado</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <x-card-success>
                
            </x-card-success>
            
            <div class="card">
                
                <div class="card-body">
                    {!! Form::model($populationCenter,['route' => ['admin.populationCenters.update', $populationCenter], 'method' => 'put' ]) !!}
                        @include('admin.populationCenters.partials.form')

                        {!! Form::submit('Actualizar Centro Poblado', ['class' => 'btn btn-primary mt-2']) !!}
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
        $(document).ready(function() {
        var meta = $("meta[name='csrf-token']").attr("content");
        var codigoDepartamental = '';
        var codigoProvincial = '';
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