@extends('layouts.master')

@section('heading')
    <h1>{{ __('Edit Source') }}</h1>
@stop

@section('content')


    {!! Form::model($source, [
            'method' => 'PATCH',
            'route' => ['sources.update', $source->id],
            'files'=>true,
            'enctype' => 'multipart/form-data'
            ]) !!}

    @include('sources.form', ['submitButtonText' =>  __('Update Source'),'submitButton' => __('Cancel')])

    {!! Form::close() !!}

@stop

