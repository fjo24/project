@extends('layouts.admin')

@section('title', 'Ver registro')

@section('contenido')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">
                Detalles del Registro
            </h3>
            <div class="box-tools">

                <div class="text-center">
                    <a class="btn btn-success btn-sm" href="{{ route('registers.index') }}">
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
                            Datos del registro
                        </h3>
                    </div>
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <td>Proveedor:</td>
                            <td>{{ $register->provider->name }}</td>
                        </tr>
                        <tr>
                            <td>Producto:</td>
                            <td>{{ $register->product->name }}</td>
                        </tr>
                        <tr>
                            <td>Tipo de registro:</td>
                            <td>
                                @if($register->type == "entry")
                                        Entrada
                                @else
                                        Salida
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Fecha:</td>
                            <td>{{ $register->created_at }}</td>
                        </tr>
                        <tr>
                            <td>Descripción:</td>
                            <td>{{ $register->info }}</td>
                        </tr>
                        <tr>
                            <td>Cantidad:</td>
                            <td>{{ $register->quantity }}</td>
                        </tr>
                        <tr>
                            <td>Monto:</td>
                            <td>{{ $register->cost }}</td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
            <div class="for text-center">
        <a class="btn btn-success btn-sm" href="{{ route('registers.edit', $register->id) }}">
            Editar
        </a>
        <a class="btn btn-danger btn-sm" href="{{ route('registers.index') }}">
            Volver
        </a>
    </div>
    </div>

@endsection