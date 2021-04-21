<x-table>

    @slot('selectFilter')
        <select class="form-control" wire:model="selectFilter">
            <option value="titulo">Título</option>
            <option value="codigo">Código</option>
        </select>
    @endslot
    
    <x-slot name="button">
        <a href="{{ route('admin.files.create') }}" class="btn btn-success">Crear Archivo</a>
    </x-slot>

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