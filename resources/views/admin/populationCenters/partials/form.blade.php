<div class="form-group">
    {!! Form::label('name', 'Departamento: ') !!}
    {!! Form::select('idDepartment',$departments, null, ['class' => 'form-control department', 'placeholder' => 'Seleccione Departamento...']) !!}
    
    @error('idDepartment')
        <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </span>    
    @enderror
</div>

<div class="form-group">
    {!! Form::label('name', 'Provincia: ') !!}
    {!! Form::select('idProvince', isset($provinces) ? $provinces : [], null, ['class' => 'form-control province', 'placeholder' => 'Seleccione Provincia...']) !!}
    
    @error('idProvince')
        <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </span>    
    @enderror
</div>

<div class="form-group">
    {!! Form::label('name', 'Distrito: ') !!}
    {!! Form::select('idDistrict', isset($districts) ? $districts : [], null, ['class' => 'form-control district', 'placeholder' => 'Seleccione Distrito...']) !!}
    
    @error('idDistrict')
        <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </span>    
    @enderror
</div>


<div class="form-group">
    {!! Form::label('descripcion', 'Descripción: ') !!}
    {!! Form::text('descripcion', null, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Escriba una descripción']) !!}
    @error('descripcion')
        <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </span>    
    @enderror
</div>

<div class="row">
    <div class="col-md-12">
        {!! Form::label('name', 'Codigo Centro Poblado: ') !!}
    </div>
</div>

<div class="row mb-3">
    
    <div class="col-md-2">
        {!! Form::text('codigoCentroPoblado', null, ['class' => 'form-control-plaintext codigoCentroPoblado' . ($errors->has('codigoCentroPoblado') ? ' is-invalid' : ''), 'readonly']) !!}
        @error('codigoCentroPoblado')
            <span class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </span>    
        @enderror
    </div>

    <div class="col-md-10">
        {!! Form::text('codigo', null, ['class' => 'form-control codigo' . ($errors->has('codigo') ? ' is-invalid' : ''), 'placeholder' => 'Escribe un codigo', 'maxlength' => '4']) !!}
        @error('codigo')
            <span class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </span>    
        @enderror
    </div>
    
</div>

<div class="form-group">
    {!! Form::label('name', 'Estado: ') !!}
    {!! Form::select('estado', ['No Disponible', 'Disponible'], null, ['class' => 'form-control']) !!}
    @error('codigo')
        <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </span>    
    @enderror
</div>