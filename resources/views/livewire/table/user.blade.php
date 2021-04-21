<x-table>
    @slot('selectFilter')
        
    @endslot
    <x-slot name="button">
        <a href="{{ route('admin.users.create') }}" class="btn btn-success">Crear Usuario</a>
    </x-slot>

    <x-slot name="head">
        <tr>
            <th>Nro.</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Fecha Creación</th>
            <th style="width: 15%"></th>
        </tr>
    </x-slot>

    <x-slot name="body">
        @foreach ($users as $key => $user)
            <tr>
                <td>{{ (($page-1)*10)+($key+1) }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{ route('admin.users.edit', $user)}}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                            Editar
                        </a>

                        <a href="{{ route('admin.users.show', $user)}}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                            Consultar
                        </a>

                        <a href="#" class="btn btn-danger btn-sm delete" idUser="{{ $user->id }}">
                            <i class="fas fa-trash-alt"></i>
                            Eliminar
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
    </x-slot>
   
    <x-slot name="pagination">
        {{ $users->links() }}
    </x-slot>

</x-table>