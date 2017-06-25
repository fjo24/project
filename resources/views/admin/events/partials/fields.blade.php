<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="box box-primary">
            <div class="box-header with-border">
                @include('partials.errors')
                <h3 class="box-title">Registro de tipo de eventos</h3>
            </div>
                <!--Contenido-->
                <div class="form-group">
                    {!! Form::label('name', 'Nombre del evento') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre de evento']) !!}
                </div>
                <div class="for text-center">
                    {!! Form::submit('Registrar', ['class'=> 'btn btn-primary']) !!}
                <a class="btn btn-success" href="{{route('events.index')}}">
                    ATRAS
                </a>
            </div>
        </div>
    </div>
</div>