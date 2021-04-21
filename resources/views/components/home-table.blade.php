
    <div class="row">
        <div class="col-md-12">

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
                    <table class="table table-responsive-sm">
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


