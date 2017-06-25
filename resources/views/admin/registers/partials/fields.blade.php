                        <div class="col-md-6 col-md-offset-3">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Datos de la entrada o salida</h3>
                                </div>
                                <div class="col-md-12">
                                        <div class="form-group">
                                            {!! Form::label('date', 'Fecha') !!}
                                            {!! Form::text('date', null, ['class' => 'form-control datepicker', 'placeholder' => 'Ingrese fecha']) !!}
                                        </div> 
                                        <div class="form-group">
                                            {!! Form::label('type', 'Tipo') !!}
                                            {!! Form::select('type', ['entry' => 'Entrada de productos al almacen', 'remove' => 'Salida de productos del almacen'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione tipo de registro']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('info', 'Descripción') !!}
                                            {!! Form::text('info', null, ['class' => 'form-control', 'placeholder' => 'Incluya aca cualquier información adicional de interes']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('provider_id', 'Proveedor') !!}
                                            {!! Form::select('provider_id', $providers, null, ['class' => 'form-control', 'placeholder' => 'Seleccione proveedor']) !!}
                                        </div>
                                        <center> 
                                                <div class="col-md-12">
                                                    <div class="col-md-12">    
                                                        <h2>Seleccione producto y cantidad</h2>
                                                    </div>
                                                    <div class="row">
                                                        <div class="contacts">
                                                        <div class="col-md-12">
                                                            <div class="form-group multiple-form-group input-group">
                                                                <div class="col-md-6">
                                                                    <div class="input-group-btn input-group-select">
                                                                        <div class="form-group">
                                                                            {!! Form::select('product_id[]', $products, null, ['class' => 'form-control', 'placeholder' => 'Indique producto', 'required']) !!}
                                                                        </div>
                                                                        <input type="hidden" class="input-group-select-val" name="contacts['type'][]" value="phone">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    {!! Form::text('quantity[]', null, ['class' => 'form-control', 'placeholder' => 'cantidad', 'required']) !!}
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <span class="input-group-btn">
                                                                        <button type="button" class="btn btn-success btn-add">+</button>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </center>
                                    </div>
                                    <div class="for text-center">
                                        {!! Form::submit('REGISTRAR', ['class'=> 'btn btn-primary  btn-sm']) !!}
                                        <a class="btn btn-success btn-sm" href="{{route('orders.index')}}">
                                            CANCELAR
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                