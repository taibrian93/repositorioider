<div class="form-group">
    <label for="">Título</label>
    <p class="form-control">{{ $file->titulo }}</p>
</div>

<div class="form-group">
    <label for="">Descripción</label>
    <p class="form-control">{{ $file->descripcion }}</p>
</div>

<div class="form-group">
    <label for="">Código</label>
    <p class="form-control">{{ $file->codigo }}</p>
</div>

<div class="form-group">
    <label for="">Palabras Clave</label>
    <p class="form-control">{{ $file->tagList }}</p>
</div>


<div class="form-group">
    <label for="">Lenguaje</label>
    <p class="form-control">{{ $file->language }}</p>
</div>

<div class="form-group">
    <label for="">Nodo</label>
    <p class="form-control">{{ $file->node }}</p>
</div>

<div class="form-group">
    <label for="">Encargado</label>
    <p class="form-control">{{ $file->name }}</p>
</div>

<div class="form-group">
    <label for="">Tipo Documento</label>
    <p class="form-control">{{ $file->typeDocument }}</p>
</div>

<div class="form-group">
    <label for="">Tipo Formato</label>
    <p class="form-control">{{ $file->typeFormat }}</p>
</div>

<div class="form-group">
    <label for="">Tipo Extensión</label>
    <p class="form-control">{{ $file->extensionArchivo }}</p>
</div>

<div class="form-group">
    <label for="">Departamento</label>
    <p class="form-control">{{ $file->department }}</p>
</div>

<div class="form-group">
    <label for="">Provincia</label>
    <p class="form-control">{{ $file->province }}</p>
</div>

<div class="form-group">
    <label for="">Distrito</label>
    <p class="form-control">{{ $file->district }}</p>
</div>

<div class="form-group">
    <label for="">Centro Poblado</label>
    <p class="form-control">{{ $file->populationCenter }}</p>
</div>


<div class="form-group">
    <label for="">Fecha Documento</label>
    <p class="form-control">{{ $file->fechaDocumento }}</p>
</div>

<div class="form-group">
    <label for="">Fecha Registro</label>
    <p class="form-control">{{ $file->created_at->format('d-m-Y H:i') }}</p>
</div>

<div class="form-group">
    <label for="">Fecha Actualización</label>
    <p class="form-control">{{ $file->updated_at->format('d-m-Y H:i') }}</p>
</div>

<div class="form-group">
    <label for="">Tamaño Archivo</label>
    <p class="form-control">{{ Helper::bytesToHuman($file->sizeFile) }}</p>
</div>

<div class="form-group mb-4">
    <label for="">Estado</label>
    <p class="form-control">{{ $file->estado == 1 ? 'Público' : 'Privado' }}</p>
</div>

<div class="btn-group float-right">
    @if ($file->estado == 0)
        <a class="btn btn-app" href="/admin/{{ $file->enlace }}" target="_blank" rel="noopener noreferrer">
            <i class="fas fa-download"></i> Descargar Archivo <br>
        </a>
    @else
        <a class="btn btn-app" href="{{ Storage::url($file->enlace) }}" target="_blank" rel="noopener noreferrer">
            <i class="fas fa-download"></i> Descargar Archivo <br>
        </a>
    @endif
</div>