<x-table>

    @slot('selectFilter')
        <select class="form-control" wire:model="selectFilter">
            <option value="titulo">Título</option>
            <option value="codigo">Código</option>
        </select>
    @endslot
    
    <x-slot name="button">
        <a href="{{ route('admin.populationCenters.create') }}" class="btn btn-success">Crear Centro Poblado</a>
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
        @foreach ($populationCenters as $key => $populationCenter)
            <tr>
                <td>{{ (($page-1)*10)+($key+1) }}</td>
                <td>{{ $populationCenter->descripcion }}</td>
                <td>
                    <a href="{{ Storage::url($populationCenter->enlace) }}" target="_blank" rel="noopener noreferrer" download>
                        {{ $populationCenter->codigoCentroPoblado }}
                    </a>
                </td>
                <td>{{ $populationCenter->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $populationCenter->updated_at->format('d/m/Y H:i') }}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{ route('admin.populationCenters.edit', $populationCenter)}}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                            Editar
                        </a>

                        <a href="{{ route('admin.populationCenters.show', $populationCenter)}}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                            Consultar
                        </a>

                        <a href="#" class="btn btn-danger btn-sm delete" idPopulationCenter="{{ $populationCenter->id }}">
                            <i class="fas fa-trash-alt"></i>
                            Eliminar
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
    </x-slot>
   
    <x-slot name="pagination">
        {{ $populationCenters->links() }}
    </x-slot>

</x-table>