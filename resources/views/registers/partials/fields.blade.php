<div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="box">
                <div class="box-header with-border">
              
                    @include('partials.errors')
                    
                    <h3 class="box-title">Registro de entrada o salida</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <!--Contenido-->
                            <div class="col-md-12">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">PRODUCTO</h3>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {!! Form::label('type', 'Tipo de registro') !!}
                                            {!! Form::select('type', ['entry' => 'Entrada', 'discharge' => 'Salida'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione entrada o salida']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('provider_id', 'Proveedor') !!}
                                            {!! Form::select('provider_id', $provider, null, ['class' => 'form-control', 'required']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('product_id', 'Producto') !!}
                                            {!! Form::select('product_id', $product, null, ['class' => 'form-control', 'required']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('info', 'Detalle del registro') !!}
                                            {!! Form::text('info', null, ['class' => 'form-control', 'placeholder' => 'Detalles del registro', 'required']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('quantity', 'Cantidad') !!}
                                                {!! Form::text('quantity', null, ['class' => 'form-control', 'placeholder' => 'Ingrese cantidad', 'required']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('cost', 'Costo') !!}
                                                {!! Form::text('cost', null, ['class' => 'form-control', 'placeholder' => 'Ingrese costo', 'required']) !!}
                                        </div>
                                    </div>
                                    <div class="for text-center">
                                        {!! Form::submit('Registrar', ['class'=> 'btn btn-primary']) !!}
                                        <a class="btn btn-success btn-sm" href="{{route('registers.index')}}">
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