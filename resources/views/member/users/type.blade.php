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
	            <div class="box-tools">
                <div class="row">
                  <div class="text-center">
                    <div class="col-md-12">
                      <div class="col-md-6">
                        <a href="{{ url('member/newperson') }}" class="thumbnail">
                          <img src="{{asset('AdminLTE/dist/img/natural.jpg')}}" alt="...">
                        </a>
                        <b>Persona natural</b>
                      </div>
                      <div class="col-md-6">
                        <a href="{{ url('member/neworganization') }}" class="thumbnail">
                          <img src="{{asset('AdminLTE/dist/img/organiza.jpg')}}" alt="...">
                        </a>
                        <b>Organización</b>
                      </div>
                    </div>
                  </div>
                </div>
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
