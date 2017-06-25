@extends('layouts.admin')

@section('title', 'Registro de persona natural')
@include('flash::message')
@section('contenido')
    {!! Form::open(['route' => 'users.store', 'class' => 'form', 'method' => 'POST']) !!}         
            @include('partials.errors')
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <!--Contenido-->
                            <div class="col-md-12">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">DATOS DEL USUARIO</h3>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!! Form::label('name', 'Nombre') !!}
                                                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label('lastname', 'Apellido') !!}
                                                    {!! Form::text('lastname', null, ['class' => 'form-control', 'placeholder' => 'Apellido']) !!}
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label('email', 'Correo Electronico') !!}
                                                    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'example@gmail.com', 'required']) !!}
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label('identification', 'Numero de cedula') !!}
                                                    {!! Form::text('identification', null, ['class' => 'form-control', 'placeholder' => 'Ingrese su ID', 'required']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!! Form::label('telephone', 'Telefono') !!}
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                                    {!! Form::text('telephone', null, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label('password', 'Contraseña') !!}
                                                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Ingrese contraseña', 'required']) !!}
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label('password', 'Contraseña') !!}
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirme contraseña" required>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="for text-center">
                                            {!! Form::submit('REGISTRAR', ['class'=> 'btn btn-primary  btn-sm']) !!}
                                            <a class="btn btn-success btn-sm" href="{{route('users.index')}}">
                                                        ATRAS
                                            </a>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    {!! Form::close() !!}
@endsection

@section('js')
    <script type="text/javascript">
        //datepicker
        $('.datepicker').datepicker({
            format: "dd-mm-yyyy",
            language: "es",
            autoclose: true
        });
        //input mask
        $(".inputmask").inputmask("(999) 9999999");
    </script>
@endsection