<x-table>
    @slot('selectFilter')
        
    @endslot
    <x-slot name="button">
        <a href="{{ route('admin.typeFormats.create') }}" class="btn btn-success">Crear Tipo Formato</a>
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
        @foreach ($typeFormats as $key => $typeFormat)
            <tr>
                <td>{{ (($page-1)*10)+($key+1) }}</td>
                <td>{{ $typeFormat->descripcion }}</td>
                <td>{{ $typeFormat->codigo }}</td>
                <td>{{ $typeFormat->created_at->format('d/m/Y') }}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{ route('admin.typeFormats.edit', $typeFormat)}}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                            Editar
                        </a>

                        <a href="{{ route('admin.typeFormats.show', $typeFormat)}}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                            Consultar
                        </a>

                        <a href="#" class="btn btn-danger btn-sm delete" idTypeFormat="{{ $typeFormat->id }}">
                            <i class="fas fa-trash-alt"></i>
                            Eliminar
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
    </x-slot>
   
    <x-slot name="pagination">
        {{ $typeFormats->links() }}
    </x-slot>

</x-table>