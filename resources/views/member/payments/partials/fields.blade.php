<!-- /.box-header -->
<div class="box-body">
    <div class="box-bodys">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-danger">
                        <div class="box-header">
                            <h3 class="box-title">Datos del evento de  <b>{{Auth()->user()->fullname}}</b></h3>
                        </div>
                    <div class="col-md-6">
                    <br>
                        <div class="form-group">
                            <label for="neto" class="col-sm-4 control-label">Titulo:</label>
                            <div class="col-sm-8">
                            {!! Form::text('title', $order->title, ['class' => 'form-control', 'disabled' => 'true']) !!}
                            
                            <input type="hidden" value="{{$order->id}}" name="order_id" id="order_id">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="iva_show" class="col-sm-4 control-label">Fecha:</label>
                            <div class="col-sm-8">
                            {!! Form::text('date', $order->date, ['class' => 'form-control', 'disabled' => 'true']) !!}
                            {!! Form::hidden('order_id', $order->id, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="iva_show" class="col-sm-4 control-label">Ubicacion:</label>
                            <div class="col-sm-8">
                            {!! Form::text('locale', $order->locale, ['class' => 'form-control', 'disabled' => 'true']) !!}
                            {!! Form::hidden('locale', $order->locale, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        @if($order->notes != null)
                        <div class="form-group">
                            <label for="notes" class="col-sm-4 control-label">Info adicional</label>
                            <div class="col-sm-8">
                                {!! Form::text('notes', $order->notes, ['class' => 'form-control', 'disabled' => 'true']) !!}
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                    <br>
                        @if($order->discount != null)
                        <div class="form-group">
                            <label for="iva_show" class="col-sm-4 control-label">Descuento</label>
                            <div class="col-sm-8">
                            {!! Form::text('iva_show', $order->discount, ['class' => 'form-control', 'placeholder' => 'Iva', 'disabled' => 'true']) !!}
                            {!! Form::hidden('discount', $order->discount, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        @endif
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
                            <label for="total_show" class="col-sm-4 control-label">Total a pagar</label>
                            <div class="col-sm-8"><b>
                            {!! Form::text('total_show', $order->total, ['class' => 'form-control total', 'placeholder' => 'Total', 'disabled' => 'true']) !!}
                            {!! Form::hidden('total', $order->total, ['class' => 'form-control total', 'placeholder' => 'Neto']) !!}
                            </b></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<br>
    <div class="row">
            <div class="col-md-12">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        @include('partials.errors')
                        <h3 class="box-title">Registro de pago</h3>
                    </div>
                        <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('date', 'Fecha de pago') !!}
                                        {!! Form::text('date', null, ['class' => 'form-control datepicker', 'placeholder' => 'Fecha de pago']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('type', 'Tipo de pago') !!}
                                        {!! Form::select('type', ['bank' => 'Deposito o transferencia', 'cash' => 'Efectivo en oficina'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione tipo de pago']) !!}
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                            {!! Form::label('mount', 'Monto') !!}
                                            {!! Form::text('mount', null, ['class' => 'form-control', 'placeholder' => 'Ingrese monto']) !!}
                                    </div>
                                    <div class="form-group">
                                            {!! Form::label('ref', 'Ingrese numero de referencia') !!}
                                            {!! Form::text('ref', null, ['class' => 'form-control', 'placeholder' => 'Ingrese numero de referencia']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        


                                        <div class="for text-center">
                                            {!! Form::submit('REGISTRAR', ['class'=> 'btn btn-success']) !!}
                                        <a class="btn btn-danger" href="{{route('payments.index')}}">
                                            ATRAS
                                        </a>
                                        </div>
</div>