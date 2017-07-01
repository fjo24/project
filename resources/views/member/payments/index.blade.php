@extends('layouts.admin')

@section('title', 'Listado de pagos')

@section('contenido')
    <div class="box">
        @include('partials.errors')
        <div class="box-header with-border">
            <h3 class="box-title">
                Lista de pagos
            </h3>
            <div class="box-tools">
                <div class="text-center">
                    <a class="btn btn-primary btn-sm" href="{{ route('createpay') }}">
                        NUEVO PAGO
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
                                <th>EVENTO</th>
                                <th>FORMA DE PAGO</th>
                                <th>MONTO</th>
                                <th>NUMERO DE REFERENCIA</th>
                                <th>ESTADO DEL PAGO</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($payments as $payment)
                                <tr>
                                    <td>
                                        {{ $payment->date }}
                                    </td>
                                    <td>
                                        {{ $payment->order->title }}
                                    </td>
                                    <td>
                                        @if($payment->type == "bank")
                                            Deposito o transferencia
                                        @else
                                            Efectivo
                                        @endif
                                    </td>
                                    <td>
                                        {{ $payment->mount }}
                                    </td>
                                    <td>
                                        {{ $payment->ref }}
                                    </td>
                                    <td>
                                        @if($payment->status == "on_hold")
                                            <span class="label label-danger">
                                        NO VERIFICADO
                                            </span>
                                        @else
                                            <span class="label label-primary">
                                        VERIFICADO
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('showpay', $payment->id) }}">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
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