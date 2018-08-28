@extends('layouts.master')

@section('heading')
    {{ __('Edit Profile') }}
@stop

@section('content')
    <div class="card">
        {!! Form::model($user, [
            'method' => 'PATCH',
            'route' => ['users.update', $user->id],
            'files'=>true,
            'enctype' => 'multipart/form-data',
            'id' => 'edit-user'])
         !!}

        @include('users.form', ['submitButtonText' =>  __('Update user'),'submitButton'=>__('Cancel')])
    {!! Form::close() !!}
    </div>

    <div class="card" style="margin-top: 0%;">
        <form method="post" action="/UpdatePassword/{{$user->id}}">
            {{csrf_field()}}
            <div class="form-group">
                <div class="col-md-12 col-sm-12" style="margin-top: 2%;">
                        <div class="col-md-4 col-sm-4">
                        </div>
                        <div class="col-md-4 col-sm-4" style="margin-left:65px;">
                            <font style="color: #4096ec; font-size: 19px; font-weight: bold;">Update Password</font>
                        </div>
                </div>
            </div>

            <div class="form-group">
                <div class="valcreate" style="margin-left:300px;margin-right:220px;margin-top: 4%;" >
                {!! Form::password('password', ['class' => 'form-control' , 'id' => 'password','placeholder'=>'New Password...']) !!}
                </div>
            </div>
   
    
            <div class="form-group">
               <div class="valcreate"  style="margin-left:300px;margin-right:220px"> 
                  {!! Form::password('password_confirmation', ['class' => 'form-control' , 'id' => 'confirm_password','placeholder'=>'Confirm Password...']) !!}
               </div>
            </div> 
     
   
            <div class="form-group" align="center">
                <input type="submit" value="update" class="btn btn-primary">
            </div>
        </form>
    </div>
@stop
