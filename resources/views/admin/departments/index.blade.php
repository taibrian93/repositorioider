@extends('adminlte::page')

@section('title', 'Repositorio')

@section('content_header')
    <h1>Lista de Departamentos</h1>
@stop

@section('content')
<div class="container-fluid">
    <livewire:table.table name="department" :model="$department">
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
        $(document).ready(function(){
            var meta = $("meta[name='csrf-token']").attr("content");
            $('.delete').on('click', function(e){
                e.preventDefault();
                var idDepartment = $(this).attr('idDepartment');
                
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
                            url: "departments/"+idDepartment,
                            type: 'DELETE',             
                            data: {
                                '_token' : meta,
                                'idDepartment' : idDepartment
                            },
                            success: function(results) {
                                // Swal.fire(
                                //     '¡Eliminado!',
                                //     'El registro fue eliminado',
                                //     'success'
                                // )
                                
                                window.location = "departments";
                            },
                            cache: false
                        });
                        
                    }
                })
            });    
        })
    </script>
@stop