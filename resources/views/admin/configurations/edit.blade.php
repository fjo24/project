@extends('layouts.admin')

@section('title', 'Edición de registro')
@include('flash::message') 
@section('contenido')
    {!! Form::model($config, ['route' => ['configuration.update', $config], 'method' => 'PUT']) !!} 
                                
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Edicion de iva</h3>
                                </div>
                                    <div class="col-md-12">
                                        <div class="jumbotron">
                                            <h1>Puede hacer el ajuste del iva actual!</h1>
                                            <p>
                                            <div class="col-md-4 col-md-offset-4">
                                            <div class="form-group">
                                                {!! Form::label('iva', 'IVA') !!}
                                                {!! Form::text('iva', null, ['class' => 'form-control', 'placeholder' => 'Introduzca iva actual']) !!}
                                            </div>

                                            </p>
                                            <center>
                                          {!! Form::submit('EDITAR', ['class'=> 'btn btn-primary btn-lg']) !!}<a class="btn btn-danger btn-lg" href="{{url('/home') }}" role="button">CANCELAR</a>
                                          </center>
                                        </div>
                                    </div>
                            </div>               

    {!! Form::close() !!}
@endsection

@section('js')
    <script type="text/javascript">
    </script>
@endsection