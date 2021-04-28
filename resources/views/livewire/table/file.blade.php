<x-table>
    
    <x-slot name="button">
        <a href="{{ route('admin.files.create') }}" class="btn btn-success float-right">Crear Archivo</a>
    </x-slot>

    @slot('advancedSearch')
            
        {{-- <div class="card collapsed-card" wire:ignore>
            <div class="card-header">
                <h3 class="card-title">Búsqueda avanzada</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                    </button>
                </div>
                
            </div>
            
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="provincia">Provincia</label>
                            <br>
                            
                            <div class="form-check-inline">
                                <input id="useSearch" type="radio" class="form-check-input search" name="search" value="1" wire:model="check">
                                <label for="useSearch" class="form-check-label">Usar Busqueda Avanzada</label>
                            </div>

                            <div class="form-check-inline">
                                <input id="noUseSearch" type="radio" class="form-check-input search" name="search" value="0" wire:model="check" checked>
                                <label for="noUseSearch" class="form-check-label">No Usar Busqueda Avanzada</label>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Departamento</label>
                            <select class="form-control department advancedSearch" style="width: 100%;" disabled>
                                <option value="">Seleccione Departamento...</option>
                                @foreach ($departments as $id => $descripcion)
                                    <option value="{{ $id }}">{{ $descripcion }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="provincia">Provincia</label>
                            <select class="form-control province advancedSearch" style="width: 100%;" disabled wire:model="idProvince">
                                <option value="">Seleccione Provincia</option>
                            </select>
                        </div>
                        
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="distrito">Distrito</label>
                            <select class="form-control district advancedSearch" style="width: 100%;" disabled>
                                <option value="">Seleccione Distrito</option>
                            </select>
                        </div>
                        
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="centro poblado">Centro Poblado</label>
                            <select class="form-control populationCenter advancedSearch" style="width: 100%;" disabled>
                                <option value="">Seleccione Centro Poblado</option>
                            </select>
                        </div>
                        
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('name', 'Tipo Documento') !!}
                            {!! Form::select('idTypeDocument',$typeDocuments, null, ['class' => 'form-control typeDocument advancedSearch', 'placeholder' => 'Seleccione Tipo Documento...', 'style' => 'width:100%;', 'disabled' => '']) !!}
                            
                        </div>
                        
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('name', 'Tipo Formato') !!}
                            {!! Form::select('idTypeFormat',$typeFormats, null, ['class' => 'form-control typeFormat advancedSearch', 'placeholder' => 'Seleccione Tipo Formato...', 'style' => 'width:100%;', 'disabled' => '']) !!}
                            
                        </div>
                        
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group divTypeExtension">
                            <label for="tipo extension">Tipo Extensión</label>
                            <select class="form-control typeExtension advancedSearch" style="width: 100%;" disabled>
                                <option value="">Seleccione Tipo Extensión</option>
                            </select>
                            
                        </div>
                        
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('name', 'Lenguaje') !!}
                            {!! Form::select('idLanguage',$languages, null, ['class' => 'form-control language advancedSearch', 'placeholder' => 'Seleccione Lenguaje...', 'style' => 'width:100%;', 'disabled' => '']) !!}
                        </div>
                        
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input type="text" class="form-control advancedSearch" placeholder="Escribe un título" disabled wire:model="titulo">
                        </div>
                        
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <input type="text" class="form-control advancedSearch" placeholder="Escribe una descripción" disabled wire:model="descripcion">
                        </div>
                    </div>
                </div>

                <div class="row">        

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <input type="text" class="form-control" placeholder="Escribe una descripción" wire:model="result">
                        </div>
                    </div>
                </div>
            </div>
            
        </div> --}}

    @endslot

    @slot('selectFilter')

        <select class="form-control" wire:model="selectFilter">
            <option value="titulo">Título</option>
            <option value="codigo">Código</option>
        </select>

    @endslot

    <x-slot name="head">
        <tr>
            <th>Nro.</th>
            <th>Titulo</th>
            <th>Codigo</th>
            <th>Fecha Creación</th>
            <th>Fecha Actualización</th>
            <th style="width: 15%"></th>
        </tr>
    </x-slot>

    <x-slot name="body">
        @foreach ($files as $key => $file)
            <tr>
                <td>{{ (($page-1)*10)+($key+1) }}</td>
                <td>{{ $file->titulo }}</td>
                <td>
                    @if ($file->estado == 0)
                        <a href="{{ $file->enlace }}" target="_blank" rel="noopener noreferrer">
                            {{ $file->codigo }}
                        </a>
                    @else
                        <a href="{{ Storage::url($file->enlace) }}" target="_blank" rel="noopener noreferrer">
                            {{ $file->codigo }}
                        </a>
                    @endif
                </td>
                <td>{{ $file->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $file->updated_at->format('d/m/Y H:i') }}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{ route('admin.files.edit', $file)}}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                            Editar
                        </a>

                        <a href="{{ route('admin.files.show', $file)}}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                            Consultar
                        </a>
                        @can('Eliminar Archivo')
                            <a href="#" class="btn btn-danger btn-sm delete" idFile="{{ $file->id }}">
                                <i class="fas fa-trash-alt"></i>
                                Eliminar
                            </a>
                        @endcan
                        
                    </div>
                </td>
            </tr>
        @endforeach
    </x-slot>
   
    <x-slot name="pagination">
        {{ $files->links() }}
    </x-slot>

</x-table>
