@extends('layouts.admin')

@section('title', 'Lista de eventos')

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
                        {!! Form::open(['route' => 'storepivot', $order]) !!}
                        <div class="row clearfix">
                            <div class="col-md-12 column">
                                <table class="table table-bordered table-hover" id="tab_logic">
                                    <thead>
                                    <tr >
                                        <th class="text-center">
                                            #
                                        </th>
                                        <th class="text-center">
                                            tipo de producto
                                        </th>
                                        <th class="text-center">
                                            cantidad
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr id='addr0'>
                                        <td>
                                            1
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                {!! Form::select('product_id', $product, null, ['class' => 'form-control', 'required']) !!}
                                            </div>
                                        </td>
                                        <td>
                                            {!! Form::text('quantity', null, ['class' => 'form-control', 'placeholder' => 'cantidad', 'required']) !!}
                                        </td>
                                    </tr>
                                    <tr id='addr1'></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <a id="add_row" class="btn btn-default pull-left">Agregar item</a><a id='delete_row' class="pull-right btn btn-default">Borrar item</a>
                    </div>
                    <div class="for text-center">
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
        $(document).ready(function(){
            var i=1;
            $("#add_row").click(function(){
                $('#addr'+i).html("<td>"+ (i+1) +"</td><td><input name='name"+i+"' type='text' placeholder='Name' class='form-control input-md'  /> </td><td><input  name='mail"+i+"' type='text' placeholder='Mail'  class='form-control input-md'></td><td><input  name='mobile"+i+"' type='text' placeholder='Mobile'  class='form-control input-md'></td>");

                $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
                i++;
            });
            $("#delete_row").click(function(){
                if(i>1){
                    $("#addr"+(i-1)).html('');
                    i--;
                }
            });
        });
    </script>
@endsection


