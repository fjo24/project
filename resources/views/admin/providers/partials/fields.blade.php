<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="box box-primary">
            <div class="box-header with-border">
                @include('partials.errors')
                <h3 class="box-title">Registro de proveedor</h3>
            </div>
                <!--Contenido-->
                <div class="form-group">
                    {!! Form::label('name', 'Nombre del proveedor') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre de proveedor']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('rif', 'Rif del proveedor') !!}
                    {!! Form::text('rif', null, ['class' => 'form-control', 'placeholder' => 'RIF']) !!}
                </div>
                <div class="form-group">
                        {!! Form::label('telephone', 'Telefono') !!}
                    <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                        {!! Form::text('telephone', null, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('locale', 'Dirección del proveedor') !!}
                    {!! Form::text('locale', null, ['class' => 'form-control', 'placeholder' => 'ingrese dirección fiscal']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('email', 'Correo Electronico') !!}
                    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'example@gmail.com', 'required']) !!}
                </div>
                <div class="for text-center">
                    {!! Form::submit('Registrar', ['class'=> 'btn btn-primary']) !!}
                <a class="btn btn-success" href="{{route('providers.index')}}">
                    ATRAS
                </a>
            </div>
        </div>
    </div>
</div>