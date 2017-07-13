@extends('layouts.admin')

@section('title', 'Estadisticas de Francachela')

@section('contenido')
    <section class="content-header">
        <h1>
            <small>
            </small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <i class="fa fa-dashboard">
                    </i>
                    Home
                </a>
            </li>
            <li>
                <a href="#">
                    Estadísticas
                </a>
            </li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">

        <div class="box">
            @include('common.success')
            <div class="box-header with-border">
                <h3 class="box-title">
                    <b>Estadisticas de los utimos 7 dias</b>
                </h3>
                <div class="box-tools">
                        {{Form::open(['route' => 'stats.store', 'class'=>'form-inline','method' => 'POST'])}}
                        <div class="form-group">
                            <label>Rango de fechas:</label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input name="date" type="text" class="form-control pull-right" id="reservation">

                            </div>
                            <div class="input-group">
                                {!! Form::submit('Aplicar', ['class'=> 'btn btn-primary']) !!}
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->

                        {{Form::close()}}

                </div>
            </div>
            <div class="box-body">
                <div class="row">


                </div>
                <br>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover display table-responsive table-condensed" id="table">
                            <thead>
                            <tr>
                                <th>CLIENTE</th>
                                <th>TITULO</th>
                                <th>UBICACION</th>
                                <th>ESTADO</th>
                                <th>CONTACTO</th>
                                <th>MONTO</th>
                                <th>FECHA DEL EVENTO</th>
                                <th>ACCIONES</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                    <tr>
                                        <td>
                                            {{ $order->user->fullname }}
                                        </td>
                                        <td>
                                            {{ $order->title }}
                                        </td>
                                        <td>
                                            {{ $order->locale }}
                                        </td>
                                        <td>
                                            @if($order->status == "confirmed")
                                                <span class="label label-primary">
                                                    CONFIRMADO
                                                </span>
                                            @elseif($order->status == "approved")
                                                <span class="label label-success">
                                                    APROBADO - ESPERANDO PAGO
                                                </span>
                                            @elseif($order->status == "Rejected")
                                                <span class="label label-danger">
                                                    RECHAZADA
                                                </span>
                                            @elseif($order->status == "pending")
                                                <span class="label label-danger">
                                                    PENDIENTE
                                                </span>
                                            @else
                                                <span class="label label-default">
                                                    EN ESPERA
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $order->user->telephone }}
                                        </td>
                                        <td>
                                            {{ $order->total }}
                                        </td>
                                        <td>
                                            {{ $order->date }}
                                        </td>
                                        <td>
                                            {!! Form::open(['route' => ['orders.destroy',$order ], 'method' => 'DELETE']) !!}
                                            <div class="form-group">
                                                <a href="{{ route('orders.show', $order->id) }}" title="">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                            <div class="form-group">
                                                <a href="{{ route('orders.edit', $order->id) }}" title="Editar">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-link" title="Eliminar" onclick="return confirm('¿Realmente deseas borrar el evento?')"">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                            @endforeach
                           
                            </tbody>
                        </table>
                        </div>
                        <hr>
                    </div>
                    <div class="col-xs-6 text-center">
                        <p class="text-center">
                            <strong>Ingresos:</strong>
                        </p>
                        <h4 class="text-success bg-success">Numero de eventos confirmados: <b>{{$confirmed}}</b></h4>
                        <h4 class="text-info bg-info">Ingresos ultimos 7 dias: <b>{{$total}} BsF</b></h4>
                        
                    </div>
                    <div class="col-xs-6">
                        <p class="text-center">
                            <strong>Confirmados vs Solo aprobados</strong>
                        </p>
                        <div class="chart">
                            <!-- Sales Chart Canvas -->
                            <canvas id="pieChart" style="height: 180px" ;></canvas>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="box-header with-border">
                    <h3 class="box-title"><span class="text-primary">Ingresos ultimos 7 dias</span>
                    </h3>
                </div>
                <!-- /.box-header -->

                <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <canvas id="salesChart" style="height: 180px" ;></canvas>
                </div>

                <div class="box-header with-border">
                    <h3 class="box-title"><span class="text-primary">Ingresos ultimos meses</span>
                    </h3>
                </div>

                <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <canvas id="barChart" style="height: 180px" ;></canvas>
                </div>

            </div>
            <!-- /.box -->
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <!-- footer-->
        </div>
        <!-- /.box-footer-->

    </section>

@endsection

@section('top')
    <script type="text/javascript" src="{{ asset('AdminLTE/plugins/chartjs/Chart.js') }}"></script>
    <link href="{{ asset ('AdminLTE/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset ('AdminLTE/plugins/datepicker/datepicker3.css') }}" rel="stylesheet" type="text/css">

@endsection

