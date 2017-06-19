@extends('layouts.admin')

@section('title', 'Agencia de Festejos Francachela C.A.')

@section('contenido')
<div class="container">
    <div class="row">
    <div class="col-md-10 col-md-offset-1">
         <!-- /.col -->
<center>
        <div class="col-md-6 col-md-offset-2">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                </ol>
                <div class="carousel-inner">
                  <div class="item active">
                    <img src="{{ asset ('AdminLTE/dist/img/alquiler07.jpg') }}" alt="First slide">

                    <div class="carousel-caption">
                      Manteleria
                    </div>
                  </div>
                  <div class="item">
                    <img src="{{ asset ('AdminLTE/dist/img/alquiler.jpg') }}" alt="First slide">

                    <div class="carousel-caption">
                     Sillas tiffany
                    </div>
                  </div>
                  <div class="item">
                     <img src="{{ asset ('AdminLTE/dist/img/34.jpg') }}" alt="First slide">
                    <div class="carousel-caption">
                      Castillo inflable
                    </div>
                  </div>
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                  <span class="fa fa-angle-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                  <span class="fa fa-angle-right"></span>
                </a>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        </center>
        </div>
    </div>
</div>
@endsection
