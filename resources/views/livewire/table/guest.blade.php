<x-guest-table>
    @slot('advancedSearch')
    @endslot
    @slot('selectFilter')
        <select class="form-control" wire:model="selectFilter" style="max-width: 110px">
            <option value="titulo">Título</option>
            <option value="codigo">Código</option>
        </select>
    @endslot

    @slot('head')
        <tr>
            <th style="width: 5%">Nro.</th>
            <th style="width: 41%">Titulo</th>
            {{-- <th>Código</th> --}}
            <th style="width: 10%">Nodo</th>
            <th style="width: 17%">Fecha Registro</th>
            <th style="width: 17%">Fecha Actualización</th>
            <th style="width: 10%">
        
            </th>
        </tr>          
    @endslot

    @slot('body')
        @foreach ($files as $key => $file)
            <tr>
                <td>{{ (($page-1)*10)+($key+1) }}</td>
                <td style="text-align: justify;">{{ $file->titulo }}</td>
                {{-- <td>{{ $file->codigo }}</td> --}}
                <td>{{ $file->siglas }}</td>
                <td>{{ $file->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $file->updated_at->format('d/m/Y H:i') }}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{ Storage::url($file->enlace) }}" class="btn btn-primary btn-sm btn-block" target="_blank" style="width: 70px">
                            <i class="fas fa-download"></i>
                            
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
    @endslot

    @slot('pagination')

      {{ $files->links() }}
    @endslot
  
</x-guest-table>