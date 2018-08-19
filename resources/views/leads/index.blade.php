@extends('layouts.master')
@section('heading')
    All Leads
@stop



@section('content')

<label>Download csv file Format for Leads Data</label>
<label style="margin-right: 8%;"class="pull-right">Upload csv file to Store Leads Data</label>

<form action="{{url('/leadsExcelFormat')}}" method="get"  enctype="multipart/form-data">
    <div class="pull-left">
        <input class="btn btn-sm btn-primary" type="submit" value="Download" id="apply" style="margin-left:40%; margin-top:0%;" />
    </div>
</form>
<form action="{{url('/leadsDetailsImport')}}" method="post"  enctype="multipart/form-data">
    <div class="pull-right">
        {{Form::hidden('file')}}
        <input class="text-center" type="file" id="file" name="file" style="float: left;margin-left: 2%;"/>
        <input class="btn btn-sm btn-primary" type="submit" value="Upload" id="apply" style="margin-left:-8%; margin-top:0%;"/>
                      
    </div>
</form>

    <div class="col-md-12">
        <div class="card">

            <div class="card-content">
                <ul class="nav nav-pills nav-pills-primary">
                    <li class="active">
                        <a href="#contacts" data-toggle="tab" aria-expanded="true">All Contacts</a>
                    </li>
                    <li class="">
                        <a href="#pendingLeads" data-toggle="tab" aria-expanded="false">My Leads</a>
                    </li>
                    <li class="">
                        <a href="#MyCustomers" data-toggle="tab" aria-expanded="false">My Customers</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="contacts">
                        <div class="card">
                            <form action="{{url('/search')}}" method="get" id="filterForm-contact" >
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="col-md-4">
                                                <!-- <div class="form-group label-floating" style="margin-top: 0%">
                                                    <select class="selectpicker" data-live-search="true" data-style="select-with-transition" name ="lead_name" title="Lead Name" data-size="3" >
                                                        <option value="" style="font-style: italic; color: #969595">Select Name</option>
                                                        @foreach($allleads as $lead)
                                                            <option value="{{$lead->id}}">{{$lead->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div> -->
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Lead Name</label>
                                                    <input type="name" class="form-control" name="lead_name">
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-4">

                                                <div class="form-group label-floating">
                                                    <label class="control-label">Email</label>
                                                    <input type="name" class="form-control" name="email">
                                                </div>
                                            </div> -->
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Company</label>
                                                    <input type="name" class="form-control" name="company">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <select class="selectpicker" data-style="select-with-transition" name="status" title="Status" data-size="5">
                                                    <option value="all">All</option>
                                                    <option value="Pending">Pending</option>
                                                    <option value="Quote">Quotation</option>
                                                    <option value="Won">Won</option>
                                                    <option value="Lost">Lost Lead</option>
                                                    <option value="NotQualified">Not Qualified</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">

                                                    <input class="btn btn-sm btn-warning" type="button" value="RESET" id="reset" />
                                                    <input class="btn btn-sm btn-success" type="submit" value="APPLY" id="apply" />


                                            </div>
                                            <div class="col-md-4">

                                            </div>
                                            <div class="col-md-4">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="page"  id="page_no" value="1" />
                                <input type="hidden" name="ajax" value="contacts"/>
                                {{--<input type="hidden" name="ajax" value="allleads"/>--}}
                            </form>
                        </div>
                        <div id="ajaxContent-contact">
                            @include('leads.contacts')
                        </div>
                    </div>
                    <div class="tab-pane " id="pendingLeads">
                        <div class="card">
                            <form action="{{url('/search')}}" method="get" id="filterForm-allleads" >
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                               <!--  <div class="form-group label-floating" style="margin-top: 0%">
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
                                            <!-- <div class="col-md-4">

                                                <div class="form-group label-floating">
                                                    <label class="control-label">Email</label>
                                                    <input type="name" class="form-control" name="email">
                                                </div>
                                            </div> -->

                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Company</label>
                                                    <input type="name" class="form-control" name="company">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <select class="selectpicker" data-style="select-with-transition"  title="Status" data-size="5" name="status">
                                                    <option value="all">All</option>
                                                    <option value="Pending">Pending</option>
                                                    <option value="Quote">Quotation</option>
                                                    <option value="Won">Won</option>
                                                    <option value="Lost">Lost Lead</option>
                                                    <option value="NotQualified">Not Qualified</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="pull-left" >
                                                    <input class="btn btn-sm btn-warning" type="submit" value="RESET" id="reset" />
                                                    <input class="btn btn-sm btn-success" type="submit" value="APPLY" id="apply" />

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="page"  id="page_no" value="1" />
                                <input type="hidden" name="ajax" value="allleads"/>
                            </form>
                        </div>
                        <div id="ajaxContent-allleads">
                            @include('leads.allleads')
                        </div>
                    </div>

                    <div class="tab-pane " id="MyCustomers">
                        <div class="card">
                            <form action="{{url('/search')}}" method="get" id="filterForm-customers" >
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                 <!-- <div class="form-group label-floating" style="margin-top: 0%">
                                                    <select class="selectpicker" data-live-search="true" data-style="select-with-transition" name ="lead_name" title="Lead Name" data-size="3">
                                                        <option value="" style="font-style: italic; color: #969595">Select Name</option>
                                                        @foreach($wonLeads as $lead)

                                                            <option value="{{$lead->id}}">{{$lead->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div> -->
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Lead Name</label>
                                                    <input type="name" class="form-control" name="lead_name">
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-4">

                                                <div class="form-group label-floating">
                                                    <label class="control-label">Email</label>
                                                    <input type="name" class="form-control" name="email">
                                                </div>
                                            </div> -->

                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Company</label>
                                                    <input type="name" class="form-control" name="company">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="pull-left" >
                                                    <input class="btn btn-sm btn-warning" type="submit" value="RESET" id="reset" />
                                                    <input class="btn btn-sm btn-success" type="submit" value="APPLY" id="apply" />

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="page"  id="page_no" value="1" />
                                <input type="hidden" name="ajax" value="mycustomers"/>
                            </form>
                        </div>
                        <div id="ajaxContent-customers">
                            @include('leads.mycustomers')
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



//        $(function(){
//            $('#contactsdatatable').DataTable();
//            $('#allleadsdatatable').DataTable();
//            $('#client-table').DataTable();
////            $('#lost-table').DataTable();
//
//        });

//        $(function () {
//            $('#contactsdatatable').DataTable({"pagingType": "full_numbers",
//                "lengthMenu": [
//                    [10, 25, 50, -1],
//                    [10, 25, 50, "All"]
//                ],
//                responsive: true,
//                language: {
//                    search: "_INPUT_",
//                    searchPlaceholder: "Search records",
//                }});
//
//        });
//
//        $(function () {
//            $('#clients-table').DataTable();
//
//        });


    </script>
@endpush
