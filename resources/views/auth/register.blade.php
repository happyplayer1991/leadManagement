@extends('layouts.app')

@section('content')
    <div class="login-page">
        <div class="row">
            <div class="page-header header-filter" style="background-image: url('../assets/img/bg7.jpg'); background-size: cover; background-position: top center;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                            <div class="card card-signup">
                                <form class="form" method="POST" action="{{ url('/register') }}" id="registerForm" class="registerForm">
                                    {!! csrf_field() !!}
                                    <div class="header header-primary text-center">
                                        <h4 class="card-title">Opal CRM | Leads on Fingers</h4>
                                        <h5 class="card-title">Register</h5>
                                    </div>

                                    <div class="card-content">
                                        <div class="input-group" style="margin-top: -10%">
									        <span class="input-group-addon ">
										        <i class="material-icons">perm_identity</i>
									        </span>

                                            <input type="text" class="form-control" name="name" id="name" placeholder="Name...">
                                        </div>

                                        <div class="input-group" style="margin-top: -10%">
									        <span class="input-group-addon ">
										        <i class="material-icons">domain</i>
									        </span>

                                            <input type="text" class="form-control" name="company_name" id="company_name" placeholder="Company name...">
                                        </div>

                                        <div class="input-group" style="margin-top: -10%">
									        <span class="input-group-addon ">
										        <i class="material-icons">mail</i>
									        </span>

                                            <input type="text" class="form-control" name="email" id="email" placeholder="Email...">
                                        </div>

                                        <div class="input-group" style="margin-top: -10%">
									        <span class="input-group-addon ">
										        <i class="material-icons">local_phone</i>
									        </span>

                                            <input type="text" class="form-control" name="work_number" id="work_number" placeholder="Reachable Phone...">
                                        </div>

                                        <div class="input-group" style="margin-top: -10%">
                                            <span class="input-group-addon">
                                                <i class="material-icons">lock_outline</i>
                                            </span>

                                            <input type="password" placeholder="Password..."   name="password" id="password" class="form-control" />
                                        </div>

                                        <div class="input-group" style="margin-top: -10%">
                                            <span class="input-group-addon">
                                                <i class="material-icons">lock</i>
                                            </span>

                                            <input type="password" placeholder="Confirm Password..."   name="password_confirmation" id="password_confirmation" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="form-group" style="margin-top: 0px !important;">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-wd btn-md">
                                                <i class="fa fa-btn fa-sign-in"></i> Register
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <div class="text-center">
                                    <p class="text-center"> <a href="{{ url('/password/reset') }}" style="color:  #4096ec">Forgot Your Password?</a></p>
                                    <p class="text-center">For any issues contact <a href="mailto:support@kloudportal.com" class="" style="color:  #4096ec">support@kloudportal.com</a></p>
                                    <p class="text-center">For any help contact us <a href="https://kloudportal.com"  class="" target="_blank" style="color:  #4096ec">kloudportal.com</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
