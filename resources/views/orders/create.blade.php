@extends('layouts.admin')

@section('title', 'Nuevo evento')

@section('contenido')
    <div class="box">
       
        @include('partials.errors')

        <div class="box-header with-border">
            <h3 class="box-title">
                Lista de eventos
            </h3>
            <div class="box-tools">
                <div class="text-center">
                    <a class="btn btn-primary btn-sm" href="{{ route('orders.create') }}">
                        NUEVO EVENTO
                    </a>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12">
                    

                    <div class="container">
                    {!! Form::open(['route' => 'orders.store']) !!} 
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {!! Form::label('date', 'Fecha de inicio') !!}
                                            {!! Form::text('date', null, ['class' => 'form-control datepicker', 'placeholder' => 'Ingrese fecha']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('end_date', 'Fecha final') !!}
                                            {!! Form::text('end_date', null, ['class' => 'form-control datepicker', 'placeholder' => 'Ingrese fecha si aplica']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('user_id', 'Cliente') !!}
                                            {!! Form::select('user_id', $users, null, ['class' => 'form-control', 'required']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('title', 'Titulo del evento') !!}
                                                {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Ingrese aqui un titulo o descripcion breve del evento']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('status', 'Estado del evento') !!}
                                            {!! Form::select('status', ['' => 'Seleccione estado del evento','on_hold' => 'Por confirmar', 'confirmed' => 'Confirmada', 'Rejected' => 'Rechazada'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione un nivel de usuario']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('locale', 'Ubicacion del evento') !!}
                                            {!! Form::text('locale', null, ['class' => 'form-control', 'placeholder' => 'Ubicacion del evento']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('notes', 'Información adicional') !!}
                                            {!! Form::text('notes', null, ['class' => 'form-control', 'placeholder' => 'Incluya aca cualquier información adicional de interes']) !!}
                                        </div>
                                    </div>

<div class="container">
    <div class="row">
        <h2>Seleccione producto y cantidad</h2>
       
        <div class="col-md-6">
            <div class="contacts">

                    <div class="form-group multiple-form-group input-group">
                        <div class="col-md-6">
                        <div class="input-group-btn input-group-select">
                            <div class="form-group">
                            {!! Form::select('product_id[]', $products, null, ['class' => 'form-control', 'placeholder' => 'Indique producto', 'required']) !!}
                            </div>
                            
                            <input type="hidden" class="input-group-select-val" name="contacts['type'][]" value="phone">
                        </div>
                        </div>
                        <div class="col-md-4">
                         {!! Form::text('quantity[]', null, ['class' => 'form-control', 'placeholder' => 'cantidad', 'required']) !!}
                         </div>
                        <div class="col-md-2">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-success btn-add">+</button>
                        </span>
                        </div>
                    </div>
            </div>
        </div>

    </div>
    </div>
</div>

                                        {!! Form::submit('Registrar', ['class'=> 'btn btn-primary']) !!}
                                        <a class="btn btn-success btn-sm" href="{{route('orders.index')}}">
                                        Cancelar
                                        </a>
                                    </div>
                                    {!! Form::close() !!}
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
(function ($) {
    $(function () {

        var addFormGroup = function (event) {
            event.preventDefault();

            var $formGroup = $(this).closest('.form-group');
            var $multipleFormGroup = $formGroup.closest('.multiple-form-group');
            var $formGroupClone = $formGroup.clone();

            $(this)
                .toggleClass('btn-success btn-add btn-danger btn-remove')
                .html('–');

            $formGroupClone.find('input').val('');
            $formGroupClone.find('.product_id').text('Seleccione');
            $formGroupClone.insertAfter($formGroup);

            var $lastFormGroupLast = $multipleFormGroup.find('.form-group:last');
            if ($multipleFormGroup.data('max') <= countFormGroup($multipleFormGroup)) {
                $lastFormGroupLast.find('.btn-add').attr('disabled', true);
            }
        };

        var removeFormGroup = function (event) {
            event.preventDefault();

            var $formGroup = $(this).closest('.form-group');
            var $multipleFormGroup = $formGroup.closest('.multiple-form-group');

            var $lastFormGroupLast = $multipleFormGroup.find('.form-group:last');
            if ($multipleFormGroup.data('max') >= countFormGroup($multipleFormGroup)) {
                $lastFormGroupLast.find('.btn-add').attr('disabled', false);
            }

            $formGroup.remove();
        };

        var selectFormGroup = function (event) {
            event.preventDefault();

            var $selectGroup = $(this).closest('.input-group-select');
            var param = $(this).attr("href").replace("#","");
            var concept = $(this).text();

            $selectGroup.find('.concept').text(concept);
            $selectGroup.find('.input-group-select-val').val(param);

        }

        var countFormGroup = function ($form) {
            return $form.find('.form-group').length;
        };

        $(document).on('click', '.btn-add', addFormGroup);
        $(document).on('click', '.btn-remove', removeFormGroup);
        $(document).on('click', '.dropdown-menu a', selectFormGroup);

    });
})(jQuery);

 //datepicker
                $('.datepicker').datepicker({
                    format: "dd-mm-yyyy",
                    language: "es",
                    autoclose: true
                });



    </script>
@endsection


