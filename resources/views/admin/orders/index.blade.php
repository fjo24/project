@extends('layouts.admin')

@section('title', 'Lista de eventos')

@section('contenido')
    <div class="box">
        @include('partials.errors')
        <div class="box-header with-border">
            <h3 class="box-title">
                Lista de entradas y salidas
            </h3>
            <div class="box-tools">
                <div class="btn-group">
                  <a class="btn btn-danger btn-sm" href="{{ route('select-client') }}">
                            NUEVO REGISTRO
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
                                <th>CLIENTE</th>
                                <th>TITULO</th>
                                <th>UBICACION</th>
                                <th>DISPONIBILIDAD</th>
                                <th>ESTADO</th>
                                <th>CONTACTO</th>
                                <th>MONTO</th>
                                <th>FECHA DEL EVENTO</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                    <tr>
                                        <td>
                                            {{ $order->user->fullname }}
                                        </td>
                                        <td>
                                            {{ $order->title }}
                                        </td>
                                        <td>
                                            {{ $order->locale }}
                                        </td>
                                        <td>
                                            @if($order->availability == "y")
                                                <span class="label label-primary">
                                                    SI
                                                </span>
                                            @elseif($order->availability == "n")
                                                <span class="label label-warning">
                                                    NO
                                                </span>
                                            @else
                                                <span class="label label-danger">
                                                    CONFLICTO
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($order->status == "confirmed")
                                                <span class="label label-success">
                                                    CONFIRMADO
                                                </span>
                                            @elseif($order->status == "payment_received")
                                                <span class="label label-warning">
                                                    PAGO RECIBIDO
                                                </span>
                                            @elseif($order->status == "Rejected")
                                                <span class="label label-danger">
                                                    ORDEN RECHAZADA
                                                </span>
                                            @elseif($order->status == "payment_verified")
                                                <span class="label label-primary">
                                                    PAGO VERIFICADO
                                                </span>
                                            @else
                                                <span class="label label-default">
                                                    EN ESPERA
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $order->user->telephone }}
                                        </td>
                                        <td>
                                            {{ $order->total }}
                                        </td>
                                        <td>
                                            {{ $order->date }}
                                        </td>
                                        <td>
                                            <a href="{{ route('orders.show', $order->id) }}">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('orders.edit', $order->id) }}">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        <td>
                                            {!! Form::open(['route' => ['orders.destroy', $order->id], 'method' => 'DELETE']) !!}
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


