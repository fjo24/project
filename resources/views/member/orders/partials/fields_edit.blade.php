<!-- /.box-header -->
<div class="box-body">
    <div class="box-bodys">
        <div class="row">
                <div class="col-md-12">
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            @include('partials.errors')
                            <h3 class="box-title">Datos del evento</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!! Form::label('title', 'Titulo') !!}
                                                {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Ingrese aqui un titulo o descripcion breve del evento', 'required']) !!}
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label('event_id', 'Tipo de evento') !!}
                                                {!! Form::select('event_id', $events, null, ['class' => 'form-control', 'placeholder' => 'Seleccione tipo de evento', 'required']) !!}
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label('date', 'Fecha') !!}
                                                {!! Form::text('date', null, ['class' => 'form-control datepicker', 'placeholder' => 'Ingrese fecha', 'required']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!! Form::label('locale', 'Ubicacion del evento') !!}
                                                {!! Form::text('locale', null, ['class' => 'form-control', 'placeholder' => 'Ubicacion del evento', 'required']) !!}
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label('notes', 'Información adicional') !!}
                                                {!! Form::text('notes', null, ['class' => 'form-control', 'placeholder' => 'Incluya aca cualquier información adicional de interes', 'required']) !!}
                                            </div>
                                            <div class="form-group">
                        <input type="hidden" value="{{$user->id}}" name="user_id" id="user_id">

                    </div>
                                        </div>
                                    </div>


    <div class="col-md-12">
                    <div class="box box-danger">
                        <div class="box-header">
                            <h3 class="box-title">Seleccione producto o servicio</h3>
                            <div class="pull-right">
                            </div>
                        </div>
                        <div class="contacts">
                                        @foreach ($order->products as $product)
                                        <div class="form-group multiple-form-group input-group">
                                                    <div class="col-md-4">
                                                        <label>Producto o servicio</label>
                                                        <div class="input-group-btn input-group-select">
                                                            <div class="form-group">
                                                                {!! Form::select('product_id[]', $products, $product->id, ['class' => 'form-control select-product', 'placeholder' => 'Indique producto', 'required']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>Precio</label>
                                                        {!! Form::text('product_cost[]', $product->cost, ['class' => 'form-control producto-price', 'placeholder' => 'precio', 'disabled' => 'true']) !!}
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>Cantidad</label>
                                                        {!! Form::text('quantity[]', $product->pivot->quantity, ['class' => 'form-control producto-quantity', 'placeholder' => 'cantidad']) !!}
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label> - </label>
                                                        <span class="input-group-btn">
                                                            <button type="button" class="btn btn-danger btn-remove">-</button>
                                                        </span>
                                                    </div>
                                            </div>
                                        @endforeach
                                        <div class="form-group multiple-form-group input-group">
                                            <div class="col-md-4">
                                                <label>Producto o servicio</label>
                                                <div class="input-group-btn input-group-select">
                                                    <div class="form-group">
                                                        {!! Form::select('product_id[]', $products, null, ['class' => 'form-control select-product', 'placeholder' => 'Indique producto']) !!}
                                                    </div>
                                                    <input type="hidden" class="input-group-select-val" name="contacts['type'][]" value="phone">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Precio</label>
                                                {!! Form::text('product_cost[]', null, ['class' => 'form-control producto-price', 'placeholder' => 'precio', 'disabled' => 'true']) !!}
                                            </div>
                                            <div class="col-md-3">
                                                <label>Cantidad</label>
                                                {!! Form::text('quantity[]', null, ['class' => 'form-control producto-quantity', 'placeholder' => 'cantidad']) !!}
                                            </div>
                                            <div class="col-md-2">
                                                <label> - </label>
                                                <span class="input-group-btn">
                                            <button type="button" class="btn btn-success btn-add">+</button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                    </div>
                </div>





                        
                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="row">
        <div class="col-md-12">
            @include('member.orders.partials.clients-data')
            <div class="col-md-6">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">Total</h3>
                    </div>
                    <div class="form-group">
                        <label for="neto" class="col-sm-4 control-label">Neto</label>
                        <div class="col-sm-8">
                        {!! Form::text('neto_show', $order->neto, ['class' => 'form-control neto', 'placeholder' => 'Neto', 'disabled' => 'true']) !!}
                        
                        {!! Form::hidden('neto', $order->neto, ['class' => 'form-control neto', 'placeholder' => 'Neto']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="iva_show" class="col-sm-4 control-label">Iva</label>
                        <div class="col-sm-8">
                        {!! Form::text('iva_show', $order->iva, ['class' => 'form-control iva', 'placeholder' => 'Iva', 'disabled' => 'true']) !!}
                        {!! Form::hidden('iva', $order->iva, ['class' => 'form-control iva', 'placeholder' => 'Neto']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="total_show" class="col-sm-4 control-label">Total</label>
                        <div class="col-sm-8">
                        {!! Form::text('total_show', $order->total, ['class' => 'form-control total', 'placeholder' => 'Total', 'disabled' => 'true']) !!}
                        {!! Form::hidden('total', $order->total, ['class' => 'form-control total', 'placeholder' => 'Neto']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="for text-center">
                        {!! Form::submit('EDITAR', ['class'=> 'btn btn-success']) !!}
                        <a class="btn btn-danger" href="{{route('orders.index')}}">
                            CANCELAR
                        </a>
                    </div>
</div>