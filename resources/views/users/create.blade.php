@extends('layouts.admin')

@section('title', 'Registro de usuario')
@include('flash::message')
@section('contenido')
    {!! Form::open(['route' => 'users.store', 'class' => 'form', 'method' => 'POST']) !!}
    @include('users.partials.fields')
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
        {!! Form::submit('Registrar', ['class'=> 'btn btn-primary']) !!}
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
        //CHOSEN
        $('.select-combustions').chosen({
            placeholder_text_multiple:"SELECCIONE TIPO DE COMBUSTION",
            max_selected_options    : 4,
            no_results_text         : "TIPO DE COMBUSTION NO ENCONTRADA"
        });
        $('#form').click(function (e) {
            setTimeout(function () {
                clearChosen()
            }, 200);
        });
        function clearChosen() {
            $('select#chosen').trigger('chosen:updated');
        }
    </script>
@endsection