@extends('layouts.admin')

@section('title', 'Nuevo entrada o salida')

@section('contenido')

        @include('partials.errors')
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12">
                    <div class="container">
                        {!! Form::open(['route' => 'registers.store']) !!}
                            @include('admin.registers.partials.fields')
                        {!! Form::close() !!}
                        <!-- /.box-body -->
                    </div>
                </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <!-- footer-->
        </div>
        <!-- /.box-footer-->

    <!-- /.box -->
            </div>
        </div>
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