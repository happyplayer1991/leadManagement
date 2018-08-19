@extends('layouts.master')
@section('heading')
   All Leads
@stop



@section('content')

    <div class="col-md-12">
        <div class="card">

            <div class="card-content">
                <ul class="nav nav-pills nav-pills-primary">
                    <li class="active">
                        <a href="#contacts" data-toggle="tab" aria-expanded="true">Contacts</a>
                    </li>
                    <li class="">
                        <a href="#pendingLeads" data-toggle="tab" aria-expanded="false">Pending Leads</a>
                    </li>
                    <li class="">
                        <a href="#wonLeads" data-toggle="tab" aria-expanded="false">Won Leads</a>
                    </li>
                    <li class="">
                        <a href="#lostLeads" data-toggle="tab" aria-expanded="false">Lost Leads</a>
                    </li>
                    <li class="">
                        <a href="#notQualified" data-toggle="tab" aria-expanded="false">Not Qualified</a>
                    </li>
                    <li class="">
                        <a href="#MyCustomers" data-toggle="tab" aria-expanded="false">My Customers</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="contacts">
                    <div class="material-datatables">
                        <table id="contactsdatatable" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width: 100%">
                            <thead>
                            <tr>
                                <th></th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('E-Mail') }}</th>
                                <th>{{ __('Mobile') }}</th>
                                <th>{{ __('Company') }}</th>
                                <th>{{ __('Product') }}</th>
                                <th>{{ __('Country') }}</th>
                                <th>{{ __('Owner') }}</th>
                                <th class="disabled-sorting text-right">{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>


                            @foreach($getAllClients as  $allClients)

                                <tr>
                                    <td></td>
                                    <td>    @if($allClients->drop_status == "")
                                            @if($allClients->lead_status != "Won")
                                                <div class="btn  btn-warning btn-just-icon btn-round">P

                                                </div>
                                            @elseif($allClients->lead_status == "Won")
                                                <div class="btn  btn-success btn-just-icon btn-round">W

                                                </div>
                                            @endif
                                        @elseif($allClients->drop_status == "Not-Qualifield")
                                            <div class="btn  btn-danger btn-just-icon btn-round" style="font-size: 14px;font-weight: bold;">NQ

                                            </div>
                                        @else
                                            <div class="btn  btn-danger btn-just-icon btn-round"style="font-size: 14px;font-weight: bold;">L

                                            </div>
                                        @endif

                                    </td>
                                    <td>{{$allClients->name}}</td>
                                    <td>{{$allClients->email}}</td>
                                    <td>{{$allClients->primary_number}}</td>
                                    <td>{{$allClients->company_name}}</td>
                                    <td>{{$allClients->interested_product}}</td>
                                    <td>{{$allClients->country}}</td>
                                    <td>{{$allClients->user_name}}</td>
                                    <td class="text-right">
                                        @if($allClients->drop_status == '')

                                        @else
                                            <a href="#" class="btn btn-simple btn-success  btn-icon like" onclick="returnLead({{$allClients->id}})"><large><i class="material-icons">settings_backup_restore</i></large></a>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    </div>
                    <div class="tab-pane " id="pendingLeads">
                        <div class="material-datatables">
                            <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width: 100%" id="client-table">
                                <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <!-- <th>{{ __('Company') }}</th> -->
                                    <th>{{ __('E-Mail') }}</th>
                                    <th>{{__('Mobile')}}</th>
                                    <th>{{__('Company')}}</th>
                                    <th>{{_('Product')}}</th>
                                    <th>{{__('Country')}}</th>
                                    <th>{{__('Owner')}}</th>
                                    <th>{{__('Actions')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($getAllClients as $allClients)
                                    @if($allClients->drop_status == "")
                                        @if($allClients->lead_status != "Won")
                                            <tr>
                                                <td><a  style="color:black!important" href='clients/{{$allClients->id}}'>{{$allClients->name}}</a>
                                                </td>
                                                <td>{{$allClients->email}}</td>
                                                <td>{{$allClients->primary_number}}</td>
                                                <td>{{$allClients->company_name}}</td>
                                                <td>{{$allClients->interested_product}}</td>
                                                <td>{{$allClients->country}}</td>
                                                <td>{{$allClients->user_name}}</td>
                                                <td>
                                                    <a    onclick = "viewLead({{$allClients->id}},this)"><i class="material-icons" style="font-size: 16px;cursor:pointer;color:black">visibility</i></a>
                                                    <a onclick="editLead({{$allClients->id}},this)"><i class="material-icons" style="font-size: 16px;cursor:pointer;color:black">create</i></a>
                                                </td>


                                            </tr>
                                        @endif
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane " id="wonLeads">
                        <div class="material-datatables">
                            <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width: 100%" id="leads-table">
                                <thead>
                                <tr >
                                    <th>{{ __('Name') }}</th>
                                    <!-- <th>{{ __('Company') }}</th> -->
                                    <th>{{ __('E-Mail') }}</th>
                                    <th>{{__('Mobile')}}</th>
                                    <th>{{__('Company')}}</th>
                                    <th>{{_('Product')}}</th>
                                    <th>{{__('Country')}}</th>
                                    <th>{{__('Owner')}}</th>
                                    <th>{{__('Actions')}}</th>

                                </tr>
                                </thead>

                                <tbody style="    background-color: white;">

                                @foreach($getAllClients as $allClients)

                                    @if($allClients->lead_status == "Won")
                                        <tr style=" height: 53px;">
                                            <td><a  style="color:black!important" href='clients/{{$allClients->id}}'>{{$allClients->name}}</a>
                                            </td>
                                            <td>{{$allClients->email}}</td>
                                            <td>{{$allClients->primary_number}}</td>
                                            <td>{{$allClients->company_name}}</td>
                                            <td>{{$allClients->interested_product}}</td>
                                            <td>{{$allClients->country}}</td>
                                            <td>{{$allClients->user_name}}</td>
                                            <td>
                                                <a    onclick = "viewLead({{$allClients->id}},this)"><i class="material-icons" style="font-size: 16px;cursor:pointer;color:black">visibility</i></a>
                                                <!-- <a onclick="editLead({{$allClients->id}},this)"><i class="material-icons" style="font-size: 16px;cursor:pointer;color:black">create</i></a>  -->
                                            </td>


                                        </tr>
                                    @endif
                                @endforeach




                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane " id="lostLeads">
                        <div class="material-datatables">
                            <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width: 100%"  id="lost-table">
                                <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <!-- <th>{{ __('Company') }}</th> -->
                                    <th>{{ __('E-Mail') }}</th>
                                    <th>{{__('Mobile')}}</th>
                                    <th>{{__('Company')}}</th>
                                    <th>{{_('Product')}}</th>
                                    <th>{{__('Country')}}</th>
                                    <th>{{__(' Owner')}}</th>
                                    <th>{{__('Actions')}}</th>

                                </tr>
                                </thead>
                                <tbody style="    background-color: white;">

                                @foreach($getAllClients as $allClients)
                                    @if($allClients->drop_status != "")
                                        @if($allClients->drop_status != "Not-Qualifield")
                                            <tr style=" height: 53px;">
                                                <td><a  style="color:black!important" onclick = "viewLead({{$allClients->id}},this)">{{$allClients->name}}</a>

                                                </td>
                                                <td>{{$allClients->email}}</td>
                                                <td>{{$allClients->primary_number}}</td>
                                                <td>{{$allClients->company_name}}</td>
                                                <td>{{$allClients->interested_product}}</td>
                                                <td>{{$allClients->country}}</td>
                                                <td>{{$allClients->user_name}}</td>
                                                <td>
                                                    <a    onclick = "viewLead({{$allClients->id}},this)"><i class="material-icons" style="font-size: 16px;cursor:pointer;color:black">visibility</i></a>


                                                    <!--          <a onclick="editLead({{$allClients->id}},this)"><i class="material-icons" style="font-size: 16px;cursor:pointer;color:black">create</i></a> -->

                                                </td>


                                            </tr>

                                        @endif
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane " id="notQualified">
                        <div class="material-datatables">
                            <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width: 100%" id="notqualified-table">
                                <thead>
                                <tr >
                                    <th>{{ __('Name') }}</th>
                                <!-- <th>{{ __('Company') }}</th> -->
                                    <th>{{ __('E-Mail') }}</th>
                                    <th>{{__('Mobile')}}</th>
                                    <th>{{__('Company')}}</th>
                                    <th>{{_('Product')}}</th>
                                    <th>{{__('Country')}}</th>
                                    <th>{{__('Owner')}}</th>
                                    <th>{{__('Actions')}}</th>

                                </tr>
                                </thead>

                                <tbody style="    background-color: white;">

                                @foreach($getAllClients as $allClients)

                                    @if($allClients->lead_status == "Won")
                                        <tr style=" height: 53px;">
                                            <td><a  style="color:black!important" href='clients/{{$allClients->id}}'>{{$allClients->name}}</a>
                                            </td>
                                            <td>{{$allClients->email}}</td>
                                            <td>{{$allClients->primary_number}}</td>
                                            <td>{{$allClients->company_name}}</td>
                                            <td>{{$allClients->interested_product}}</td>
                                            <td>{{$allClients->country}}</td>
                                            <td>{{$allClients->user_name}}</td>
                                            <td>
                                                <a    onclick = "viewLead({{$allClients->id}},this)"><i class="material-icons" style="font-size: 16px;cursor:pointer;color:black">visibility</i></a>
                                            <!-- <a onclick="editLead({{$allClients->id}},this)"><i class="material-icons" style="font-size: 16px;cursor:pointer;color:black">create</i></a>  -->
                                            </td>


                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane " id="MyCustomers">
                        <div class="material-datatables">
                            <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width: 100%" id="clients-table">
                                <thead>
                                <tr >
                                    <th>{{ __('Name') }}</th>
                                <!-- <th>{{ __('Company') }}</th> -->
                                    <th>{{ __('E-Mail') }}</th>
                                    <th>{{__('Mobile')}}</th>
                                    <th>{{__('Company')}}</th>
                                    <th>{{_('Product')}}</th>
                                    <th>{{__('Country')}}</th>
                                    <th>{{__('Owner')}}</th>
                                    <th>{{__('Actions')}}</th>

                                </tr>
                                </thead>

                                <tbody style="    background-color: white;">

                                @foreach($getAllClients as $allClients)

                                    @if($allClients->lead_status == "Won")
                                        <tr style=" height: 53px;">
                                            <td><a  style="color:black!important" href='clients/{{$allClients->id}}'>{{$allClients->name}}</a>
                                            </td>
                                            <td>{{$allClients->email}}</td>
                                            <td>{{$allClients->primary_number}}</td>
                                            <td>{{$allClients->company_name}}</td>
                                            <td>{{$allClients->interested_product}}</td>
                                            <td>{{$allClients->country}}</td>
                                            <td>{{$allClients->user_name}}</td>


                                        </tr>
                                    @endif
                                @endforeach




                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

    </div>
    </div>
        <div id="modal_window">
        </div>
@stop

@push('scripts')
<script>
    

$(function(){
    $('#client-table').DataTable();
    $('#leads-table').DataTable();
    $('#notqualified-table').DataTable();
    $('#lost-table').DataTable();

});
$(function () {
    $('#contactsdatatable').DataTable({"pagingType": "full_numbers",
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        responsive: true,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search records",
        }});

});

$(function () {
    $('#clients-table').DataTable();

});

</script>
@endpush