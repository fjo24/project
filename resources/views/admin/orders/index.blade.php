@extends('layouts.admin')

@section('title', 'Lista de eventos')

@section('contenido')
    <div class="box">
        @include('partials.errors')
        <div class="box-header with-border">
            <h3 class="box-title">
                Lista de eventos
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
                                <th>ACCIONES</th>
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
                                                <span class="label label-success">
                                                    SI
                                                </span>
                                            @elseif($order->availability == "n")
                                                <span class="label label-danger">
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
                                                <span class="label label-primary">
                                                    CONFIRMADO
                                                </span>
                                            @elseif($order->status == "approved")
                                                <span class="label label-success">
                                                    APROBADO - ESPERANDO PAGO
                                                </span>
                                            @elseif($order->status == "Rejected")
                                                <span class="label label-danger">
                                                    RECHAZADA
                                                </span>
                                            @elseif($order->status == "pending")
                                                <span class="label label-danger">
                                                    PENDIENTE
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
                                            {!! Form::open(['route' => ['orders.destroy',$order ], 'method' => 'DELETE']) !!}
                                            <div class="form-group">
                                                <a href="{{ route('orders.show', $order->id) }}" title="">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                            <div class="form-group">
                                                <a href="{{ route('orders.edit', $order->id) }}" title="Editar">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-link" title="Eliminar" onclick="return confirm('¿Realmente deseas borrar el evento?')"">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                            @endforeach
                            @foreach($events as $event)
                                    <tr>
                                        <td>
                                            {{ $event->user->fullname }}
                                        </td>
                                        <td>
                                            {{ $event->title }}
                                        </td>
                                        <td>
                                            {{ $event->locale }}
                                        </td>
                                        <td>
                                            @if($event->availability == "y")
                                                <span class="label label-success">
                                                    SI
                                                </span>
                                            @elseif($event->availability == "n")
                                                <span class="label label-danger">
                                                    NO
                                                </span>
                                            @else
                                                <span class="label label-danger">
                                                    CONFLICTO
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($event->status == "confirmed")
                                                <span class="label label-primary">
                                                    CONFIRMADO
                                                </span>
                                            @elseif($event->status == "approved")
                                                <span class="label label-success">
                                                    APROBADO - ESPERANDO PAGO
                                                </span>
                                            @elseif($event->status == "Rejected")
                                                <span class="label label-danger">
                                                    RECHAZADA
                                                </span>
                                            @elseif($event->status == "pending")
                                                <span class="label label-danger">
                                                    PENDIENTE
                                                </span>
                                            @else
                                                <span class="label label-default">
                                                    EN ESPERA
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $event->user->telephone }}
                                        </td>
                                        <td>
                                            {{ $event->total }}
                                        </td>
                                        <td>
                                            {{ $event->date }}
                                        </td>
                                        <td>
                                            {!! Form::open(['route' => ['orders.destroy',$event ], 'method' => 'DELETE']) !!}
                                            <div class="form-group">
                                                <a href="{{ route('orders.show', $event->id) }}" title="">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                            <div class="form-group">
                                                <a href="{{ route('orders.edit', $event->id) }}" title="Editar">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-link" title="Eliminar" onclick="return confirm('¿Realmente deseas borrar el evento?')"">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </button>
                                            </div>
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