@section('js')

    <script type="text/javascript" src="{{ asset('AdminLTE/plugins/daterangepicker/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('AdminLTE/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('AdminLTE/plugins/datepicker/bootstrap-datepicker.js') }}"></script>

    <script type="text/javascript">

    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#table').DataTable({
                "language": {
                    "url": "{{ asset('AdminLTE/plugins/datatables/esp.lang') }}"
                }
            });
        });
                // -----------------------
        // - MONTHLY SALES CHART -
        // -----------------------

        // Get context with jQuery - using jQuery's .get() method.
        var salesChartCanvas = $('#salesChart').get(0).getContext('2d');
        // This will get the first returned node in the jQuery collection.
        var salesChart = new Chart(salesChartCanvas);

        var salesChartData = {
            labels: [moment().subtract(7, 'days').format('dd'), moment().subtract(6, 'days').format('dd'), moment().subtract(5, 'days').format('dd'), moment().subtract(4, 'days').format('dd'), moment().subtract(3, 'days').format('dd'), moment().subtract(2, 'days').format('dd'), moment().subtract(1, 'days').format('dd')],
            datasets: [

                {
                    label: 'Ingresos',
                    fillColor: 'rgba(60,141,188,0.9)',
                    strokeColor: 'rgba(60,141,188,0.8)',
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: {!! json_encode($days_total_cost) !!}
                }
            ]
        };

        var salesChartOptions = {
            // Boolean - If we should show the scale at all
            showScale: true,
            // Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines: true,
            // String - Colour of the grid lines
            scaleGridLineColor: 'rgba(0,0,0,.05)',
            // Number - Width of the grid lines
            scaleGridLineWidth: 1,
            // Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            // Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines: true,
            // Boolean - Whether the line is curved between points
            bezierCurve: true,
            // Number - Tension of the bezier curve between points
            bezierCurveTension: 0.3,
            // Boolean - Whether to show a dot for each point
            pointDot: true,
            // Number - Radius of each point dot in pixels
            pointDotRadius: 4,
            // Number - Pixel width of point dot stroke
            pointDotStrokeWidth: 1,
            // Number - amount extra to add to the radius to cater for hit detection outside the drawn point
            pointHitDetectionRadius: 20,
            // Boolean - Whether to show a stroke for datasets
            datasetStroke: true,
            // Number - Pixel width of dataset stroke
            datasetStrokeWidth: 2,
            // Boolean - Whether to fill the dataset with a color
            datasetFill: false,
            // String - A legend template
            // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio: true,
            // Boolean - whether to make the chart responsive to window resizing
            responsive: true
        };

        var salesChartDatax = {
            labels: [moment().subtract(7, 'days').format('dd'), moment().subtract(6, 'days').format('dd'), moment().subtract(5, 'days').format('dd'), moment().subtract(4, 'days').format('dd'), moment().subtract(3, 'days').format('dd'), moment().subtract(2, 'days').format('dd'), moment().subtract(1, 'days').format('dd')],
            datasets: [

                {
                    label: 'Ingresos',
                    fillColor: 'rgba(60,141,188,0.9)',
                    strokeColor: 'rgba(60,141,188,0.8)',
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: {!! json_encode($days_total_cost) !!}
                }
            ]
        };


        // Create the line chart
        salesChart.Line(salesChartData, salesChartOptions);
        //-------------
        //- BAR CHART -
        //-------------
        var barChartCanvas = $('#barChart').get(0).getContext('2d')
        var barChart = new Chart(barChartCanvas)
        var barChartData = salesChartDatax

        barChart.Bar(barChartData, salesChartOptions)

//-------------
        //- BAR CHART -
        //-------------

        // -------------
        // - PIE CHART -
        // -------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
        var pieChart = new Chart(pieChartCanvas);
        var PieData = [
            {
                value: {!!  $approved !!},
                color: '#008000',
                highlight: '#008000',
                label: 'Solo aprobados'
            },
            {
                value: {!!  $confirmed !!},
                color: '#0000FF',
                highlight: '#0000FF',
                label: 'Confirmados'
            },
        ];
        var pieOptions = {
            // Boolean - Whether we should show a stroke on each segment
            segmentShowStroke: true,
            // String - The colour of each segment stroke
            segmentStrokeColor: '#fff',
            // Number - The width of each segment stroke
            segmentStrokeWidth: 1,
            // Number - The percentage of the chart that we cut out of the middle
            percentageInnerCutout: 50, // This is 0 for Pie charts
            // Number - Amount of animation steps
            animationSteps: 100,
            // String - Animation easing effect
            animationEasing: 'easeOutBounce',
            // Boolean - Whether we animate the rotation of the Doughnut
            animateRotate: true,
            // Boolean - Whether we animate scaling the Doughnut from the centre
            animateScale: false,
            // Boolean - whether to make the chart responsive to window resizing
            responsive: true,
            // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio: false,
            // String - A legend template
            // String - A tooltip template
        };
        // Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        pieChart.Doughnut(PieData, pieOptions);
        // -----------------
        // - END PIE CHART -
        // -----------------

        //Date range as a button
        //Date range picker
        $('#reservation').daterangepicker(
                {
                    //showDropdowns: true,
//                    ranges: {
//                        'Esta semana': [moment().startOf('week'), moment().endOf('week')],
//                        'Última semana': [moment().subtract(6, 'days'), moment()],
//                        'Últimas 2 semanas': [moment().subtract(13, 'days'), moment()],
//                        'Este mes': [moment().startOf('month'), moment().endOf('month')],
//                        'Mes anterior': [moment().subtract(1, 'month').startOf('month'),
//                            moment().subtract(1, 'month').endOf('month')]
//                    },
                    autoUpdateInput: true,
                    locale: {
                        format: 'DD/MM/YYYY',
                        applyLabel: 'Aplicar',
                        cancelLabel: 'Limpiar',
                        fromLabel: 'Desde',
                        toLabel: 'Hasta',
                        customRangeLabel: 'Seleccionar rango',
                        daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre',
                            'Diciembre'],
                        firstDay: 1
                    }
                }
        )
    </script>

@endsection