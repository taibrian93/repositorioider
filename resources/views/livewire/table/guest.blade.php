<x-guest-table>

    @slot('selectFilter')
        <select class="form-control" wire:model="selectFilter" style="max-width: 110px">
            <option value="titulo">Título</option>
            <option value="codigo">Código</option>
        </select>
    @endslot

    @slot('head')
        <tr>
            <th>Nro.</th>
            <th>Titulo</th>
            <th>Código</th>
            <th>Fecha Publicación</th>
            <th style="width: 10%">
        
            </th>
        </tr>          
    @endslot

    @slot('body')
        @foreach ($files as $key => $file)
            <tr>
                <td>{{ (($page-1)*10)+($key+1) }}</td>
                <td>{{ $file->titulo }}</td>
                <td>{{ $file->codigo }}</td>
                <td>{{ $file->created_at->format('d/m/Y H:i') }}</td>
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