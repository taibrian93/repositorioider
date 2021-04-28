<x-table>
    @slot('advancedSearch')
    @endslot
    @slot('selectFilter')
        
    @endslot
    <x-slot name="button">
        <a href="{{ route('admin.provinces.create') }}" class="btn btn-success float-right">Crear Provincia</a>
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
        @foreach ($provinces as $key => $province)
            <tr>
                <td>{{ (($page-1)*10)+($key+1) }}</td>
                <td>{{ $province->descripcion }}</td>
                <td>{{ $province->codigoProvincial }}</td>
                <td>{{ $province->created_at->format('d/m/Y') }}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{ route('admin.provinces.edit', $province)}}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                            Editar
                        </a>

                        <a href="{{ route('admin.provinces.show', $province)}}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                            Consultar
                        </a>

                        <a href="#" class="btn btn-danger btn-sm delete" idProvince="{{ $province->id }}">
                            <i class="fas fa-trash-alt"></i>
                            Eliminar
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
    </x-slot>
   
    <x-slot name="pagination">
        {{ $provinces->links() }}
    </x-slot>

</x-table>