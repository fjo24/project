@extends('layouts.admin')

@section('title', 'Nuevo evento')

@section('contenido')

    <!-- Main content -->
    <section class="content">

        {!! Form::open(['route' => 'orders.store', 'method' => 'POST']) !!}
            @include('admin.orders.partials.fields')
        {!! Form::close() !!}
    </section>
@endsection

@section('js')
    <script type="text/javascript">
        //SERVICES (Lista dinamica)  formgroup2
        (function ($) {
            $(function () {
                var addFormGroup2 = function (event) {
                    event.preventDefault();
                    var $formGroup = $(this).closest('.form-group');
                    var $multipleFormGroup = $formGroup.closest('.multiple-form-group2');
                    var $formGroupClone = $formGroup.clone();
                    $(this)
                            .toggleClass('btn-success btn-add2 btn-danger btn-remove2')
                            .html('–');
                    $formGroupClone.find('input').val('');
                    $formGroupClone.find('.product_id').text('Seleccione');
                    $formGroupClone.insertAfter($formGroup);
                    var $lastFormGroupLast = $multipleFormGroup.find('.form-group:last');
                    if ($multipleFormGroup.data('max') <= countFormGroup($multipleFormGroup)) {
                        $lastFormGroupLast.find('.btn-add2').attr('disabled', true);
                    }
                    //Llamar calculate cuando se agrega servicio
                    calculate();

                };
                var removeFormGroup2 = function (event) {
                    event.preventDefault();
                    var $formGroup = $(this).closest('.form-group');
                    var $multipleFormGroup = $formGroup.closest('.multiple-form-group2');
                    var $lastFormGroupLast = $multipleFormGroup.find('.form-group:last');
                    if ($multipleFormGroup.data('max') >= countFormGroup($multipleFormGroup)) {
                        $lastFormGroupLast.find('.btn-add2').attr('disabled', false);
                    }
                    $formGroup.remove();

                    //Llamar calculate cuando se elimina servicio
                    calculate();
                };
                var selectFormGroup2 = function (event) {
                    event.preventDefault();
                    var $selectGroup = $(this).closest('.input-group-select');
                    var param = $(this).attr("href").replace("#", "");
                    var concept = $(this).text();
                    $selectGroup.find('.concept').text(concept);
                    $selectGroup.find('.input-group-select-val').val(param);
                }
                var countFormGroup = function ($form) {
                    return $form.find('.form-group').length;
                };
                $(document).on('click', '.btn-add2', addFormGroup2);
                $(document).on('click', '.btn-remove2', removeFormGroup2);
                $(document).on('click', '.dropdown-menu a', selectFormGroup2);
            });
        })(jQuery);

        //Fin SERVICES

        //Si cambian el precio hora de la orden, se calculan los numeros nuevamente
        $(document).on('change', '.order_hh', function () {
            calculate()
        });
        //Si cambian el discount de la orden, se calculan los numeros nuevamente
        $(document).on('change', '.discount', function () {
            calculate()
        });
        //Si cambian el alguna hora de algun servicio de la orden, se calculan los numeros nuevamente
        $(document).on('change', '.hh-service', function () {
            calculate()
        });
        //Si cambian el precio de algun producto de la orden, se calculan los numeros nuevamente
        $(document).on('change', '.producto-price', function () {
            calculate()
        });
        //Si cambian la cantidad de algun producto de la orden, se calculan los numeros nuevamente
        $(document).on('change', '.producto-quantity', function () {
            calculate()
        });

        //PRODUCTS (lista dinamica)
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

                    //Llamar calculate y costos cuando se agrega producto

                    calculate();
                    calcular_total_costos();

                    var idproduct = $(this).closest('.multiple-form-group').find('.select-product').val();
                    var quantity = $(this).closest('.multiple-form-group').find('.producto-quantity').val();
                    remove_product_ajax(idproduct, quantity);

                    //fin

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

                     //Llamar calculate y costos cuando se elimina producto
                    calculate();
                    calcular_total_costos();

                    var idproduct = $(this).closest('.multiple-form-group').find('.select-product').val();
                    var quantity = $(this).closest('.multiple-form-group').find('.producto-quantity').val();
                    add_product_ajax(idproduct, quantity);

                    //Fin
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
        //Fin PRODUCTS



        //Colocar precio, costo y stock de los productos en los fields

        $(document).on('change', '.select-product', function () {
            var id = $(this).val();
            var myArray = {!! $prod !!};

            var found = $.map(myArray, function (val) {
                return val.id == id ? val.price : null;
            });

            var quantity = $.map(myArray, function (val) {
                return val.id == id ? val.quantity : null;
            });

            var cost = $.map(myArray, function (val) {
                return val.id == id ? val.cost : null;
            });

            $(this).closest('.multiple-form-group').find('.producto-price').val(cost[0]);
            $(this).closest('.multiple-form-group').find('.producto-stock').val(quantity[0]);
            //$(this).closest('.multiple-form-group').find('.producto-cost').val(cost[0]);

            console.log(found[0]);

        });

        //Fin Colocar precio, costo y stock de los productos en los fields

        //Calcular total de los productos
        function calcular_total_producto() {

            productos_total = 0

            $(".producto-price").each(
                    function (index, value) {
                        if (eval($(this).val() != '')) {
                            productos_total = productos_total + (eval($(this).val()) * eval($(this).closest('.multiple-form-group').find('.producto-quantity').val()));
                        }
                    }
            );

            if (isNaN(productos_total)) {
                productos_total = 0
            }

            return productos_total;
        }

        //Fin  Calcular total de los productos


        //Caluclar total de los servicios
        function calcular_total_servicios() {

            servicios_total = 0

            var hh = eval($(".order_hh").val());
            ;

            var size = $(".hh-service").size();
            console.log('size service =' + size);
            $(".hh-service").each(
                    function (index, value) {
                        if (eval($(this).val() != '')) {
                            servicios_total = servicios_total + (eval($(this).val()) * hh);
                        }
                        //eval($(this).closest('.multiple-form-group2').find('.hh-service').val()
                    });

            if (isNaN(servicios_total)) {
                servicios_total = 0
            }

            return servicios_total;
        }
        //Fin  Caluclar total de los servicios

        //Caluclar total de los costos
        function calcular_total_costos() {
            costos = 0

            $(".producto-cost").each(
                    function (index, value) {
                        if (eval($(this).val() != '')) {
                            costos = costos + (eval($(this).val()) * eval($(this).closest('.multiple-form-group').find('.producto-quantity').val()));
                        }
                    });

            if (isNaN(costos)) {
                costos = 0
            }

            //retornar valor, directo al field
            $(".costo_total").val(costos)
        }
        //Fin  Caluclar total de los costos

        //Inicio calculate, realiza la mayoria de los calculos de la pagina, llamando a las otras funciones
        function calculate() {

            calcular_total_costos();

            var conf_iva = {!! $config->iva !!};

            if ($(".discount").val() > 0) {
                var porc = eval($(".discount").val() / 100);
                var discount = eval((calcular_total_producto() + calcular_total_servicios()) * porc);
                var sum = eval((calcular_total_producto() + calcular_total_servicios()) - discount);
            } else {
                var sum = eval(calcular_total_producto() + calcular_total_servicios());
            }

            var iva = eval(sum * (conf_iva / 100))
            var neto = eval(sum - iva)

            $(".neto").val(neto)
            $(".iva").val(iva)

            $(".total").val(sum)

        }
        //Fin calculate

        //datepicker
                $('.datepicker').datepicker({
                    format: "dd-mm-yyyy",
                    language: "es",
                    autoclose: true
                });
    </script>
@endsection