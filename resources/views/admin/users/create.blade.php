@extends('layouts.admin')

@section('title', 'Registro de usuario')
@include('flash::message')
@section('contenido')
    {!! Form::open(['route' => 'users.store', 'class' => 'form', 'method' => 'POST']) !!}
    @include('admin.users.partials.fields')
    <div class="form-group">
        {!! Form::label('password', 'Contraseña') !!}
        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Ingrese contraseña', 'required']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('password', 'Contraseña') !!}
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirme contraseña" required>
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

        $(document).ready(function() {
            $("#type").on("change", function() {
               var valor = $("#type").val();
               if (valor === "person") {
                    $("#name").attr('disabled', false);
                    $("#lastname").attr('disabled', false);
                    $("#fullname").attr('disabled', true);
               } else if (valor === "organization") {
                    // 
                    $("#name").attr('disabled', true);
                    $("#lastname").attr('disabled', true);
                    $("#fullname").attr('disabled', false);
               }
            });
         });
    </script>
@endsection