@extends('layouts.admin')

@section('title', 'Nuevo producto')
@include('flash::message')
@section('contenido')
    {!! Form::open(['route' => 'products.store']) !!}
    @include('admin.products.partials.fields')
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
        $(document).ready(function() {
            $("#type").on("change", function() {
               var valor = $("#type").val();
               if (valor === "service") {
                    $("#quantity").attr('disabled', true);
                    $("#available").attr('disabled', true);
               } else if (valor === "rent") {
                    // 
                    $("#quantity").attr('disabled', false);
                    $("#available").attr('disabled', false);
               } else if (valor === "sale") {
                    // 
                    $("#quantity").attr('disabled', false);
                    $("#available").attr('disabled', false);
               }
            });
         });
    </script>
@endsection