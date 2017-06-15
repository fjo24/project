@extends('layouts.admin')

@section('title', 'Ver producto')

@section('contenido')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">
                Detalles del Producto
            </h3>
            <div class="box-tools">

                <div class="text-center">
                    <a class="btn btn-success btn-sm" href="{{ route('orders.index') }}">
                        Volver
                    </a>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="col-md-6 col-md-offset-3">
                <div class="box box-solid box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            Datos de orden para cliente: 
                        </h3>
                    </div>
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
                        <td>{{   $product->name   }}</td>
                        <td>{{ $product->cost_c }}</td>
                        <td>{{ $product->pivot->quantity }}</td>
                        <td>{{ $product->pivot->quantity*$product->cost }}</td>
                    </tr>
                        @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td><B>TOTALES<B></td>
                        <td><B>{{ $sales[0]->total_sales }}<B></td>
                    </tr>
                </tbody>
                    </table>

                </div>
            </div>
        </div>
            <div class="for text-center">
        <a class="btn btn-success btn-sm" href="{{ route('orders.edit', $order->id) }}">
            Editar
        </a>
        <a class="btn btn-danger btn-sm" href="{{ route('orders.index') }}">
            Volver
        </a>
    </div>
    </div>

@endsection