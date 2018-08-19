@extends('layouts.master')
@section('heading')
    Activities
@stop
@section('content')
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="pull-right" >
        <form action="{{url('activities/create')}}" method="get" id="modal_fade" >
                <input type="submit" class="btn btn-primary" value="Add Activity">
        </form>
        </div>
    </div>


    <div class="col-md-12">
        <div class="card">

            <div class="card-content">
                <ul class="nav nav-pills nav-pills-primary">
                    <li class="active">
                        <a href="#activities" data-toggle="tab" aria-expanded="true">List View</a>
                    </li>
                    <li class="">
                        <a href="#timelineleads" data-toggle="tab" aria-expanded="false">Activity Timeline</a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="activities">
                        <div class="card">
                            <form action="{{url('/search')}}" method="get" id="filterForm-activity" >
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <!-- <div class="form-group label-floating" style="margin-top: 0%">
                                                    <select class="selectpicker" data-live-search="true" data-style="select-with-transition" name ="lead_name" title="Lead Name" data-size="3">
                                                        <option value="" style="font-style: italic; color: #969595">Select Name</option>
                                                        @foreach($leads as $lead)

                                                            <option value="{{$lead->id}}">{{$lead->name}}</option>
                                                        @endforeach
                                                    </select>

                                                </div> -->
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Lead Name</label>
                                                    <input type="name" class="form-control" name="lead_name">
                                                </div>
                                            </div>

                                            <div class="col-md-4">

                                                <div class="form-group label-floating">
                                                    <input id="date" type="date" class="form-control" name="created_from" value="{{carbon::now()->format('Y-m-d')}}" style="cursor: pointer;">


                                                </div>
                                            </div>
                                            <div class="col-md-4">

                                                <div class="form-group label-floating">
                                                    <input id="date" type="date" class="form-control" name="created_to" value="{{carbon::now()->format('Y-m-d')}}" style="cursor: pointer;">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group label-floating" style="margin-top: 0%">
                                                    <select class="selectpicker" data-style="select-with-transition" title="Activity Type" data-size="4" name="activity_type">
                                                        <option value="Email">Email</option>
                                                        <option value="Call">Call</option>
                                                        <option value="Meet">Meet</option>
                                                    </select>

                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <select class="selectpicker" data-style="select-with-transition" title="Status" data-size="3" name="status">
                                                    <option value="Scheduled">Scheduled</option>
                                                    <option value="Completed">Completed</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="pull-left" >

                                                    <input class="btn btn-sm btn-warning" type="reset" name="Reset" value="Reset" id="reset"  onClick="location.reload()"/>
                                                    <input class="btn btn-sm btn-success" type="submit" value="APPLY" id="apply" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="page"  id="page_no" value="1" />
                                <input type="hidden" name="ajax" value="activity"/>
                            </form>
                        </div>

                        <div id="ajaxContent-activity">
                            @include('activities.datatable')
                        </div>


                    </div>

                    <div class="tab-pane " id="timelineleads">
                        <div class="card">

                            <div class="rg normal">
                                <div class="timeline-wrapper timeline-accordion">


                                    @foreach($activities as $activity)
                                    <div class="timeline-step">

                                        <div class="step-header" style="cursor: pointer">
                                            @if($activity->status == "Completed")
                                                <div><i class="fa fa-circle text-success "></i></div>
                                            @else
                                                <div><i class="fa fa-circle text-danger Blink"></i></div>
                                            @endif
                                            @foreach($leads as $lead)
                                                @if($lead->id == $activity->lead_id)
                                            <div class="step-text">{{$activity->date}} {{$lead->name}}</div>
                                                    @endif
                                            @endforeach
                                        </div>

                                        <div class="step-content">
                                            <div class="step-connector">
                                            </div>

                                            <div class="step-inner">

                                                    <p>{{$activity->time}}&nbsp;{{$activity->name}}</p>
                                                    <p>{{$activity->status}}</p>
                                                    <p>{{$activity->details}}</p>
                                                </div>

                                        </div>

                                    </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


@stop

{{--@push('scripts')--}}
    {{--<script>--}}
{{--//        $(document).ready(function() {--}}
{{--//            $('#activity-table').DataTable(--}}
{{--//                {--}}
{{--//                    "order": [[ 1, "desc" ]]--}}
{{--//                }--}}
{{--//            );--}}
{{--//--}}
{{--//        });--}}
    {{--</script>--}}
{{--@endpush--}}
