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
                    <a class="btn btn-success btn-sm" href="{{ route('products.index') }}">
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
                            Datos de {{ $product->name }}
                        </h3>
                    </div>
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <td>Nombre:</td>
                            <td>{{ $product->name }}</td>
                        </tr>
                        <tr>
                            <td>Descripción:</td>
                            <td>{{ $product->info }}</td>
                        </tr>
                        <tr>
                            <td>Valor comercial:</td>
                            <td>{{ $product->cost }}</td>
                        </tr>
                        <tr>
                            <td>Cantidad en almacen:</td>
                            <td>{{$product->quantity}}</td>
                        </tr>
                        <tr>
                            <td>Cantidad disponible en almacen:</td>
                            <td>{{$product->available}}</td>
                        </tr>
                        <tr>
                            <td>Tipo de producto:</td>
                            <td>
                        @if($product->type == "rent")
                            Para alquiler
                            @else                          
                            Para venta
                        @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
            <div class="for text-center">
        <a class="btn btn-success btn-sm" href="{{ route('products.edit', $product->id) }}">
            Editar
        </a>
        <a class="btn btn-danger btn-sm" href="{{ route('products.index') }}">
            Volver
        </a>
    </div>
    </div>

@endsection