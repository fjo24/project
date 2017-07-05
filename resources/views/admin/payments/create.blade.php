@extends('layouts.admin')

@section('title', 'Registrar pago')
@include('flash::message')
@section('contenido')
@if($order->status=='approved')
    {!! Form::open(['route' => 'payments.store']) !!}
    @include('admin.payments.partials.fields')
    {!! Form::close() !!}
@else
<h1>LA ORDEN DEBE SER PREVIAMENTE APROBADA PARA PROCEDER A REALIZAR EL PAGO</h1>
@endif
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