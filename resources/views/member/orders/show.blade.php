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
                    <b>Titulo: {{ $order->title }}</b><br>
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
                <div class="col-xs-12 table-responsive">
                    <h3>Productos o servicios</h3>
                    <table class="table table-striped">
                          <thead>
                          <tr>
                              <th>ITEM</th>
                              <th>PRECIO UNITARIO</th>
                              <th>CANTIDAD</th>
                              <th>TOTALES</th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach($order->products as $product)
                              <tr>
                                  <td>{{ $product->name   }}</td>
                                  <td>{{ $product->cost }}</td>
                                  <td>{{ $product->pivot->quantity }}</td>
                                  <td>{{ $product->pivot->quantity*$product->cost }}</td>
                              </tr>
                          @endforeach
                          </tbody>
                      </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        @endif
<br>
        <div class="row">
            <!-- accepted payments column -->
        <!-- /.col -->
            <div class="col-xs-6">
              <p class="lead">Metodos de pago:</p>
              <img src="{{ asset ('AdminLTE/dist/img/bancaribe.png') }}" alt="Bancaribe">

              <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                Puede pagar en efectivo directamente en nuestra oficina o con un deposito o transferencia: BANCO DEL CARIBE. Cuenta corriente N° 0114-0206-2720-6010-7338. A nombre de Agencia de Festejos Francachela. RIF: J-405021420.
              </p>
            </div>
            <div class="col-xs-6 pull-right">

                <div class="form-group">

                    <div class="table-responsive">
                      <table class="table">
                      <br><br>
                      @if($order->discount != null)
                          <tr>
                            <th>Descuento ({{ $order->discount }}%)</th>
                            <td></td>
                          </tr>
                        @endif
                        <tr>
                          <th>Subtotal:</th>
                          <td>{{ $order->neto }}</td>
                        </tr>
                        <tr>
                          <th>Iva:</th>
                          <td>{{ $order->iva }}</td>
                        </tr>
                        <tr>
                          <th><h3>Total a pagar:</h3></th>
                          <td><h3><b>{{ $order->total }} BsF<b></h3></td>
                        </tr>
                      </table>
                    </div>
                </div>
            </div>
            <!-- /.col -->

        </div>

        <!-- /.row -->
        <div class="row text-center no-print">

        @if($order->status == "pending")
        <div class="jumbotron">
                <h1>Su orden fue recibida!</h1>
                <p>Una vez revisada esta orden, procederemos a aprobarla o rechazarla según nuestra disponibilidad.. Si es aprobada posteriormente usted pueda cargar el pago correspondiente.. Este procedimiento puede tardar maximo 2 dias habiles.. Si olvido algun detalle aun puede editar la orden..</p>
                <p><a class="btn btn-primary btn-lg" href="{{ route('editorder', $order->id) }}" role="button">EDITAR</a><a class="btn btn-danger btn-lg" href="{{ route('indexorder') }}" role="button">VOLVER</a></p>
        </div>
          @elseif($order->status == "not_processed")
<div class="jumbotron">
                <h1>Su orden fue recibida!</h1>
                <p>Una vez revisada esta orden, procederemos a aprobarla o rechazarla según nuestra disponibilidad.. Si es aprobada posteriormente usted pueda cargar el pago correspondiente.. Este procedimiento puede tardar maximo 2 dias habiles.. Si olvido algun detalle aun puede editar la orden..</p>
                <p><a class="btn btn-primary btn-lg" href="{{ route('editorder', $order->id) }}" role="button">EDITAR</a><a class="btn btn-danger btn-lg" href="{{ route('indexorder') }}" role="button">VOLVER</a></p>
        </div>
          @elseif($order->status == "approved")
                <a class="btn btn-success" href="{{ route('createpay', [$order]) }}">
                    REALIZAR PAGO
                </a>
          @endif

        </div>
    </section>
@endsection

@section('js')
    <script type="text/javascript">
        $('.printer').on('click', function () {
            window.print();
        });
    </script>
@endsection