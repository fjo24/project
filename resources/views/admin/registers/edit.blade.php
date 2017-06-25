@extends('layouts.admin')

@section('title', 'Edición de registro')
@include('flash::message') 
@section('contenido')
    {!! Form::model($register, ['route' => ['registers.update', $register], 'method' => 'PUT']) !!} 
                                <div class="col-md-6 col-md-offset-3">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Datos de la entrada o salida</h3>
                                </div>
                                <div class="col-md-12">
                                        <div class="form-group">
                                            {!! Form::label('date', 'Fecha') !!}
                                            {!! Form::text('date', null, ['class' => 'form-control datepicker', 'placeholder' => 'Ingrese fecha']) !!}
                                        </div> 
                                        <div class="form-group">
                                            {!! Form::label('type', 'Tipo') !!}
                                            {!! Form::select('type', ['entry' => 'Entrada de productos al almacen', 'remove' => 'Salida de productos del almacen'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione tipo de registro']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('info', 'Descripción') !!}
                                            {!! Form::text('info', null, ['class' => 'form-control', 'placeholder' => 'Incluya aca cualquier información adicional de interes']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('provider_id', 'Proveedor') !!}
                                            {!! Form::select('provider_id', $providers, null, ['class' => 'form-control', 'placeholder' => 'Seleccione proveedor']) !!}
                                        </div>
                                        <center> 
                                                <div class="col-md-12">
                                                    <div class="col-md-12">    
                                                        <h2>Seleccione producto y cantidad</h2>
                                                    </div>
                                                    <div class="row">
                                                        @foreach ($register->products as $product)
                                    <div class="contacts">
                                    <div class="col-md-12">
                                        <div class="form-group multiple-form-group input-group">
                                                    <div class="col-md-2">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-danger btn-remove">-</button>
                                                    </span>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="input-group-btn input-group-select">
                                                            <div class="form-group">
                                                                {!! Form::select('product_id[]', $products, $product->id, ['class' => 'form-control', 'required']) !!}
                                                            </div>

                                                            <input type="hidden" class="input-group-select-val" name="contacts['type'][]" value="phone">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        {!! Form::text('quantity[]', $product->pivot->quantity, ['class' => 'form-control', 'placeholder' => 'cantidad', 'required']) !!}
                                                    </div>
                                                    <div class="col-md-2">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-success btn-add">+</button>
                                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    @endforeach
                                                    </div>
                                                </div>
                                        </center>
                                    </div>
                                    <div class="for text-center">
                                        {!! Form::submit('REGISTRAR', ['class'=> 'btn btn-primary  btn-sm']) !!}
                                        <a class="btn btn-success btn-sm" href="{{route('orders.index')}}">
                                            CANCELAR
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
    {!! Form::close() !!}
@endsection

@section('js')
    <script type="text/javascript">
        //select for products
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

                $(document).ready(function() {
            $("#type").on("change", function() {
               var valor = $("#type").val();
               if (valor === "service") {
                    $("#provider_id").attr('disabled', true);
                    $("#user_id").attr('disabled', false);
                    $("#status").attr('disabled', false);
                    $("#locale").attr('disabled', false);
               } else if (valor === "entry") {
                    // 
                    $("#provider_id").attr('disabled', false);
                    $("#user_id").attr('disabled', true);
                    $("#status").attr('disabled', true);
                    $("#locale").attr('disabled', true);
               } else if (valor === "remove") {
                    // 
                    $("#provider_id").attr('disabled', true);
                    $("#user_id").attr('disabled', true);
                    $("#status").attr('disabled', true);
                    $("#locale").attr('disabled', true);
               }
            });
         });
    </script>
@endsection