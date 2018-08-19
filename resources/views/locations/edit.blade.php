@extends('layouts.master')
@section('heading')
    Update Location ({{$location->name}})
@stop

@section('content')
    {!! Form::model($location, [
            'method' => 'PATCH',
            'route' => ['locations.update', $location->id],
            ]) !!}
    @include('locations.form', ['submitButtonText' => __('Update location'),'submitButton'=>'Cancel'])

    {!! Form::close() !!}

@stop


