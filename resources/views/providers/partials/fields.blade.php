<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="box">
            <div class="box-header with-border">
                @include('partials.errors')
                <h3 class="box-title">Registro de proveedor</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <!--Contenido-->
                        <div class="col-md-12">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">PROVEEDOR</h3>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!! Form::label('name', 'Nombre del proveedor') !!}
                                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre de proveedor']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('rif', 'Rif del proveedor') !!}
                                        {!! Form::text('rif', null, ['class' => 'form-control', 'placeholder' => 'RIF']) !!}
                                    </div>
                                </div>
                                <div class="for text-center">
                                    {!! Form::submit('Registrar', ['class'=> 'btn btn-primary']) !!}
                                    <a class="btn btn-success btn-sm" href="{{route('providers.index')}}">
                                        ATRAS
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>