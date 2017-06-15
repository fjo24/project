                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {!! Form::label('date', 'Fecha de inicio') !!}
                                            {!! Form::text('date', null, ['class' => 'form-control', 'placeholder' => 'Ingrese fecha']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('end_date', 'Fecha final') !!}
                                            {!! Form::text('end_date', null, ['class' => 'form-control', 'placeholder' => 'Ingrese fecha si aplica']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('user_id', 'Cliente') !!}
                                            {!! Form::select('user_id', $users, null, ['class' => 'form-control', 'required']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('title', 'Titulo del evento') !!}
                                                {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Ingrese aqui un titulo o descripcion breve del evento']) !!}
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
                                            {!! Form::label('notes', 'Información adicional') !!}
                                            {!! Form::text('notes', null, ['class' => 'form-control', 'placeholder' => 'Incluya aca cualquier información adicional de interes']) !!}
                                        </div>
                                    </div>

<div class="container">
    <div class="row">
        <h2>Seleccione producto y cantidad</h2>
       
        <div class="col-md-8">
        @foreach ($order->products as $product)
            <div class="contacts">
                
                    <div class="form-group multiple-form-group input-group">
                    <div class="col-md-1">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-danger btn-remove">-</button>
                        </span>
                    </div>
                    <div class="col-md-5">
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

                                        {!! Form::submit('Registrar', ['class'=> 'btn btn-primary']) !!}
                                        <a class="btn btn-success btn-sm" href="{{route('orders.index')}}">
                                        Cancelar
                                        </a>
                                    </div>