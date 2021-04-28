<x-table>
    @slot('advancedSearch')
    @endslot
    @slot('selectFilter')
        
    @endslot
    <x-slot name="button">
        <a href="{{ route('admin.nodes.create') }}" class="btn btn-success float-right">Crear Nodo</a>
    </x-slot>

    <x-slot name="head">
        <tr>
            <th>Nro.</th>
            <th>Descripcion</th>
            <th>Codigo</th>
            <th>Fecha Creación</th>
            <th style="width: 15%"></th>
        </tr>
    </x-slot>

    <x-slot name="body">
        @foreach ($nodes as $key => $node)
            <tr>
                <td>{{ (($page-1)*10)+($key+1) }}</td>
                <td>{{ $node->descripcion }}</td>
                <td>{{ $node->codigo }}</td>
                <td>{{ $node->created_at->format('d/m/Y') }}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{ route('admin.nodes.edit', $node)}}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                            Editar
                        </a>

                        <a href="{{ route('admin.nodes.show', $node)}}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                            Consultar
                        </a>

                        <a href="#" class="btn btn-danger btn-sm delete" idNode="{{ $node->id }}">
                            <i class="fas fa-trash-alt"></i>
                            Eliminar
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
    </x-slot>
   
    <x-slot name="pagination">
        {{ $nodes->links() }}
    </x-slot>

</x-table>