@extends('layouts.master')
@section('heading')
Create User
@stop

@section('content')
        <div class="card">
    {!! Form::open([
            'route' => 'users.store',
            'files'=>true,
            'enctype' => 'multipart/form-data',
            'id'=>'frm'
            ]) !!}
    @include('users.form1', ['submitButtonText' => __('Create user'),'submitButton'=>__('Cancel')])

    {!! Form::close() !!}
        </div>
@stop

<!--<script>
    var toast = new iqwerty.toast.Toast();
    toast
        .setText('id is required!')
        .setDuration(5000)
            .stylize({
            background: 'pink',
            color: 'black',
            'box-shadow': '0 0 50px rgba(0, 0, 0, .7)'

    })
        .show();

</script> -->
