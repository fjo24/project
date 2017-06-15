<div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="box">
                <div class="box-header with-border">
              
                    @include('partials.errors')
                    
                    <h3 class="box-title">Registro de producto</h3>
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
                                            {!! Form::label('name', 'Nombre del producto') !!}
                                                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre de producto']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('type', 'Tipo de producto') !!}
                                                {!! Form::select('type', ['' => 'Seleccione un tipo de producto', 'rent' => 'Para alquiler', 'sale' => 'Para venta'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione un tipo de producto']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('info', 'Descripción del producto') !!}
                                                {!! Form::text('info', null, ['class' => 'form-control', 'placeholder' => 'Descripción del producto']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('quantity', 'cantidad en almacen') !!}
                                                {!! Form::text('quantity', null, ['class' => 'form-control', 'placeholder' => 'Ingrese cantidad']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('available', 'cantidad disponible en almacen') !!}
                                                {!! Form::text('available', null, ['class' => 'form-control', 'placeholder' => 'Ingrese cantidad']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('cost', 'Valor del producto') !!}
                                                {!! Form::text('cost', null, ['class' => 'form-control', 'placeholder' => 'Ingrese valor comercial del producto']) !!}
                                        </div>
                                    </div>
                                    <div class="for text-center">
                                        {!! Form::submit('Registrar', ['class'=> 'btn btn-primary']) !!}
                                        <a class="btn btn-success btn-sm" href="{{route('products.index')}}">
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