@extends('layouts.admin')

@section('title', 'Lista de productos')

@section('contenido')
    <div class="box">
        @include('partials.errors')
        <div class="box-header with-border">
            <h3 class="box-title">
                Lista de productos
            </h3>
            <div class="box-tools">
                <div class="text-center">
                    <a class="btn btn-primary btn-sm" href="{{ route('products.create') }}">
                        NUEVO PRODUCTO
                    </a>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover display table-responsive table-condensed" id="table">
                            <thead>
                            <tr>
                                <th>NOMBRE</th>
                                <th>VALOR DEL PRODUCTO</th>
                                <th>CANTIDAD TOTAL</th>
                                <th>DISPONIBLE EN ALMACEN</th>
                                <th>TIPO DE PRODUCTO</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>
                                        {{ $product->name }}
                                    </td>
                                    <td>
                                        {{ $product->cost }}
                                    </td>
                                    <td>
                                        @if($product->quantity == null)
                                            N/A
                                        @else
                                            {{ $product->quantity }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($product->available == null)
                                            N/A
                                        @else
                                            {{ $product->available }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($product->type == "rent")
                                            <span class="label label-success">
                                        Para Alquiler
                                    </span>
                                        @elseif($product->type == "sale")
                                            <span class="label label-primary">
                                        Para  Venta
                                    </span>
                                        @else
                                        <span class="label label-warning">
                                        Servicio
                                        @endif
                                    </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('products.show', $product->id) }}">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('products.edit', $product->id) }}">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                    <td>
                                        {!! Form::open(['route' => ['products.destroy', $product->id], 'method' => 'DELETE']) !!}
                                        <button class="glyphicon glyphicon-remove" onclick="return confirm('¿Realmente deseas borrar el producto?')"">
                                        </button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-center">
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <!-- footer-->
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#table').DataTable({
                "language": {
                    "url": "{{ asset('AdminLTE/plugins/datatables/esp.lang') }}"
                }
            });
        });
    </script>
@endsection