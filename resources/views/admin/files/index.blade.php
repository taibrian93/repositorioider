@extends('adminlte::page')

@section('title', 'Repositorio')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Archivo</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin">Inicio</a></li>
                <li class="breadcrumb-item active">Archivo</li>
            </ol>
        </div> 
    </div>
@stop

@section('content')
<div class="container-fluid">
    <livewire:table.table name="file" :model="$file">
</div>
    
@stop

@section('css')
    
@stop

@section('js')
    <script>
        
        $(document).ready(function(){

            var meta = $("meta[name='csrf-token']").attr("content");
            
            

            window.initSelectDrop=()=>{
                $('.department').select2();
                $('.province').select2();
                $('.district').select2();
                $('.populationCenter').select2();

                $('.typeDocument').select2();
                $('.typeFormat').select2();
                $('.typeExtension').select2();
                $('.language').select2();
            }

            window.livewire.on('select2',()=>{
                initSelectDrop();
            });

            $('.typeDocument').on('change', function(e){
                if($(this).val() != ''){
                    livewire.emit('getIdTypeDocument', e.target.value)
                } else {
                    livewire.emit('getIdTypeDocument', 0)
                }
            });

            $('.typeFormat').on('change', function(e){
                if($(this).val() != ''){
                    if($(this).val() == 9){
                        console.log($(this).val())
                        $('.divTypeExtension').remove('.typeExtension');
                        livewire.emit('getIdTypeFormat', e.target.value)
                    }else{
                        livewire.emit('getIdTypeFormat', e.target.value)
                        getListTypeExtensions($(this).val())
                    }
                    
                } else {
                    livewire.emit('getIdTypeFormat', 0)
                }
            });

            //Get List Extensions
            function getListTypeExtensions(idTypeFormat){
                $.ajax({
                    method: "POST",
                    url: "/admin/typeExtensions/getTypeExtensions",               
                    dataType: "json",
                    data: {
                        '_token' : meta,
                        'idTypeFormat' : idTypeFormat,
                    },
                    beforeSend: function() {
                        
                        $('.typeExtension').prop('disabled',true);
                    },
                    complete: function(){
                        $('.typeExtension').prop('disabled',false);
                    },
                    success: function(results) {
                        $('.typeExtension').find("option:not(:first)").remove();
                        
                        if(results.length > 0){
                            results.forEach(function(result) {
                                $('.typeExtension').append('<option value="'+result.descripcion+'">'+result.descripcion+'</option>');
                            });    
                        }
                    },
                    cache: false
                });
            }
            
            
            $('.department').on('change', function(e){
                var idDepartment = $(this).val();
                codigoProvincial = '';

                livewire.emit('getIdProvince', 0)
                livewire.emit('getIdDistrict', 0)
                livewire.emit('getIdPopulationCenter', 0)

                if (idDepartment != '') {
                    livewire.emit('getIdDepartment', e.target.value)
                    getCodDepartment(idDepartment);
                } else{
                    $('.province').find("option:not(:first)").remove();
                    $('.district').find("option:not(:first)").remove();
                    $('.populationCenter').find("option:not(:first)").remove();
                }
            });

            

            $('.search').on('change', function(){
                var val = $(this).val();
                if(val == 1){
                    $('.advancedSearch').prop('disabled', false);
                } else if( val == 0){
                    $('.advancedSearch').prop('disabled', true);
                }
            });

            // Get COD Department/List Provinces
            function getCodDepartment(idDepartment){
                $.ajax({
                    method: "POST",
                    url: "/admin/departments/getDepartment",               
                    dataType: "json",
                    data: {
                        '_token' : meta,
                        'idDepartment' : idDepartment,
                    },
                    success: function(results) {
                        if(results){
                            codigoDepartamental = results['codigoDepartamental'];
                            console.log(codigoDepartamental);
                            getListProvinces(codigoDepartamental);
                        }
                    },
                    cache: false
                });
            }

            //Get Id Province
            $('.province').on('change', function(e){
                var idProvince = $(this).val();

                livewire.emit('getIdDistrict', 0)
                livewire.emit('getIdPopulationCenter', 0)

                if (idProvince != '') {
                    livewire.emit('getIdProvince', e.target.value)
                    getCodProvince(idProvince);
                } else{
                    $('.district').find("option:not(:first)").remove();
                    $('.populationCenter').find("option:not(:first)").remove();
                }
            });

            // Get COD Province
            function getCodProvince(idProvince){
                $.ajax({
                    method: "POST",
                    url: "/admin/provinces/getProvince",               
                    dataType: "json",
                    data: {
                        '_token' : meta,
                        'idProvince' : idProvince,
                    },
                    success: function(results) {
                        if(results){
                            codigoProvincial = results['codigoProvincial'];
                            var codigo = results['codigo']
                            console.log(codigo);
                            if( codigo == '00' ){
                                putAllDepartment(codigo);
                            } else {
                                getListDistricts(codigoProvincial);
                            }
                            
                        }
                    },
                    cache: false
                });
            }

            function putAllDepartment(codigo){
                $.ajax({
                    method: "POST",
                    url: "/admin/departments/allDepartment",               
                    dataType: "json",
                    data: {
                        '_token' : meta,
                        'codigo' : codigo,
                    },
                    beforeSend: function() {
                        
                        //$('.province').prop('disabled',true);
                        $('.district').prop('disabled',true);
                        $('.populationCenter').prop('disabled',true);
                    },
                    complete: function(){
                        //$('.province').prop('disabled',false);
                        $('.district').prop('disabled',false);
                        $('.populationCenter').prop('disabled',false);
                    },
                    success: function(results) {
                        
                        $('.district').find("option:not(:first)").remove();
                        $('.populationCenter').find("option:not(:first)").remove();

                        livewire.emit('getIdDistrict', results[0]['idDistrict'])
                        livewire.emit('getIdPopulationCenter', results[0]['idPopulationCenter'])
                        console.log(results);
                        
                        if(results.length > 0){
                            results.forEach(function(result) {
                                
                                $('.district').append('<option value="'+result.idDistrict+'">'+result.district+' - 00</option>');
                                $('.populationCenter').append('<option value="'+result.idPopulationCenter+'">'+result.populationCenter+' - 0000</option>');
                            });
                            $('.district option:eq(1)').prop('selected', true);
                            $('.populationCenter option:eq(1)').prop('selected', true);
                        }
                    },
                    cache: false
                });
            }

            //Get List Provinces
            function getListProvinces(codigoDepartamental){
                $.ajax({
                    method: "POST",
                    url: "/admin/provinces/getProvinces",               
                    dataType: "json",
                    data: {
                        '_token' : meta,
                        'codigoDepartamental' : codigoDepartamental,
                    },
                    beforeSend: function() {
                        
                        $('.province').prop('disabled',true);
                    },
                    complete: function(){
                        $('.province').prop('disabled',false);
                    },
                    success: function(results) {
                        $('.province').find("option:not(:first)").remove();
                        $('.district').find("option:not(:first)").remove();
                        
                        if(results.length > 0){
                            results.forEach(function(result) {
                                $('.province').append('<option value="'+result.id+'">'+result.descripcion+' - '+result.codigo+'</option>');
                            });    
                        }
                    },
                    cache: false
                });
            }

            // Get Id District
            $('.district').on('change', function(e){
                var idDistrict = $(this).val();
                livewire.emit('getIdPopulationCenter', 0)
                if (idDistrict != '') {
                    livewire.emit('getIdDistrict', e.target.value)
                    getCodDistrict(idDistrict);
                } else{
                    codigoProvincial = '';
                }
            });

            // Get COD District
            function getCodDistrict(idDistrict){
                $.ajax({
                    method: "POST",
                    url: "/admin/districts/getDistrict",               
                    dataType: "json",
                    data: {
                        '_token' : meta,
                        'idDistrict' : idDistrict,
                    },
                    success: function(results) {
                        if(results){
                            codigoDistrital = results['codigoDistrital'];
                            var codigo =  results['codigo'];
                            console.log(codigoDistrital);
                            if( codigo == '00' ){
                                putAllProvince(codigo);
                            } else {
                                getListPopulationCenters(codigoDistrital);
                            }                    
                        }
                    },
                    cache: false
                });
            }

            function putAllProvince(codigo){
                $.ajax({
                    method: "POST",
                    url: "/admin/provinces/allProvince",               
                    dataType: "json",
                    data: {
                        '_token' : meta,
                        'codigo' : codigo,
                    },
                    beforeSend: function() {
                        $('.populationCenter').prop('disabled',true);
                    },
                    complete: function(){
                        $('.populationCenter').prop('disabled',false);
                    },
                    success: function(results) {
                        $('.populationCenter').find("option:not(:first)").remove();
                        console.log(results);
                        if(results.length > 0){
                            results.forEach(function(result) {
                                $('.populationCenter').append('<option value="'+result.idPopulationCenter+'">'+result.populationCenter+' - 0000</option>');
                            });
                            $('.populationCenter option:eq(1)').prop('selected', true);
                        }
                    },
                    cache: false
                });
            }

            //Get List Distritos
            function getListDistricts(codigoProvincial){
                $.ajax({
                    method: "POST",
                    url: "/admin/districts/getDistricts",               
                    dataType: "json",
                    data: {
                        '_token' : meta,
                        'codigoProvincial' : codigoProvincial,
                    },
                    beforeSend: function() {
                        
                        $('.district').prop('disabled',true);
                    },
                    complete: function(){
                        $('.district').prop('disabled',false);
                    },
                    success: function(results) {
                        $('.district').find("option:not(:first)").remove();
                        $('.populationCenter').find("option:not(:first)").remove();
                        if(results.length > 0){
                            results.forEach(function(result) {
                                $('.district').append('<option value="'+result.id+'">'+result.descripcion+' - '+result.codigo+'</option>');
                            });    
                        }
                    },
                    cache: false
                });
            }

            //Get Id populationCenter
            $('.populationCenter').on('change', function(e){
                var idPopulationCenter = $(this).val();
                //console.log(idPopulationCenter);
                if (idPopulationCenter != '') {
                    livewire.emit('getIdPopulationCenter', e.target.value)
                    
                } else{
                    codigoDistrital = '';
                }
            });

            //Get List Centros Poblados
            function getListPopulationCenters(codigoDistrital){
                $.ajax({
                    method: "POST",
                    url: "/admin/populationCenters/getPopulationCenters",               
                    dataType: "json",
                    data: {
                        '_token' : meta,
                        'codigoDistrital' : codigoDistrital,
                    },
                    beforeSend: function() {
                        
                        $('.populationCenter').prop('disabled',true);
                    },
                    complete: function(){
                        $('.populationCenter').prop('disabled',false);
                    },
                    success: function(results) {
                        console.log(results);
                        $('.populationCenter').find("option:not(:first)").remove();
                        if(results.length > 0){
                            results.forEach(function(result) {
                                $('.populationCenter').append('<option value="'+result.id+'">'+result.descripcion+' - '+result.codigo+'</option>');
                            });    
                        }
                    },
                    cache: false
                });
            }

            $('.delete').on('click', function(e){
                e.preventDefault();
                var idFile = $(this).attr('idFile');
                
                Swal.fire({
                    title: '¿Estas seguro de realizar esta acción?',
                    text: "¡Una vez eliminado, no podrá recuperar este registro!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminar registro!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "files/"+idFile,
                            type: 'DELETE',             
                            data: {
                                '_token' : meta,
                                'idFile' : idFile
                            },
                            success: function(results) {
                                // Swal.fire(
                                //     '¡Eliminado!',
                                //     'El registro fue eliminado',
                                //     'success'
                                // )
                                
                                window.location = "files";
                            },
                            cache: false
                        });
                        
                    }
                })
            });    
        })
    </script>
@stop