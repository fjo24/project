@extends('layouts.admin')

@section('title', 'Ver proveedor')

@section('contenido')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">
                Detalles del Proveedor
            </h3>
            <div class="box-tools">

                <div class="text-center">
                    <a class="btn btn-success btn-sm" href="{{ route('providers.index') }}">
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
                            Datos de {{ $provider->title }}
                        </h3>
                    </div>
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <td>Titulo:</td>
                            <td>{{ $provider->name }}</td>
                        </tr>
                        <tr>
                            <td>Contenido:</td>
                            <td>{{ $provider->rif }}</td>
                        </tr>
                        <tr>
                        <tr>
                            <td>Fecha de registro:</td>
                            <td>{{ $provider->created_at }}</td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
            <div class="for text-center">
        <a class="btn btn-success btn-sm" href="{{ route('providers.edit', $provider->id) }}">
            Editar
        </a>
        <a class="btn btn-danger btn-sm" href="{{ route('providers.index') }}">
            Volver
        </a>
    </div>
    </div>

@endsection