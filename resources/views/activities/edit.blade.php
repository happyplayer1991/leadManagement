@extends('layouts.master')

@section('heading')
    <h1>{{ __('Edit Sample Code') }}</h1>
@stop


@section('content')
    <div class="card">
 {!! Form::model($samples, [
            'method' => 'PATCH',
            'files'=>true,
            'route' => ['samples.update',$samples->id],
            'enctype' => 'multipart/form-data'
            ]) !!}


@include('samples.form', ['submitButtonText' => __('Update sample'),'submitButton' =>__('Cancel')])


{!! Form::close() !!}
    </div>

@stop
