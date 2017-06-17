                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Datos de la orden</h3>
                                </div>                        
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('type', 'Tipo de orden') !!}
                                    {!! Form::select('type', ['service' => 'Servicio de venta o alquiler', 'entry' => 'Entrada de productos al almacen', 'remove' => 'Salida de productos del almacen'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione tipo de registro']) !!}
                                </div> 
                                <div class="form-group">
                                    {!! Form::label('title', 'Titulo') !!}
                                    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Ingrese aqui un titulo o descripcion breve del evento']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('notes', 'Descripción') !!}
                                    {!! Form::text('notes', null, ['class' => 'form-control', 'placeholder' => 'Incluya aca cualquier información adicional de interes']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('date', 'Fecha') !!}
                                    {!! Form::text('date', null, ['class' => 'form-control datepicker', 'placeholder' => 'Ingrese fecha']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('status', 'Estado del evento') !!}
                                    {!! Form::select('status', ['' => 'Seleccione estado del evento','on_hold' => 'Por confirmar', 'confirmed' => 'Confirmada'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione un nivel de usuario']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('user_id', 'Cliente') !!}
                                    {!! Form::select('user_id', $users, null, ['class' => 'form-control', 'placeholder' => 'Seleccione cliente']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('provider_id', 'Proveedor') !!}
                                    {!! Form::select('provider_id', $providers, null, ['class' => 'form-control', 'placeholder' => 'Seleccione proveedor']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('locale', 'Ubicacion del evento') !!}
                                    {!! Form::text('locale', null, ['class' => 'form-control', 'placeholder' => 'Ubicacion del evento']) !!}
                                </div>
                            </div>
                        
                        
                        <div class="col-md-8 col-md-offset-2">
                <div class="form-group">    
                                                <h2>Seleccione producto y cantidad</h2>
                                            </div>
                                            </div>
                                    <div class="form-group">
                                    @foreach ($order->products as $product)
                                        <div class="contacts">
                                            <div class="col-md-8 col-md-offset-2">

                                                <div class="form-group multiple-form-group input-group">
                                                    <div class="col-md-2">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-danger btn-remove">-</button>
                                                    </span>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="input-group-btn input-group-select">
                                                            <div class="form-group">
                                                                {!! Form::select('product_id[]', $products, $product->id, ['class' => 'form-control', 'required']) !!}
                                                            </div>

                                                            <input type="hidden" class="input-group-select-val" name="contacts['type'][]" value="phone">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        {!! Form::text('quantity[]', $product->pivot->quantity, ['class' => 'form-control', 'placeholder' => 'cantidad', 'required']) !!}
                                                    </div>
                                                    <div class="col-md-2">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-success btn-add">+</button>
                                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        </div>
                                    </div>
                        </div>
                    </div>
                </div> 
                    
                <div class="for text-center">
                    {!! Form::submit('Registrar', ['class'=> 'btn btn-primary  btn-sm']) !!}
                    <a class="btn btn-success btn-sm" href="{{route('orders.index')}}">
                        Cancelar
                    </a>
                </div>
                </div>