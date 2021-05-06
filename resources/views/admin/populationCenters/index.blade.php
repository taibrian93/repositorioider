@extends('adminlte::page')

@section('title', 'Repositorio')

@section('content_header')
    <h1>Lista de Centros Poblados</h1>
@stop

@section('content')
<div class="container-fluid">
    <livewire:table.table name="populationCenter" :model="$populationCenter">
</div>
    
@stop


@section('css')
   
@stop

@section('js')
    <script>
        $(document).ready(function(){
            var meta = $("meta[name='csrf-token']").attr("content");
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
                            url: "populationCenters/"+idFile,
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
                                
                                window.location = "populationCenters";
                            },
                            cache: false
                        });
                        
                    }
                })
            });    
        })
    </script>
@stop