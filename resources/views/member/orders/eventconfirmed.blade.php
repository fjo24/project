@extends('layouts.admin')
@if($order->type == "service")
        @section('title', 'Orden de '.$order->user->fullname)
  @elseif($order->type == "remove")
        @section('title', 'Orden de salida de productos de almacen')
    @else
      @section('title', 'Orden de entrada de productos de almacen')
@endif

@section('contenido')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">
                EVENTO CONFIRMADO!
            </h3>
            <div class="box-tools">
                <div class="text-center">
                    <a class="btn btn-success btn-sm" href="{{ route('pdf', $order->id) }}">
                        DESCARGAR
                    </a>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="col-md-12">
                <div class="box box-solid box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            EVENTO CONFIRMADO!
                        </h3>
                    </div>

@if($order->type == "service")
  <body>
  <div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h1 class="page-header">
            <img alt="User Image" src="{{ asset ('AdminLTE/dist/img/francachela.png') }}"> <b>Agencia de Festejos Francachela C.A.</b>
            <small class="pull-right">Fecha de registro: {{ $order->created_at }}</small>
          </h1>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          <address>
            <strong>Agencia de Festejos Francachela C.A.</strong><br>
            <b>RIF: </b>J-405021420.<br>
            <b>Dirección:</b> Avenida los Llanos Nº 53.<br>
            San juan de los morros, Estado Guárico.<br>
            <b>TLF:</b> 0246-4320357<br>
            <b>Email:</b> festejosfrancachela@gmail.com
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
          <b>Orden numero #{{ $order->id }}</b><br>
          <b>Fecha del evento: </b>{{ $order->date }}<br>
          <b>Ubicacion del evento:</b> {{ $order->locale }}<br>
          <b>Estado del evento: </b>@if($order->status == "on_hold")
                                      NO CONFIRMADO
                                  @else
                                      COMFIRMADO
                                  @endif<br>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
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

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead">Metodos de pago:</p>
          <img src="{{ asset ('AdminLTE/dist/img/bancaribe.png') }}" alt="Bancaribe">

          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            Puede pagar en efectivo directamente en nuestra oficina o con un deposito o transferencia: BANCO DEL CARIBE. Cuenta corriente N° 0114-0206-2720-6010-7338. A nombre de Agencia de Festejos Francachela. RIF: J-405021420.
          </p>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">Fecha del evento {{ $order->date }}</p>

          <div class="table-responsive">
            <table class="table">
            <br><br>
              <tr>
                <th><h1>Total:</h1></th>
                <td><h1><b>{{ $order->total }} BsF<b></h1></td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
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
            <a class="btn btn-success btn-sm" href="{{ route('orders.edit', $order->id) }}">
                EDITAR
            </a>
            <a class="btn btn-danger btn-sm" href="{{ route('orders.index') }}">
                VOLVER
            </a>
        </div>
    </div>
@endsection
@elseif($order->type == "remove")
  <body>
  <div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h1 class="page-header">
            <img alt="User Image" src="{{ asset ('AdminLTE/dist/img/francachela.png') }}"> <b>Agencia de Festejos Francachela C.A.</b>
            <small class="pull-right">Fecha de registro: {{ $order->created_at }}</small>
          </h1>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-8 invoice-col">
          <address>
            <strong>Agencia de Festejos Francachela C.A.</strong><br>
            <b> RIF: </b>J-405021420.
            <b> Dirección:</b> Avenida los Llanos Nº 53.
            San juan de los morros, Estado Guárico.<br>
            <b>TLF:</b> 0246-4320357
            <b>Email:</b> festejosfrancachela@gmail.com
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
      <center><h3><b>SALIDA DE MATERIAL</b></h3></center>
        <div class="col-xs-8 col-xs-offset-2 table-responsive">
          <table class="table table-striped">
                          <thead>
                          <tr>
                              <th>ITEM</th>
                              <th>CANTIDAD</th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach($order->products as $product)
                              <tr>
                                  <td>{{ $product->name   }}</td>
                                  <td>{{ $product->pivot->quantity }}</td>
                              </tr>
                          @endforeach
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
            <a class="btn btn-danger btn-sm" href="{{ route('orders.index') }}">
                Volver
            </a>
        </div>
    </div>
@endsection
    @else
<body>
  <div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h1 class="page-header">
            <img alt="User Image" src="{{ asset ('AdminLTE/dist/img/francachela.png') }}"> <b>Agencia de Festejos Francachela C.A.</b>
            <small class="pull-right">Fecha de registro: {{ $order->created_at }}</small>
          </h1>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-8 invoice-col">
          <address>
            <strong>Agencia de Festejos Francachela C.A.</strong><br>
            <b> RIF: </b>J-405021420.
            <b> Dirección:</b> Avenida los Llanos Nº 53.
            San juan de los morros, Estado Guárico.<br>
            <b>TLF:</b> 0246-4320357
            <b>Email:</b> festejosfrancachela@gmail.com
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
      <center><h3><b>ENTRADA DE MATERIAL</b></h3></center>
        <div class="col-xs-8 col-xs-offset-2 table-responsive">
          <table class="table table-striped">
                          <thead>
                          <tr>
                              <th>ITEM</th>
                              <th>CANTIDAD</th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach($order->products as $product)
                              <tr>
                                  <td>{{ $product->name   }}</td>
                                  <td>{{ $product->pivot->quantity }}</td>
                              </tr>
                          @endforeach
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
            <a class="btn btn-danger btn-sm" href="{{ route('orders.index') }}">
                Volver
            </a>
        </div>
    </div>
@endsection
@endif