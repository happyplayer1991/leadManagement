@extends('layouts.master')
@section('heading')
 My Customers
@stop

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-content">
                <div class="material-datatables">
                    <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width: 100%" id="clients-table">
                        <thead>
                        <tr>
                            <th>{{ __(' Lead Name') }}</th>
                            <th>{{ __('Company') }}</th>
                            <th>{{ __('E-Mail') }}</th>
                            <th>{{ __('Phone Number') }}</th>
                            <th>{{__('Country')}}</th>
                            <th>{{__('Lead Owner')}}</th>
                            <!--             <th>{{__('Actions')}}</th> -->

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clientDetails as $index => $client)
                            <tr>
                                <td><a style="color:black!important" href='clients/{{$client->id}}'>{{$client->name}}</a></td>
                                <td>{{$client->company_name}}</td>
                                <td>{{$client->email}}</td>
                                <td>{{$client->primary_number}}</td>
                                <td>{{$client->country}}</td>
                                <td>{{$client->user_name}}</td>
                                <!--     <td><a onclick = "viewLead({{$client->id}},this)"><i class="material-icons" style="font-size: 16px;cursor:pointer;color:black">visibility</i></a></td> -->

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div></div>
@stop

@push('scripts')
<script>
    $(function () {
        $('#clients-table').DataTable();

    });
</script>
@endpush
