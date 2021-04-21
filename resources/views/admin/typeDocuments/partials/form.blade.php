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
    {!! Form::label('name', 'Observación: ') !!}
    {!! Form::text('observacion', null, ['class' => 'form-control' . ($errors->has('observacion') ? ' is-invalid' : ''), 'placeholder' => 'Escribe una Observación']) !!}
    @error('observacion')
        <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </span>    
    @enderror
</div>

<div class="form-group">
    {!! Form::label('name', 'Codigo: ') !!}
    {!! Form::text('codigo', null, ['class' => 'form-control' . ($errors->has('codigo') ? ' is-invalid' : ''), 'placeholder' => 'Escribe un Codigo']) !!}
    @error('codigo')
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