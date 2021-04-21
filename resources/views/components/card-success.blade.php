@if (session('info'))
            
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">¡Éxito!</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            ¡El registro con codigo <strong>{{ session('info') }}</strong> se modifico satisfactoriamente!
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
                    
@endif