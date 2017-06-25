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
	                <div class="text-center">
	                    <a class="btn btn-primary btn-sm" href="{{ url('member/users/newperson') }}">
	                        PERSONA NATURAL
	                    </a>
	                    <a class="btn btn-primary btn-sm" href="{{ url('member/users/neworganization') }}">
	                        ORGANIZACION
	                    </a>
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
