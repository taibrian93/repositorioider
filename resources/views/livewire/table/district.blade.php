<x-table>
    @slot('selectFilter')
        
    @endslot
    <x-slot name="button">
        <a href="{{ route('admin.districts.create') }}" class="btn btn-success">Crear Distrito</a>
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
        @foreach ($districts as $key => $district)
            <tr>
                <td>{{ (($page-1)*10)+($key+1) }}</td>
                <td>{{ $district->descripcion }}</td>
                <td>{{ $district->codigoDistrital }}</td>
                <td>{{ $district->created_at->format('d/m/Y') }}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{ route('admin.districts.edit', $district)}}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                            Editar
                        </a>

                        <a href="{{ route('admin.districts.show', $district)}}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                            Consultar
                        </a>

                        <a href="#" class="btn btn-danger btn-sm delete" idDistrict="{{ $district->id }}">
                            <i class="fas fa-trash-alt"></i>
                            Eliminar
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
    </x-slot>
   
    <x-slot name="pagination">
        {{ $districts->links() }}
    </x-slot>

</x-table>