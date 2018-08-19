@extends('layouts.master')
@section('heading')
<!--     <h1 style="padding: 20px;margin-bottom: -20px">All Leads</h1> -->
@stop

@section('content')
<!-- <div class="pull-right">
  <a href="{{ route('projects.create')}}"><img src="{{url('images/plus-circle-outline.png')}}"  width=" 30px" alt=""   style="color:#313949!important;margin-bottom: 5px" title="New Client"></a>
</div> -->
    <table class="table table-hover " id="Accounts-table">
        <thead>
        <tr>
            <th>{{ __(' Account Name(FN+LN)') }}</th>
            <th>{{ __('Company Name') }}</th>
            <th>{{ __('Website') }}</th>
            <th>{{ __('Annual Revenue') }}</th>
            <th>{{__('Interested Product')}}</th>
            <th>{{__('Account Owner')}}</th>
            <!-- <th>{{__('Lead Status')}}</th> -->
        </tr>
        </thead>
        <!-- <tbody>
            @foreach($clientDetails as $index => $client)
            <tr>
                <td><a href='clients/{{$client->id}}'>{{$client->client_name}}</a></td>
                <td>{{$client->company_name}}</td>
                <td>{{$client->email}}</td>
                <td>{{$client->primary_number}}</td>
                <td>{{$client->source_name}}</td>
                <td>{{$client->user_name}}</td>
                <td>{{$client->next_follow_up_name}}</td>

            </tr>
            @endforeach
        </tbody> -->
    </table>

@stop

@push('scripts')
<script>
    $(function () {
        $('#clients-table').DataTable();
        // $('#clients-table').DataTable({
        //     processing: true,
        //     serverSide: true,

        //     ajax: '{!! route('clients.data') !!}',
        //     columns: [

        //         {data: 'namelink', name: 'name'},
        //         // {data: 'company_name', name: 'company_name'},
        //         {data: 'email', name: 'email'},
        //         {data: 'primary_number', name: 'primary_number'},
        //         @if(Entrust::can('client-update'))   
        //         { data: 'edit', name: 'edit', orderable: false, searchable: false},
        //         @endif
        //         @if(Entrust::can('client-delete'))   
        //         { data: 'delete', name: 'delete', orderable: false, searchable: false},
        //         @endif

        //     ]
        // });
    });
</script>
@endpush
