<div class="form-group">
    {!! Form::label('idNode', 'Nodo: ') !!}
    {!! Form::select('idNode',$nodes, null, ['class' => 'form-control node', 'placeholder' => 'Seleccione Nodo...']) !!}
    
    @error('idNode')
        <small class="text-danger">
            <strong>{{ $message }}</strong>
        </small>     
    @enderror
</div>

<div class="form-group">
    {!! Form::label('name', 'Nombre: ') !!}
    {!! Form::text('name', null, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Escribe un nombre']) !!}
    @error('name')
        <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </span>    
    @enderror
</div>

<div class="form-group">
    {!! Form::label('name', 'DNI: ') !!}
    {!! Form::text('dni', null, ['class' => 'form-control dni' . ($errors->has('dni') ? ' is-invalid' : ''), 'placeholder' => 'Escribe numero de DNI', 'maxlength' => '8']) !!}
    @error('dni')
        <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </span>    
    @enderror
</div>

<div class="form-group">
    {!! Form::label('name', 'Email: ') !!}
    {!! Form::email('email', null, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Escribe un correo']) !!}
    @error('email')
        <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </span>    
    @enderror
</div>

<div class="form-group">
    {!! Form::label('name', 'Contraseña: ') !!}
    {!! Form::password('password', array('placeholder' => 'Password', 'class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : '' ) ) ) !!}
    @error('password')
        <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </span>    
    @enderror
</div>

<div>
    <h3 class="h3">Lista de roles</h3>
    @foreach ($roles as $role)
        <label for="">
            {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1']) !!}
            {{ $role->name }}
        </label>
    @endforeach
</div>