@extends('layouts.master')
@section('heading')
    Calendar

        <form action="{{url('activities/create')}}" method="get" id="modal_fade1" >
            <button type="submit" class="btn btn-primary btn-sm"  style=" margin-top: -73%; margin-left: 106%;">
                <i class="material-icons notranslate" style="margin-left: -5px;">add_to_queue</i>&nbsp;&nbsp;Add</button>
        </form>

@stop


@section('content')
<head>
    <link href="{{ URL::asset('css/fullcalendar.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ URL::asset('js/jquery.js')}}"></script>
    <script src="{{ URL::asset('js/moment.js')}}"></script>
    <script src="{{ URL::asset('js/fullcalender.js')}}"></script>
</head>
<body>
    {!! $calendar_detais->calendar() !!}
    {!! $calendar_detais->script() !!}
</body>
@stop
