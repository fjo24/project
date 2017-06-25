@extends('layouts.admin')

@section('title', 'Nuevo proveedor')
@include('flash::message')
@section('contenido')
    {!! Form::open(['route' => 'providers.store']) !!}
    @include('admin.providers.partials.fields')
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