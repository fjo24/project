@extends('layouts.admin')
@if($register->type == "entry")
      @section('title', 'Registro de entrada de productos de almacen')
@else
      @section('title', 'Registro de salida de productos de almacen')
@endif

@section('contenido')
    <div class="box">
        <div class="box-header with-border">
            
            <div class="box-tools">
                <div class="text-center">
                    <a class="btn btn-success btn-sm" href="{{ route('rpdf', $register->id) }}">
                        DESCARGAR PDF
                    </a>
                </div>
            </div>
            <BR>
        </div>
        <div class="box-body">
            <div class="col-md-12">
                <div class="box box-solid box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            Datos de registro:
                        </h3>
                    </div>

@if($register->type == "remove")
  <body>
  <div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h1 class="page-header">
            <img alt="User Image" src="{{ asset ('AdminLTE/dist/img/francachela.png') }}"> <b>Agencia de Festejos Francachela C.A.</b>
            <small class="pull-right">Fecha de registro: {{ $register->date }}</small>
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
                          @foreach($register->products as $product)
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
            <a class="btn btn-danger" href="{{ route('registers.index') }}">
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
            <small class="pull-right">Fecha de registro: {{ $register->date }}</small>
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
                          @foreach($register->products as $product)
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
            <a class="btn btn-danger" href="{{ route('registers.index') }}">
                Volver
            </a>
        </div>
    </div>
@endsection
@endif