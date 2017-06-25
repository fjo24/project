@extends('layouts.admin')

@section('title', 'Edición de usuario')
@include('flash::message')
@section('contenido')
{!! Form::model($user, ['route' => ['users.update', $user], 'method' => 'PUT']) !!}
@include('admin.users.partials.fields')
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