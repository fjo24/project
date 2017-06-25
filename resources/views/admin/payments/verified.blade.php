@extends('layouts.admin')
@section('title', 'Notificación de pago')
@section('contenido')
<div class="box-header with-border">
<h3 class="box-title">
            </h3>
            <div class="box-tools">
                <div class="text-center">
                    <a class="btn btn-success btn-sm" href="{{ route('ppdf', $payment->id) }}">
                        DESCARGAR PDF
                    </a>
                </div>
            </div>
        </div>
    <div class="box">
        <div class="box-body">
            <div class="col-md-12">

  <body>
  <div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
    
          <div class="col-xs-3">
            <img alt="User Image" src="{{ asset ('AdminLTE/dist/img/loguito1.png') }}"> 
          </div>
          <div class="col-xs-9">
          <small class="pull-right">Fecha de registro: {{ $payment->created_at }}</small>
          <h3>  Agencia de Festejos Francachela C.A.</h3>
          <b> RIF: </b>J-405021420.
            <b> Dirección:</b> Avenida los Llanos Nº 53.
            San juan de los morros, Estado Guárico.<br>
            <b>TLF:</b> 0246-4320357
            <b>Email:</b> festejosfrancachela@gmail.com
          </div>

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
<div class="pull-right">
Estado del pago: 
<strong> 
@if($payment->status == "on_hold")
  No verificado
@else
  Verificado
@endif
</strong>
</div>
      <!-- Table row -->
      <div class="row">
      <center><h3><b>NOTIFICACION DE PAGO</b></h3></center>
        <div class="col-xs-8 col-xs-offset-2 table-responsive">
          <table class="table table-striped">
                          <thead>
                          <tr>
                              <th>FECHA DE PAGO</th>
                              <th>EVENTO</th>
                              <th>TIPO DE PAGO</th>
                              <th>MONTO</th>
                              <th>NUMERO DE REFERENCIA</th>
                          </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td>{{ $payment->date }}</td>
                                  <td>{{ $payment->order->title }}</td>
                                  <td>
                                      @if($payment->type == "bank")
                                          Deposito o transferencia
                                      @else
                                          Efectivo
                                      @endif
                                  </td>
                                  <td>{{ $payment->mount }}</td>
                                  <td>{{ $payment->ref }}</td>
                              </tr>
                          </tbody>
                      </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- ./wrapper -->
  </body>

            </div>
        </div>
    </div>
    <div class="for text-center">
    @if($payment->status == "on_hold")
      <a class="btn btn-primary btn-sm" href="{{ route('payments.index') }}">
        Pasar a pago verificado
      </a>
    @endif
      <a class="btn btn-success btn-sm" href="{{ route('payments.edit', $payment->id) }}">
        Editar
      </a>
      <a class="btn btn-danger btn-sm" href="{{ route('payments.index') }}">
        Volver
      </a>
    </div>
@endsection
