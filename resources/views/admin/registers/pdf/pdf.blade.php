@extends('layouts.admin')
@if($register->type == "entry")
      @section('title', 'Registro de entrada de productos de almacen')
@else
      @section('title', 'Registro de salida de productos de almacen')
@endif

@section('contenido')
    <div class="box">
        <div class="box-body">
            <div class="col-md-12">

@if($register->type == "remove")
  <body onload="window.print();">
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
          <small class="pull-right">Fecha de registro: {{ $register->date }}</small>
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
@endsection
@else  
<body onload="window.print();">
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
          <small class="pull-right">Fecha de registro: {{ $register->date }}</small>
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
@endsection
@endif