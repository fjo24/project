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
                                            {!! Form::label('fullname', 'Nombre') !!}
                                                {!! Form::text('fullname', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('type', 'Tipo de usuario') !!}
                                                {!! Form::select('type', ['' => 'Seleccione un tipo de usuario', 'person' => 'Persona natural', 'organization' => 'Organizacion'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione un tipo de usuario']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('level', 'Nivel de usuario') !!}
                                                {!! Form::select('level', ['' => 'Seleccione un nivel de usuario', 'member' => 'Miembro', 'admin' => 'Administrador'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione un nivel de usuario']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('identification', 'Numero de cedula') !!}
                                                {!! Form::text('identification', null, ['class' => 'form-control', 'placeholder' => 'Ingrese su ID', 'required']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('telephone', 'Telefono') !!}
                                                {!! Form::text('telephone', null, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('email', 'Correo Electronico') !!}
                                                {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'example@gmail.com', 'required']) !!}
                                        </div>
                                        