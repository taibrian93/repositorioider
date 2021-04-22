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