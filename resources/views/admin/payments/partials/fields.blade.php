<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="box box-primary">
            <div class="box-header with-border">
                @include('partials.errors')
                <h3 class="box-title">Registro de pago</h3>
            </div>
                <!--Contenido-->
                <div class="form-group">
                    {!! Form::label('date', 'Fecha de pago') !!}
                    {!! Form::text('date', null, ['class' => 'form-control datepicker', 'placeholder' => 'Fecha de pago']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('user_id', 'Nombre de quien paga:') !!}
                    {!! Form::select('user_id', $users, null, ['class' => 'form-control', 'placeholder' => 'Indique la persona responsable del pago']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('order_id', 'Evento a pagar') !!}
                    {!! Form::select('order_id', $orders, null, ['class' => 'form-control', 'placeholder' => 'Seleccione evento']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('type', 'Tipo de pago') !!}
                    {!! Form::select('type', ['bank' => 'Deposito o transferencia', 'cash' => 'Efectivo en oficina'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione tipo de pago']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('mount', 'Monto') !!}
                    {!! Form::text('mount', null, ['class' => 'form-control', 'placeholder' => 'Ingrese monto']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('ref', 'Ingrese numero de referencia') !!}
                    {!! Form::text('ref', null, ['class' => 'form-control', 'placeholder' => 'Ingrese numero de referencia']) !!}
                </div>
                <div class="for text-center">
                    {!! Form::submit('Registrar', ['class'=> 'btn btn-primary']) !!}
                <a class="btn btn-success" href="{{route('payments.index')}}">
                    ATRAS
                </a>
            </div>
        </div>
    </div>
</div>