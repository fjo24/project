<div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="box">
                <div class="box-header with-border">
              
                    @include('partials.errors')
                    
                    <h3 class="box-title">Nuevo evento</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <!--Contenido-->
                            <div class="col-md-12">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">EVENTO</h3>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {!! Form::label('date', 'Fecha') !!}
                                            {!! Form::text('date', null, ['class' => 'form-control', 'placeholder' => 'Ingrese fecha']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('user_id', 'Producto') !!}
                                            {!! Form::select('user_id', $users, null, ['class' => 'form-control', 'required']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('status', 'Estado del evento') !!}
                                            {!! Form::select('status', ['' => 'Seleccione estado del evento','on_hold' => 'Por confirmar', 'confirmed' => 'Confirmada', 'Rejected' => 'Rechazada'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione un nivel de usuario']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('locale', 'Ubicacion del evento') !!}
                                            {!! Form::text('locale', null, ['class' => 'form-control', 'placeholder' => 'Ubicacion del evento']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('comment', 'Comentarios') !!}
                                                {!! Form::textarea('comment', null, ['class' => 'form-control', 'placeholder' => 'Ingrese aqui cualquier dato adicional necesario']) !!}
                                        </div>
                                    </div>
                                    <div class="for text-center">
                                        {!! Form::submit('Registrar', ['class'=> 'btn btn-primary']) !!}
                                        <a class="btn btn-success btn-sm" href="{{route('orders.index')}}">
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
     </div>