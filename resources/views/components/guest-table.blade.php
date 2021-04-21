<div class="container" style="margin-top: 120px">

    <div class="card" style="margin-bottom: 30px">

        <div class="card-header text-center text-success font-weight-bold">
            Repositorio IDER       
        </div>

        <div class="card-body">
            <div class="card-tools" style="margin-bottom: 15px">
                
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
            <table class="table table-responsive-sm">
                <thead class="text-success">
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
    
