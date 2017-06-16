@extends('layouts.admin')

@section('title', 'Lista de articulos')

@section('contenido')
    <div class="box">

        @include('partials.errors')

        <div class="box-header with-border">
            <h3 class="box-title">
                Lista de Articulos
            </h3>
            <div class="box-tools">
                <div class="text-center">
                    <a class="btn btn-primary btn-sm" href="{{ route('articles.create') }}">
                        NUEVO ARTICULO
                    </a>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover display table-responsive table-condensed" id="table">
                            <thead>
                            <tr>
                                <th>TITULO</th>
                                <th>CREADO POR</th>
                                <th>EDITADO POR</th>
                                <th>FECHA DE CREACION</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($articles as $article)
                                <tr>
                                    <td>
                                        {{ $article->title }}
                                    </td>
                                    <td>
                                        {{ $article->user->name }}  {{ $article->user->last_name }}
                                    </td>
                                    <td>
                                        {{ $article->updatedby->name }} {{ $article->updatedby->last_name }}
                                    </td>
                                    <td>
                                        {{ $article->created_at }}
                                    </td>
                                    <td>
                                        <a href="{{ route('articles.show', $article->id) }}">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('articles.edit', $article->id) }}">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                    <td>
                                        {!! Form::open(['route' => ['articles.destroy', $article->id], 'method' => 'DELETE']) !!}
                                        <button class="glyphicon glyphicon-remove" onclick="return confirm('¿Realmente deseas borrar el articulo?')"">
                                        </button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-center">
                        </div>
                    </div>
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
        $(document).ready(function () {
            $('#table').DataTable({
                "language": {
                    "url": "{{ asset('AdminLTE/plugins/datatables/esp.lang') }}"
                }
            });
        });
    </script>
@endsection