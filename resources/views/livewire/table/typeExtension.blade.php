<x-table>
    @slot('selectFilter')
        
    @endslot
    <x-slot name="button">
        <a href="{{ route('admin.typeExtensions.create') }}" class="btn btn-success">Crear Tipo Extensión</a>
    </x-slot>

    <x-slot name="head">
        <tr>
            <th>Nro.</th>
            <th>Descripción</th>
            <th>Fecha Creación</th>
            <th style="width: 15%"></th>
        </tr>
    </x-slot>

    <x-slot name="body">
        @foreach ($typeExtensions as $key => $typeExtension)
            <tr>
                <td>{{ (($page-1)*10)+($key+1) }}</td>
                <td>{{ $typeExtension->descripcion }}</td>
                <td>{{ $typeExtension->created_at->format('d/m/Y') }}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{ route('admin.typeExtensions.edit', $typeExtension)}}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                            Editar
                        </a>

                        <a href="{{ route('admin.typeExtensions.show', $typeExtension)}}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                            Consultar
                        </a>

                        <a href="#" class="btn btn-danger btn-sm delete" idTypeExtension="{{ $typeExtension->id }}">
                            <i class="fas fa-trash-alt"></i>
                            Eliminar
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
    </x-slot>
   
    <x-slot name="pagination">
        {{ $typeExtensions->links() }}
    </x-slot>

</x-table>