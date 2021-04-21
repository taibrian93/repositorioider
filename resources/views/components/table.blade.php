
    <div class="row">
        <div class="col-md-12">

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

            <div class="card">
                <div class="card-body">
                    {{ $button }}
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    
                    <div class="card-tools">
                        
                      <div class="input-group input-group-sm">

                        {{ $selectFilter }}

                        <input wire:keydown="cleanPage" wire:model="search" type="text" class="form-control float-right" placeholder="Buscar">
                        
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>
                      </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-responsive">
                        <thead>
                            {{ $head }}
                        </thead>

                        <tbody>
                            {{ $body }}
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    {{ $pagination }}
                </div>
            </div>
            
        </div>
    </div>


