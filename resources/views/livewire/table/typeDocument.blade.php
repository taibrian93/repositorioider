<x-table>
    @slot('selectFilter')
        
    @endslot
    <x-slot name="button">
        <a href="{{ route('admin.typeDocuments.create') }}" class="btn btn-success">Crear Tipo Documento</a>
    </x-slot>

    <x-slot name="head">
        <tr>
            <th>Nro.</th>
            <th>Descripción</th>
            <th>Codigo</th>
            <th>Fecha Creación</th>
            <th style="width: 15%"></th>
        </tr>
    </x-slot>

    <x-slot name="body">
        @foreach ($typeDocuments as $key => $typeDocument)
            <tr>
                <td>{{ (($page-1)*10)+($key+1) }}</td>
                <td>{{ $typeDocument->descripcion }}</td>
                <td>{{ $typeDocument->codigo }}</td>
                <td>{{ $typeDocument->created_at->format('d/m/Y') }}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{ route('admin.typeDocuments.edit', $typeDocument)}}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                            Editar
                        </a>

                        <a href="{{ route('admin.typeDocuments.show', $typeDocument)}}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                            Consultar
                        </a>

                        <a href="#" class="btn btn-danger btn-sm delete" idTypeDocument="{{ $typeDocument->id }}">
                            <i class="fas fa-trash-alt"></i>
                            Eliminar
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
    </x-slot>
   
    <x-slot name="pagination">
        {{ $typeDocuments->links() }}
    </x-slot>

</x-table>