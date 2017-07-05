@extends('layouts.admin')

@section('title', 'Seleccione evento a pagar')

@section('contenido')
    <div class="box">
        @include('partials.errors')
        <div class="box-header with-border">
            <h3 class="box-title">
            Seleccione evento a pagar
            </h3>
            <div class="box-tools">
                <div class="btn-group">
                  <a class="btn btn-danger btn-sm" href="{{ route('select-client') }}">
                            NUEVO EVENTO
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
                                <th>ESTADO</th>
                                <th>MONTO</th>
                                <th>FECHA DEL EVENTO</th>
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
                                            {{ $order->total }}
                                        </td>
                                        <td>
                                            {{ $order->date }}
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                                <a href="{{ route('add-pay', [$order]) }}">
                                                    Siguiente
                                                    <i class="glyphicon glyphicon-ok" aria-hidden="true"></i>
                                                </a>
                                            </div>
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