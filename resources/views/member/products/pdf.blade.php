@extends('layouts.admin')

@section('title', 'Listado de productos y servicios')

@section('contenido')
    <div class="box">
        <div class="box-body">
            <div class="col-md-12">

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
      <center><h3><b>LISTA DE PRECIO AL {{ $date }}</b></h3></center>
        <div class="col-xs-8 col-xs-offset-2 table-responsive">
<table class="table table-hover display table-responsive table-condensed" id="table">
                            <thead>
                            <tr>
                                <th>NOMBRE</th>
                                <th>TIPO DE PRODUCTO</th>
                                <th>PRECIO</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>
                                        {{ $product->name }}
                                    </td>
                                    <td>
                                        @if($product->type == "rent")

                                        Para Alquiler
    
                                        @elseif($product->type == "sale")

                                        Para  Venta

                                        @else

                                        Servicio

                                        @endif
                                    </td>
                                    <td>
                                        {{ $product->cost }}
                                    </td>
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