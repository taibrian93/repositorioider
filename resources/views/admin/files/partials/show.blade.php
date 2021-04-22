<div class="form-group">
    {!! Form::label('codigo', 'Codigo: ') !!}
    {!! Form::text('codigo', null, ['class' => 'form-control', 'readonly' => '']) !!}
</div>

<div class="form-group">
    {!! Form::label('name', 'Departamento: ') !!}
    {!! Form::select('idDepartment',$departments, null, ['class' => 'form-control department', 'disabled' => '']) !!}
</div>

<div class="form-group">
    {!! Form::label('name', 'Provincia: ') !!}
    {!! Form::select('idProvince', isset($provinces) ? $provinces : [], null, ['class' => 'form-control province','disabled' => '']) !!}
</div>

<div class="form-group">
    {!! Form::label('name', 'Distrito: ') !!}
    {!! Form::select('idDistrict', isset($districts) ? $districts : [], null, ['class' => 'form-control district','disabled' => '']) !!}
</div>

<div class="form-group">
    {!! Form::label('name', 'Tipo Documento: ') !!}
    {!! Form::select('idTypeDocument',$typeDocuments, null, ['class' => 'form-control','disabled' => '']) !!}
</div>

<div class="form-group">
    {!! Form::label('name', 'Tipo Formato: ') !!}
    {!! Form::select('idTypeFormat',$typeFormats, null, ['class' => 'form-control','disabled' => '']) !!}
</div>

<div class="form-group">
    {!! Form::label('name', 'Lenguaje: ') !!}
    {!! Form::select('idLanguage',$languages, null, ['class' => 'form-control','disabled' => '']) !!}
</div>

<div class="form-group">
    {!! Form::label('titulo', 'Titulo: ') !!}
    {!! Form::text('titulo', null, ['class' => 'form-control', 'readonly' => '']) !!}
</div>

<div class="form-group">
    {!! Form::label('descripcion', 'Descripción: ') !!}
    {!! Form::text('descripcion', null, ['class' => 'form-control','readonly' => '']) !!}
</div>

<div class="form-group">
    {!! Form::label('encargado', 'Encargado: ') !!}
    {!! Form::text('name', null, ['class' => 'form-control','readonly' => '']) !!}
</div>

<div class="form-group">
    {!! Form::label('archivo', 'Archivo: ') !!}
    <br>
    @if ($file->estado == 0)
        <a href="/admin/{{ $file->enlace }}" target="_blank" rel="noopener noreferrer">
            {{ $file->codigo }}
        </a>
    @else
        <a href="{{ Storage::url($file->enlace) }}" target="_blank" rel="noopener noreferrer">
            {{ $file->codigo }}
        </a>
    @endif
</div>

<div class="form-group">
    {!! Form::label('create', 'Fecha Creación: ') !!}
    {!! Form::text('created_at', null, ['class' => 'form-control','readonly' => '']) !!}
</div>

<div class="form-group">
    {!! Form::label('create', 'Fecha Actualización: ') !!}
    {!! Form::text('updated_at', null, ['class' => 'form-control','readonly' => '']) !!}
</div>

<div class="form-group">
    {!! Form::label('sizeFile', 'Tamaño Archivo: ') !!}
    <input type="text" value="{{ Helper::bytesToHuman($file->sizeFile) }}" class="form-control" readonly>
</div>

<div class="form-group">
    {!! Form::label('name', 'Estado: ') !!}
    {!! Form::select('estado', ['Privado', 'Público'], null, ['class' => 'form-control','disabled' => '']) !!}
</div>