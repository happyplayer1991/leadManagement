@extends('layouts.app')
@section('content')
    <div class="login-page">
        <div class="row">
            <div class="page-header header-filter" style="background-image: url('../assets/img/bg7.jpg'); background-size: cover; background-position: top center;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                            <div class="card card-signup">
                                <form class="form" action="{{route('leads.store')}}" method="post">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="company_id" value="{{$company_id}}">
                                    <div class="header header-primary text-center" @if($logo_color != "") style="background: {{$logo_color}} !important;" @endif>
                                        <h4 class="card-title">Opal CRM | Leads on Finger Tips</h4>
                                        <h5 class="card-title">Create New Lead</h5>
                                        <div class="logo">
                                        @if($logo_img != "")
                                            <a href="#">
                                                <img src="{{asset('images/logo/'.$logo_img)}}" alt="" onerror="javascript:$(this).hide();"
                                                style="width: 200px;height: 40px;object-fit: cover;">
                                            </a>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="card-content">
                                        @include('leads.form', ['submitButtonText' => __('Create New Lead'),'submitButton'=>__('Cancel')])
                                    </div>

                                    <div class="footer text-center">
                                        <div class="form-group">
                                            <div class="">
                                                <button type="submit" class="btn btn-primary btn-wd btn-lg" id="add_lead"
                                                        @if($logo_color != "") style="background: {{$logo_color}} !important;" @endif>
                                                    Create New Lead
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
