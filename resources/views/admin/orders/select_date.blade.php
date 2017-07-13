@extends('layouts.admin')

@section('title', 'Lista de usuarios')

@section('contenido')
    <div class="box">
        @include('partials.errors')
        <div class="box-header with-border">
            <h3 class="box-title">
                SELECCIONE FECHA
            </h3>
            <div class="box-tools">
                <div class="text-center">

                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box-body table-responsive no-padding">
                    <center>
                        {!! Form::open(['route' => 'add-order', 'method' => 'POST']) !!}
                            <div class="jumbotron">
                              <h1>{{$user->fullname}}</h1>
                              <p>Por favor escoje la fecha del evento</p>
                              <p>
                                <div class="col-md-4 col-md-offset-4">
                                    <div class="form-group">
                                        {!! Form::label('date', 'Fecha') !!}
                                        {!! Form::text('date', null, ['class' => 'form-control datepicker', 'placeholder' => 'Ingrese fecha', 'required']) !!}
                                        {!! Form::hidden('user_id', $user->id, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                              </p>
                              <p>{!! Form::submit('Siguiente', ['class'=> 'btn btn-success  btn-lg']) !!}</p>
                            </div>
                        {!! Form::close() !!}
                        <div class="text-center">
                        </div>
                    </center>
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
        //datepicker
                $('.datepicker').datepicker({
                    format: "dd-mm-yyyy",
                    language: "es",
                    autoclose: true
                });
    </script>
@endsection