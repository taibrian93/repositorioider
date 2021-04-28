<div class="form-group">
    {!! Form::label('name', 'Departamento (*): ') !!}
    {!! Form::select('idDepartment',$departments, null, ['class' => 'form-control department', 'placeholder' => 'Seleccione Departamento...', 'style' => 'width:100%;']) !!}
    
    @error('idDepartment')
        <small class="text-danger">
            <strong>{{ $message }}</strong>
        </small>   
    @enderror

    <small class="text-danger idDepartment_err">
        
    </small>
</div>

<div class="form-group">
    {!! Form::label('name', 'Provincia (*): ') !!}
    {!! Form::select('idProvince', isset($provinces) ? $provinces : [], null, ['class' => 'form-control province', 'placeholder' => 'Seleccione Provincia...', 'style' => 'width:100%;']) !!}
    
    @error('idProvince')
        <small class="text-danger">
            <strong>{{ $message }}</strong>
        </small>    
    @enderror
    <small class="text-danger idProvince_err">
        
    </small>
</div>

<div class="form-group">
    {!! Form::label('name', 'Distrito (*): ') !!}
    {!! Form::select('idDistrict', isset($districts) ? $districts : [], null, ['class' => 'form-control district', 'placeholder' => 'Seleccione Distrito...', 'style' => 'width:100%;']) !!}
    
    @error('idDistrict')
        <small class="text-danger">
            <strong>{{ $message }}</strong>
        </small>  
    @enderror
    <small class="text-danger idDistrict_err">
        
    </small>
</div>

<div class="form-group">
    {!! Form::label('name', 'Centro Poblado (*): ') !!}
    {!! Form::select('idPopulationCenter', isset($populationCenters) ? $populationCenters : [], null, ['class' => 'form-control populationCenter', 'placeholder' => 'Seleccione Centro Poblado...', 'style' => 'width:100%;']) !!}
    
    @error('idPopulationCenter')
        <small class="text-danger">
            <strong>{{ $message }}</strong>
        </small>  
    @enderror
    <small class="text-danger idPopulationCenter_err">
        
    </small>
</div>

<div class="form-group">
    {!! Form::label('name', 'Tipo Documento (*): ') !!}
    {!! Form::select('idTypeDocument',$typeDocuments, null, ['class' => 'form-control typeDocument', 'placeholder' => 'Seleccione Tipo Documento...', 'style' => 'width:100%;']) !!}
    
    @error('idTypeDocument')
        <small class="text-danger">
            <strong>{{ $message }}</strong>
        </small>     
    @enderror
    <small class="text-danger idTypeDocument_err">
        
    </small>
</div>

<div class="form-group">
    {!! Form::label('name', 'Lenguaje (*): ') !!}
    {!! Form::select('idLanguage',$languages, null, ['class' => 'form-control language', 'placeholder' => 'Seleccione Lenguaje...', 'style' => 'width:100%;']) !!}
    
    @error('idLanguage')
        <small class="text-danger">
            <strong>{{ $message }}</strong>
        </small>     
    @enderror
    <small class="text-danger idLanguage_err">
        
    </small>
</div>

<div class="form-group">
    {!! Form::label('titulo', 'Titulo (*): ') !!}
    {!! Form::text('titulo', null, ['class' => 'form-control' . ($errors->has('titulo') ? ' is-invalid' : ''), 'placeholder' => 'Escriba un titulo', 'style' => 'width:100%;']) !!}
    @error('titulo')
        <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </span>    
    @enderror
    <small class="text-danger titulo_err">
        
    </small>  
</div>

<div class="form-group">
    {!! Form::label('descripcion', 'Descripción (*): ') !!}
    {!! Form::text('descripcion', null, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Escriba una descripción', 'style' => 'width:100%;']) !!}
    @error('descripcion')
        <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </span>    
    @enderror
    <small class="text-danger descripcion_err">
        
    </small>
</div>

<div class="form-group">
    {!! Form::label('tags', 'Palabras Clave (*): ') !!}
    {!! Form::text('tags', $file->tagList ?? null, ['class' => 'form-control tagin' . ($errors->has('tags') ? ' is-invalid' : ''), 'data-placeholder' =>  'Escribe una etiqueta', 'data-separator' => ',']) !!}
    @error('tags')
        <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </span>    
    @enderror
    <small class="text-danger tags_err">
        
    </small>
</div>

<div class="form-group">
    {!! Form::label('archivo', 'Archivo (*): ') !!}
    {!! Form::file('archivo', ['class' => 'form-control-file file']) !!}
    @error('archivo')
        <small class="text-danger">
            <strong>{{ $message }}</strong>
        </small>  
    @enderror
    <small class="text-danger archivo_err">
        
    </small>
</div>

<div class="form-group">
    {!! Form::label('name', 'Estado: ') !!}
    {!! Form::select('estado', ['0' => 'Privado', '1' => 'Público'], null, ['class' => 'form-control']) !!}
    @error('codigo')
        <small class="text-danger">
            <strong>{{ $message }}</strong>
        </small>    
    @enderror
    <small class="text-danger estado_err">
        
    </small>
</div>