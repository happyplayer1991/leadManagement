@extends('layouts.app')

        <!-- Main Content -->
@section('content')
    <div class="login-page">
        <div class="row">

            <div class="page-header header-filter" style="background-image: url('../assets/img/bg7.jpg'); background-size: cover; background-position: top center;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                            <div class="card card-signup">
                                <form class="form" method="POST" action="{{ url('/password/email') }}">
                                    {!! csrf_field() !!}
                                    <div class="header header-primary text-center">
                                        <h4 class="card-title">Opal CRM | Leads on Fingers</h4>
                                        <h5 class="card-title">Reset Password</h5>
                                    </div>
                                    <div class="card-content">
                                        @if (session('status'))
                                            <div class="alert alert-success">
                                                {{ session('status') }}
                                            </div>
                                        @endif
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


                                    </div>
                                    <div class="footer text-center">
                                        <div class="form-group">
                                            <div class="">
                                                <button type="submit" class="btn btn-primary btn-wd btn-lg">
                                                    <i class="fa fa-btn fa-envelope"> </i> Send Password Reset Link
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
