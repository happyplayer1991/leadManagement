@extends('layouts.master')
@section('heading')
    <h1>{{ __('Create Source') }}</h1>
@stop

@section('content')
    {!! Form::open([
            'route' => 'sources.store',
            'files'=>true,
            'enctype' => 'multipart/form-data'

            ]) !!}
    @include('sources.form', ['submitButtonText' => __('Create Source'),'submitButton' =>__('Cancel')])

    {!! Form::close() !!}


@stop