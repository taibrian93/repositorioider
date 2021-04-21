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
    {!! Form::label('name', 'ISO 639-1: ') !!}
    {!! Form::text('iso_639_1', null, ['class' => 'form-control' . ($errors->has('iso_639_1') ? ' is-invalid' : ''), 'placeholder' => 'Escribe un ISO 639-1']) !!}
    @error('iso_639_1')
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