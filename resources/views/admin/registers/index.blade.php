@extends('layouts.admin')

@section('title', 'Registros de entrada y salida')

@section('contenido')
    <div class="box">
       
        @include('partials.errors')

        <div class="box-header with-border">
            <h3 class="box-title">
                Lista de registros
            </h3>
            <div class="box-tools">
                <div class="text-center">
                    <a class="btn btn-primary btn-sm" href="{{ route('registers.create') }}">
                        REGISTRAR NUEVA ENTRADA O SALIDA
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
                                <th>FECHA</th>
                                <th>PROVEEDOR</th>
                                <th>DESCRIPCION</th>
                                <th>TIPO DE REGISTRO</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($registers as $register)
                                <tr>
                                    <td>
                                        {{ $register->date }}
                                    </td>
                                    <td>
                                    @if($register->type == "entry")
                                        {{ $register->provider->name }}
                                    @else
                                        N/A
                                    @endif
                                    </td>
                                    <td>
                                        {{ $register->info }}
                                    </td>
                                    <td>
                                    @if($register->type == "entry")
                                    <span class="label label-primary">
                                        Entrada
                                    </span>
                                    @else
                                    <span class="label label-danger">
                                        Salida
                                    </span>
                                    @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('registers.show', $register->id) }}">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('registers.edit', $register->id) }}">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                    <td>
                                        {!! Form::open(['route' => ['registers.destroy', $register->id], 'method' => 'DELETE']) !!}
                                            <button class="glyphicon glyphicon-remove" onclick="return confirm('¿Realmente deseas borrar el registro?')"">
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