@extends('layouts.app')
@section('content')
    <div class="login-page">
        <div class="row">
            <div class="page-header header-filter" style="background-image: url('../assets/img/bg7.jpg'); background-size: cover; background-position: top center;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                            <div class="card card-signup">
                                <form class="form" method="POST" action="{{ url('/login') }}">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="company" id="company" value="{{$company}}">
                                    <div class="header header-primary text-center" @if($settings->logo_color != "") style="background: {{$settings->logo_color}} !important;" @endif>
                                        <h4 class="card-title">Opal CRM | Leads on Finger Tips</h4>
                                        <h5 class="card-title">Log in</h5>
                                        <div class="logo">
                                        @if($settings->logo_img != "")
                                            <a href="#">
                                                <img src="{{asset('images/logo/'.$settings->logo_img)}}" alt="" onerror="javascript:$(this).hide();"
                                                style="width: 200px;height: 40px;object-fit: cover;">
                                            </a>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="card-content">
                                        <div class="input-group {{ $errors->has('email') ? ' has-error' : '' }}">
									        <span class="input-group-addon ">
										        <i class="material-icons">email</i>
									        </span>
                                            <input type="text" class="form-control" name="email" placeholder="Email...">
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                     <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="input-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                            <span class="input-group-addon">
                                                <i class="material-icons">lock_outline</i>
                                            </span>
                                            <input type="password" placeholder="Password..."   name="password" class="form-control" />
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="footer text-center">
                                        <div class="form-group">
                                            <div class="">
                                                <button type="submit" class="btn btn-primary btn-wd btn-lg" @if($settings->logo_color != "") style="background: {{$settings->logo_color}} !important;" @endif>
                                                    <i class="fa fa-btn fa-sign-in" ></i> Login
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <a href="{{ url('/password/reset') }}" class="btn btn-simple" style="color: #00bcd4">Forgot Your Password?</a>
                                <a href="{{ url('/register') }}" class="btn btn-simple" style="color: #00bcd4">Register</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal_window">
</div>
@endsection
