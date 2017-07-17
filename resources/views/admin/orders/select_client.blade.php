@extends('layouts.admin')

@section('title', 'Lista de usuarios')

@section('contenido')
    <div class="box">
        @include('partials.errors')
        <div class="box-header with-border">
            <h3 class="box-title">
                FECHA {{$order->date}} | SELECCIONE CLIENTE
            </h3>
            <div class="box-tools">
                <div class="text-center">

                    <!-- Single button -->
                    <div class="btn-group">
                      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        NUEVO REGISTRO <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu">
                        <li><a href="{{ url('member/newperson') }}">PERSONA</a></li>
                        <li><a href="{{ url('member/neworganization') }}">ORGANIZACIÓN</a></li>
                      </ul>
                    </div>
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
                                    <td class="text-center">
                                        <div class="form-group">
                                            <a href="{{ route('add-order', [$user, $order]) }}">
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
    @include('admin.orders.modal.client-modal');
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