@extends('layouts.admin')

@section('title', 'Ver articulo')

@section('contenido')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">
                Detalles del Articulo
            </h3>
            <div class="box-tools">

                <div class="text-center">
                    <a class="btn btn-success btn-sm" href="{{ route('articles.index') }}">
                        Volver
                    </a>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="col-md-6 col-md-offset-3">
                <div class="box box-solid box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            Datos de {{ $article->title }}
                        </h3>
                    </div>
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <td>Titulo:</td>
                            <td>{{ $article->title }}</td>
                        </tr>
                        <tr>
                            <td>Contenido:</td>
                            <td>{{ $article->content }}</td>
                        </tr>
                        <tr>
                            <td>Creado por:</td>
                            <td>{{ $article->user->name }}  {{ $article->user->last_name }}</td>
                        </tr>
                        <tr>
                            <td>Editado por:</td>
                            <td>{{ $article->updatedby->name }} {{ $article->updatedby->last_name }}</td>
                        </tr>
                        <tr>
                            <td>Fecha de Actualización:</td>
                            <td>{{ $article->updated_at }}</td>
                        </tr>
                        <tr>
                            <td>Fecha de creación:</td>
                            <td>{{ $article->created_at }}</td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="for text-center">
            <a class="btn btn-success btn-sm" href="{{ route('articles.edit', $article->id) }}">
                Editar
            </a>
            <a class="btn btn-danger btn-sm" href="{{ route('articles.index') }}">
                Volver
            </a>
        </div>
    </div>

@endsection