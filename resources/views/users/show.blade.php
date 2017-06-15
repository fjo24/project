@extends('layouts.admin')

@section('title', 'Ver usuario')

@section('contenido')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">
                Detalles del Usuario
            </h3>
            <div class="box-tools">

                <div class="text-center">
                    <a class="btn btn-success btn-sm" href="{{ route('users.index') }}">
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
                            Datos de {{ $user->name }}
                        </h3>
                    </div>
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <td>Nombre:</td>
                            <td>{{ $user->fullname }}</td>
                        </tr>
                        <tr>
                            <td>Tipo de usuario:</td>
                            <td>
                        @if($user->type == "person")
                            Persona Natural
                            @else                          
                                Organizzación
                        @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Nivel de usuario:</td>
                            <td>
                        @if($user->level == "admin")
                            Administrador
                            @else                          
                                Miembro
                        @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Correo electronico:</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td>Usuario desde:</td>
                            <td>{{ $user->created_at }}</td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
            <div class="for text-center">
        <a class="btn btn-success btn-sm" href="{{ route('users.edit', $user->id) }}">
            Editar
        </a>
        <a class="btn btn-danger btn-sm" href="{{ route('users.index') }}">
            Volver
        </a>
    </div>
    </div>

@endsection