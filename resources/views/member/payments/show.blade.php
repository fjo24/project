@extends('layouts.admin')

@section('title', 'Datos de orden')

@section('contenido')


    <section class="content-header">
        <h1>
            Orden Nr.
            <small>#0{{$order->id }}</small>
            <div class="box-tools">
                <div class="text-right">
                    <button type="button" class="btn btn-success printer" id="print">DESCARGAR
                        <i class="glyphicon glyphicon-print"></i>
                    </button>
                </div>
            </div>
 
        </h1>
    </section>

    <!-- Main content -->
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h1 class="page-header">
                  <center>
                    <img alt="User Image" src="{{ asset ('AdminLTE/dist/img/f.png') }}">
                  </center>
                </h1>
            </div>
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                <address>
                    <b>Agencia de Festejos Francachela</b><br>
                    <b>RIF: </b>J-405021420.<br>
                    <b>Dirección:</b>Av. los Llanos N° 53.<br>
                    San juan de los morros, Estado Guárico. 0246-4320357. festejosfrancachela@gmail.com
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <address>
                  <strong>Datos del cliente</strong><br>
                  <b>Cliente:</b> {{ $order->user->fullname }}<br>
                  <b>Numero de cedula o rif:</b> {{ $order->user->identification }}<br>
                  <b>TLF:</b> {{ $order->user->telephone }}<br>
                  <b>Email:</b> {{ $order->user->email }}<br>
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <address>
                    <b>Orden numero #0{{ $order->id }}</b><br>
                    <b>Titulo: {{ $order->id }}</b><br>
                    <b>Fecha del evento: </b>{{ $order->date }}<br>
                    <b>Ubicacion del evento:</b> {{ $order->locale }}<br>
                    <b>Estado del evento: </b>
                    @if($order->status == "confirmed")
                      CONFIRMADO
                    @elseif($order->status == "Rejected")
                      RECHAZADA
                    @elseif($order->status == "approved")
                      APROBADO - ESPERANDO PAGO
                    @elseif($order->status == "pending")
                      PENDIENTE
                    @else
                      PENDIENTE
                    @endif
                    <br>
                </address>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    @if(count($order->products)>0)
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
        @endif
<br><br><br>


        <!-- /.row -->
        <div class="row text-center no-print">
            @if($order->status == "confirmed")
            <div class="for text-center">
                <a class="btn btn-danger" href="{{ route('indexpay') }}">
                    CANCELAR
                </a>
            </div>
        @else
            <div class="for text-center">
                <a class="btn btn-danger" href="{{ route('indexpay') }}">
                    VOLVER
                </a>
            </div>
        @endif
        </div>

        <br>


    </section>
@endsection

@section('js')
    <script type="text/javascript">
        $('.printer').on('click', function () {
            window.print();
        });
    </script>
@endsection