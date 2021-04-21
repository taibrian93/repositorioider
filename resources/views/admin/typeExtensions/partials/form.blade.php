<div class="form-group">
    {!! Form::label('name', 'Tipo Formato: ') !!}
    {!! Form::select('idTypeFormat',$typeFormats, null, ['class' => 'form-control typeFormat', 'placeholder' => 'Seleccione Tipo Formato...']) !!}
    
    @error('idTypeFormat')
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

<div class="form-group">
    {!! Form::label('name', 'Estado: ') !!}
    {!! Form::select('estado', ['No Disponible', 'Disponible'], null, ['class' => 'form-control']) !!}
    @error('codigo')
        <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </span>    
    @enderror
</div>