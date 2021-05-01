<x-home-table>
    
    @slot('selectFilter')
        <select class="form-control" wire:model="selectFilter">
            <option value="titulo">Título</option>
            <option value="codigo">Código</option>
        </select>
    @endslot

    <x-slot name="head">
        <tr>
            <th style="width: 5%">Nro.</th>
            <th style="width: 41%">Titulo</th>
            {{-- <th>Código</th> --}}

            <th style="width: 17%">Fecha Registro</th>
            <th style="width: 17%">Fecha Actualización</th>
            <th style="width: 10%">
        
            </th>

        </tr>
    </x-slot>

    <x-slot name="body">
        @foreach ($files as $key => $file)
            <tr>
                <td>{{ (($page-1)*10)+($key+1) }}</td>
                <td style="text-align: justify;">{{ $file->titulo }}</td>

                
                <td>{{ $file->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $file->updated_at->format('d/m/Y H:i') }}</td>
                <td>
                    <div class="btn-group">
                        
                        @if ($file->estado == 0)
                            <a class="btn btn-primary btn-sm" href="admin/{{ $file->enlace }}" target="_blank" rel="noopener noreferrer">
                                <i class="fas fa-download"></i> 
                                Descargar
                            </a>
                        @else
                            <a class="btn btn-primary btn-sm" href="{{ Storage::url($file->enlace) }}" target="_blank" rel="noopener noreferrer">
                                <i class="fas fa-download"></i> 
                                Descargar
                            </a>
                        @endif
                        <a href="{{ route('admin.files.show', $file)}}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                             Consultar
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
    </x-slot>
   
    <x-slot name="pagination">
        {{ $files->links() }}
    </x-slot>

</x-table>