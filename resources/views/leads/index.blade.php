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
                    <a href="#contacts" data-toggle="tab" aria-expanded="true">All Contacts</a>
                </li>
                <li class="">
                    <a href="#pendingLeads" data-toggle="tab" aria-expanded="false">My Leads</a>
                </li>
                <li class="">
                    <a href="#MyCustomers" data-toggle="tab" aria-expanded="false">My Customers</a>
                </li>
            </ul>

            <div class="additional-action">
                <form action="{{url('/leadsExcelFormat')}}" method="get"  enctype="multipart/form-data">
                    <input class="btn btn-sm btn-primary" type="submit" value="Download CSV Format" id="apply" />
                </form>

                <form action="{{url('/leadsDetailsImport')}}" method="post"  enctype="multipart/form-data">
                    {{Form::hidden('file')}}

                    <input class="btn btn-sm btn-primary" type="submit" value="Upload CSV File" id="apply"/>
                    <input class="text-center" type="file" id="file" name="file"/>
                </form>
            </div>

            <div class="tab-content">
                <div class="tab-pane active" id="contacts">
                    <div class="card">
                        <div id="filterForm-contact" >
                            <div class="card-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Lead Name</label>
                                                <input type="text" class="form-control" name="lead_name">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Company</label>
                                                <input type="text" class="form-control" name="company">
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
                                            <button type="button" class="btn btn-sm btn-warning reset">RESET</button>
                                            <button type="button" class="btn btn-sm btn-success apply">APPLY</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="ajaxContent-contact">
                        @include('leads.contacts')
                    </div>
                </div>

                <div class="tab-pane " id="pendingLeads">
                    <div class="card">
                        <div id="filterForm-allleads" >
                            <div class="card-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Lead Name</label>
                                                <input type="text" class="form-control" name="lead_name">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Company</label>
                                                <input type="text" class="form-control" name="company">
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
                                                <button type="button" class="btn btn-sm btn-warning reset">RESET</button>
                                                <button type="button" class="btn btn-sm btn-success apply">APPLY</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="ajaxContent-allleads">
                        @include('leads.allleads')
                    </div>
                </div>

                <div class="tab-pane " id="MyCustomers">
                    <div class="card">
                        <div id="filterForm-customers" >
                            <div class="card-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Lead Name</label>
                                                <input type="name" class="form-control" name="lead_name">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Company</label>
                                                <input type="name" class="form-control" name="company">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="pull-left" >
                                                <button type="button" class="btn btn-sm btn-warning reset">RESET</button>
                                                <button type="button" class="btn btn-sm btn-success apply">APPLY</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
@endpush
