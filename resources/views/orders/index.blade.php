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
                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Action <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a href="{{ route('orders.create') }}">NUEVO EVENTO</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                  </ul>
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
                                <th>TIPO</th>
                                <th>FECHA</th>
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
                                        {{ $order->status }}
                                    </td>
                                    <td>
                                        @if($order->type == "service")
                                            Servicio
                                        @elseif($order->type == "entry")
                                            Entrada
                                        @else
                                            Salida
                                        @endif
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


