@extends('orders.partials.panel')

@section('title', 'Calendario de eventos')

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
                <div class="col-md-10 col-md-offset-1">
                <div class="box box-solid box-primary">
    {!! $calendar->calendar() !!}
    {!! $calendar->script() !!}
                  
                    <!-- /.box-body -->
                </div>
            </div>
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
        $(document).ready(function () {
            $('#table').DataTable({
                "language": {
                    "url": "{{ asset('AdminLTE/plugins/datatables/esp.lang') }}"
                }
            });
        });

        $('#calendar').fullCalendar({
    events: [
        // my event data
    ],
    eventColor: '#000000'
});
    </script>
@endsection



    
