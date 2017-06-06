<div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="box">
                <div class="box-header with-border">
              
                    @include('partials.errors')
                    
                    <h3 class="box-title">Registro de usuario</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <!--Contenido-->
                            <div class="col-md-12">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">DATOS DEL USUARIO</h3>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {!! Form::label('name', 'Nombre') !!}
                                                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('last_name', 'Apellido') !!}
                                                {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Apellido']) !!}
                                        </div>
                                       
                                        <div class="form-group">
                                            {!! Form::label('type', 'Tipo') !!}
                                                {!! Form::select('type', ['' => 'Seleccione un nivel de usuario','member' => 'Miembro', 'admin' => 'Administrador'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione un nivel de usuario']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('cedula', 'Numero de cedula') !!}
                                                {!! Form::text('cedula', null, ['class' => 'form-control', 'placeholder' => 'Ingrese su ID', 'required']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('telefono', 'Telefono') !!}
                                                {!! Form::text('telefono', null, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('email', 'Correo Electronico') !!}
                                                {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'example@gmail.com', 'required']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('password', 'Contraseña') !!}
                                                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Ingrese contraseña', 'required']) !!}
                                        </div>

                                        <div class="form-group">
                                            {!! Form::label('password', 'Contraseña') !!}
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirme contraseña" required>
                                        </div>
                                    </div>
                                    <div class="for text-center">
                                        {!! Form::submit('Registrar', ['class'=> 'btn btn-primary']) !!}
                                        <a class="btn btn-success btn-sm" href="{{route('users.index')}}">
                                        ATRAS
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>