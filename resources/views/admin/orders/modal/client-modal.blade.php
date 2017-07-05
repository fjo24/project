<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form class="form-horizontal" role="form" method="POST" action="{{ route('users.store') }}">
            {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Nuevo Cliente</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                    <label for="type" class="col-md-4 control-label">Tipo de usuario</label>
                    <div class="col-md-6">
                        
                        {!! Form::select('type', ['' => 'Seleccione un tipo de usuario', 'person' => 'Persona Natural', 'organization' => 'Organización'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione un nivel de usuario']) !!}
                    </div>
                    </div>
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="fullname" class="col-md-4 control-label">Nombre</label>

                        <div class="col-md-6">
                            <input id="fullname" type="text" class="form-control" name="fullname" value="{{ old('fullname') }}"
                                    autofocus>

                            @if ($errors->has('fullname'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('fullname') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">Correo electronico</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                                   >

                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('identification') ? ' has-error' : '' }}">
                        <label for="identification" class="col-md-4 control-label">Cedula o Rif</label>

                        <div class="col-md-6">
                            <input id="identification" type="text" class="form-control" name="identification" value="{{ old('identification') }}"
                                    autofocus>

                            @if ($errors->has('identification'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('identification') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
                        <label for="telephone" class="col-md-4 control-label">Telefono</label>

                        <div class="col-md-6">
                            <input id="telephone" type="text" class="form-control" name="telephone" value="{{ old('telephone') }}"
                                    autofocus>

                            @if ($errors->has('telephone'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('telephone') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                    <label for="password" class="col-md-4 control-label">Password</label>
                        <div class="col-md-6">
                        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Ingrese contraseña', 'required']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                    <label for="type" class="col-md-4 control-label">Confirme contraseña</label>
                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirme contraseña" required>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>
            </div>
        </form>
    </div>
</div>
