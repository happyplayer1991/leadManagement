@extends('layouts.app')

@section('content')
    <div class="login-page">
        <div class="row">

            <div class="page-header header-filter" style="background-image: url('../assets/img/bg7.jpg'); background-size: cover; background-position: top center;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                            <div class="card card-signup">
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form class="form" method="POST" action="{{ url('/password/reset') }}">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <div class="header header-primary text-center">
                                        <h4 class="card-title">Opal CRM | Leads on Fingers</h4>
                                        <h5 class="card-title">Reset Password</h5>
                                    </div>
                                    <div class="card-content">

                                        <div class="input-group {{ $errors->has('email') ? ' has-error' : '' }}">
									        <span class="input-group-addon ">
										        <i class="material-icons">email</i>
									        </span>
                                            <input type="text" class="form-control" name="email" value="{{ $email or old('email') }}" placeholder="Email...">
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                     <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">lock_outline</i>
                                            </span>
                                            <input type="password" placeholder="Password..."   name="password" id="password" class="form-control" />
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">lock</i>
                                            </span>
                                            <input type="password" placeholder="Confirm Password..."   name="password_confirmation" id="password_confirmation" class="form-control" />
                                            @if ($errors->has('password_confirmation'))
                                                <span class="help-block">
                                                     <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                </span>
                                            @endif
                                        </div>


                                    </div>
                                    <div class="footer text-center">
                                        <div class="form-group">
                                            <div class="">
                                                <button type="submit" class="btn btn-primary btn-wd btn-lg">
                                                    <i class="fa fa-btn fa-refresh"> </i> Reset Password
                                                </button>
                                            </div>
                                        </div>


                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection
