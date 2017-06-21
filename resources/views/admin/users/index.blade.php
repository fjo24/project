@extends('layouts.admin')

@section('title', 'Lista de usuarios')

@section('contenido')
    <div class="box">
        @include('partials.errors')
        <div class="box-header with-border">
            <h3 class="box-title">
                Lista de usuarios
            </h3>
            <div class="box-tools">
                <div class="text-center">
                    <a class="btn btn-primary btn-sm" href="{{ route('users.create') }}">
                        NUEVO REGISTRO
                    </a>
                    <a class="btn btn-success btn-sm" href="{{route('exportusers')}}">
                        IMPRIMIR REPORTE
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
                                <th>TIPO</th>
                                <th>NUMERO DE DOCUMENTO</th>
                                <th>TELEFONO</th>
                                <th>CORREO ELECTRONICO</th>
                                <th>MIEMBRO DESDE</th>
                                <th>NIVEL DE USUARIO</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        {{ $user->fullname }}
                                    </td>
                                    <td>
                                        @if($user->type == "person")
                                            Persona natural
                                        @else
                                            Organización
                                        @endif
                                    </td>
                                    <td>
                                        {{ $user->identification }}
                                    </td>
                                    <td>
                                        {{ $user->telephone }}
                                    </td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td>
                                        {{ $user->created_at }}
                                    </td>
                                    <td>
                                        @if($user->level == "admin")
                                            <span class="label label-danger">
                                        Admin
                                    </span>
                                        @else
                                            <span class="label label-primary">
                                        Miembro
                                    </span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('users.show', $user->id) }}">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('users.edit', $user->id) }}">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                    <td>
                                        {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'DELETE']) !!}
                                        <button class="glyphicon glyphicon-remove" onclick="return confirm('¿Realmente deseas borrar el usuario?')"">
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