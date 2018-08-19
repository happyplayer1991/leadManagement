<?php foreach ($scrollText as $scroll) {} ?>
@if(count($scrollText)>0)
    <marquee behaviour="scroll" direction="left" style="background-color: #4096ec;;color: white;font-weight: bold;height: 35px;
     padding-top: 7px; width: 70%; margin-left: 25%;  border-radius: 25px;">{{$scroll->announcement}}</marquee>
@endif
@extends('layouts.master')
@section('heading')
    ControlPanel
@stop

@section('content')

    <!-- <div class="card" id="note">
        Scrolling Text.
    </div> -->

    <div class="col-md-12">
        <div class="card">

            <div class="card-content">
                <ul class="nav nav-pills nav-pills-primary">
                    <li class="active">
                        <a href="#users" data-toggle="tab" aria-expanded="true">Users</a>
                    </li>
                    <li class="">
                        <a href="#departments" data-toggle="tab" aria-expanded="false">Departments</a>
                    </li>
                    <li class="">
                        <a href="#announcement" data-toggle="tab" aria-expanded="false">Broadcast</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="users">
                            @include('users.index')
                    </div>
                    <div class="tab-pane " id="departments">
                            @include('departments.index')
                    </div>
                    <?php $id = \Auth::user()->id; foreach($usersDetails as $users){}?>
                    
                    <div class="tab-pane " id="announcement">
                        <div class="card">
                            <div class="card-content">
                                <form action="{{url('/announcement/'.$id)}}" method="post" id="submit-form">
                                <label class="label-control">Announcement<font color="red">*</font></label>
                                <?php foreach($scrollText as $scroll) {} ?>
                                @if(count($scrollText)>0)
                                <textarea id="announce" name="announcement" class="form-control">{{$scroll->announcement}}</textarea>
                                @else
                                <textarea id="announce" name="announcement" class="form-control"></textarea>
                                @endif
                                <input type="text" name="user_id" value="{{$id}}" hidden="value">
                                <input type="text" name="company_id" value="{{$users->company_id}}" hidden="value">
                                <div class="pull-right">
                                <input type="submit" value="Publish" class="btn btn-primary" id="publish">
                                </div>
                                </form>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-content">
                                <div class="material-datatables table-responsive">
                                    <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" id="dep-table">

                                    <thead>
                                    <td>Message</td>
                                    <td>Actions</td>
                                    </thead>
                                        @foreach($publish as $pub)
                                        <tbody>

                                        <td style="width: 60%">{{$pub->announcement}}</td>
                                        <td>
                                            @if($pub->misclaneous1=="Unpublish")
                                            <button type="button" class="btn btn-primary btn-sm" action="{{url('publish',$pub->id)}}" id="modal_fade">Publish</button>
                                            @else
                                            <button type="button" class="btn btn-primary btn-sm" action="{{url('unpublish',$pub->id)}}" id="modal_fade">Unpublish</button>

                                            @endif


                                        </td>

                                        </tbody>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

        </div>
    </div>
@stop
@push('scripts')
<script>
    close = document.getElementById("close");
    close.addEventListener('click', function() {
        note = document.getElementById("note");
        note.style.display = 'none';
    }, false);
</script>
    @endpush