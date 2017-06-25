@extends('layouts.admin')

@section('title', 'Nuevo tipo de evento')
@include('flash::message')
@section('contenido')
    {!! Form::open(['route' => 'events.store']) !!}
    @include('admin.events.partials.fields')
    {!! Form::close() !!}
@endsection
@section('js')
@endsection