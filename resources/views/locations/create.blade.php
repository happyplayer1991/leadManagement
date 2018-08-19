@extends('layouts.master')
@section('heading')
    <h1>{{ __('Create Location') }}</h1>
@stop
@section('content')
    {!! Form::open([
            'route' => 'locations.store',
            'files'=>true,
            'enctype' => 'multipart/form-data'
            ]) !!}

    
    @include('locations.form', ['submitButtonText' => __('Create location'),'submitButton'=>'Cancel'])
   


    {!! Form::close() !!}

@endsection