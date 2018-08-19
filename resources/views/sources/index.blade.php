@extends('layouts.master')
@section('heading')
    Leads From Other Source
@stop

@section('content')

    
    <div class="col-md-12">
        <div class="card">
            <div class="card-content">
                {{--@foreach($leads as $allClients)--}}
                    {{--@if($allClients->email == null ||$allClients->name == null ||$allClients->primary_number == null )--}}
                {{--<h4 class="card-title text-center">Congratulations! You have new leads from other sources.</h4>--}}
                    {{--@endif--}}
              {{--@endforeach--}}
                <div class="material-datatables table-responsive">

                    <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width: 100%" id="other-source">
                        <thead>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Email') }}</th>
                            <th>Message</th>
                            <th>Assign User</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($leads as $allClients)
                            @if($allClients->session_id != '')
                                <tr>
                                    <td>{{$allClients->name}}</td>
                                    <td>{{$allClients->email}}</td>
                                    <td>{{$allClients->messages}}</td>
                                    <td>
                                        <select name="user_id" class="form-control activity_status" onchange="assign_users('{{$allClients->id}}',this)">
                                            <option>Select Users...</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                       
                                    </td>

                                </tr>
                            @endif
                        @endforeach


                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
<script>
    $(function () {
        $('#other-source').DataTable();
       
    });
</script>
@endpush