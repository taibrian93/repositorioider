<div class="form-group">
    <label for="">Nodo</label>
    <p class="bg-light text-dark p-3 rounded text-justify">{{ $user->descripcionNodo }}</p>
</div>

<div class="form-group">
    <label for="">Nombre</label>
    <p class="bg-light text-dark p-3 rounded text-justify">{{ $user->name }}</p>

</div>

<div class="form-group">
    <label for="">DNI</label>
    <p class="bg-light text-dark p-3 rounded text-justify">{{ $user->dni }}</p>
</div>

<div class="form-group">
    <label for="">Correo</label>
    <p class="bg-light text-dark p-3 rounded text-justify">{{ $user->email }}</p>
</div>

<div class="form-group">
    {!! Form::label('name', 'Contraseña Antigua: ') !!}
    {!! Form::password('oldPassword', array('placeholder' => 'Contraseña Antigua', 'class' => 'form-control' . ($errors->has('oldPassword') ? ' is-invalid' : '' ) ) ) !!}
    @error('oldPassword')
        <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </span>    
    @enderror
</div>

<div class="form-group">
    {!! Form::label('name', 'Contraseña Nueva: ') !!}
    {!! Form::password('newPassword', array('placeholder' => 'Contraseña Nueva', 'class' => 'form-control' . ($errors->has('newPassword') ? ' is-invalid' : '' ) ) ) !!}
    @error('newPassword')
        <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </span>    
    @enderror
</div>

<div class="form-group">
    {!! Form::label('name', 'Confirmar Contraseña Nueva: ') !!}
    {!! Form::password('checkNewPassword', array('placeholder' => 'Confirmar Contraseña Nueva', 'class' => 'form-control' . ($errors->has('checkNewPassword') ? ' is-invalid' : '' ) ) ) !!}
    @error('checkNewPassword')
        <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </span>    
    @enderror
</div>