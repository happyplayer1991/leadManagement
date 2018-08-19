@extends('layouts.master')
@section('heading')
   Lead Details
@stop
@section('content')

   <div class="col-md-12">
        <div class="card">
            <div class="card-content">
                <ul class="nav nav-pills nav-pills-primary">
                    <li class="active">
                        <a href="#LeadInformation" data-toggle="tab" aria-expanded="true">Lead Information</a>
                    </li>
                    <li class="">
                        <a href="#activities" data-toggle="tab" aria-expanded="false">Activities</a>
                    </li>
                    <li class="">
                        <a href="#Quotations" data-toggle="tab" aria-expanded="false">Quotations</a>
                    </li>
                    <li class="">
                        <a href="#invoice" data-toggle="tab" aria-expanded="false">Invoices</a>
                    </li>
                    <li class="">
                        <a href="#Notes" data-toggle="tab" aria-expanded="false">Notes</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="LeadInformation">

                        <a class=" btn-icon " action="{{url('leads/'.$lead->id.'/edit')}}" id="modal_fade" style="cursor: pointer;"><i class="material-icons pull-right" style="color:black">create</i></a>

                        <div class="material-datatables">
                                <dl>

                                        <dt class="">Lead Name</dt>
                                        <dd class="">
                                            <span>{{$lead->name}}</span>
                                        </dd>

                                        <dt class="">Mobile Number</dt>
                                        <dd class="">
                                            <span>{{$lead->primary_number}}</span>
                                            <span style="cursor: pointer"> <a type="text" onclick="sms({{$lead->id}},this)"><i class="material-icons notranslate">message_text</i></a></span>
                                        </dd>

                                        <dt class="">Email Address</dt>
                                        <dd class="">
                                            <span>{{$lead->email}}</span>
                                            <span style="cursor: pointer"> <a type="text" onclick="email({{$lead->id}},this)"><i class="material-icons notranslate">email</i></a></span>
                                        </dd>

                                        <dt class=""> Address</dt>
                                        <dd class="">
                                            <span>{{$lead->address}}</span>
                                        </dd>

                                        <dt class=""> Country</dt>
                                        <dd class="">
                                            <span>{{$lead->country}}</span>
                                        </dd>

                                        <dt class=""> Pin</dt>
                                        <dd class="">
                                            <span>{{$lead->pin}}</span>
                                        </dd>
                                        <dt class=""> Company Name</dt>
                                        <dd class="">
                                            <span>{{$lead->company_name}}</span>
                                        </dd>
                                        <dt class=""> Company Website</dt>
                                        <dd class="">
                                            <span>{{$lead->company_website}}</span>
                                        </dd>
                                        <dt class=""> Annual Revenue </dt>
                                        <dd class="">
                                            <span>{{$lead->annual_revenue}}</span>
                                        </dd>
                                        <dt class="">Number Of Employees</dt>
                                        <dd class="">
                                            <span>{{$lead->number_employee}}</span>
                                        </dd>
                                        <dt class=""> Industry Type</dt>
                                        <dd class="">
                                            @foreach($industry as $i)
                                            <span>{{$i->name}}</span>
                                            @endforeach
                                        </dd>
                                        <dt class="">Lead Status</dt>
                                        @if($lead->drop_status == '')
                                        <dd class="">
                                            <span>{{$lead->lead_stage}}</span>
                                        </dd>
                                        @else
                                        <dd class="" style="color: red">
                                            <span>Drop</span>
                                        </dd>
                                        @endif
                                        <dt class="">Lead Type</dt>
                                        <dd class="">
                                            <span>{{$lead->lead_type}}</span>
                                        </dd>
                                        <dt class="">Intrested Product </dt>
                                        <dd class="">
                                            @foreach($product as $p)
                                            <span>{{$p->product_name}}</span>
                                            @endforeach
                                        </dd>
                                        <dt class="">Lead Owner</dt>
                                        <dd class="">
                                            <span>{{$users->name}}</span>
                                        </dd>
                                        <dt class=""> Lead Source</dt>
                                        <dd class="">
                                            <span>{{$lead->source_id}}</span>
                                        </dd>
                                </dl>

                        </div>
                    </div>
                    <div class="tab-pane " id="activities">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            @if($lead->drop_status == '')
                            <div class="pull-right" >
                                <button type="button" class="btn btn-primary" action="{{url('activities/createActivity',$lead->id)}}" id="modal_fade">Add Activity</button>

                            </div>
                            @endif
                        </div>

                        <div class="rg normal">
                            <div class="timeline-wrapper timeline-accordion" style="background: none !important;">

                                @foreach($activities as $activity)
                                <div class="timeline-step  ">


                                        <div class="step-header " style="cursor: pointer">
                                            @if($activity->status == "Completed")
                                                <div><i class="fa fa-circle text-success "></i></div>
                                            @else
                                                <div><i class="fa fa-circle text-danger Blink"></i></div>
                                            @endif

                                            <div class="step-text">{{$activity->date}}</div>
                                            <div class="step-text">{{$activity->name}}</div>
                                        </div>

                                        <div class="step-content" style="height: 100px !important;">
                                            <div class="step-connector">
                                            </div>
                                            <div class="step-inner">
                                            @foreach($act as $date)
                                                @if($date->date == $activity->date)


                                                        <div>{{$date->status}}
                                                            <p>{{$date->details}}</p></div>


                                                @endif
                                            @endforeach
                                            </div>
                                        </div>

                                </div>

                                @endforeach
                            </div>
                        </div>

                    </div>
                      <div class="tab-pane " id="Quotations">
                          <div class="col-sm-12 col-md-12 col-lg-12">
                            @if($lead->drop_status == '')
                              <div class="pull-right" >
                               <!--  <button type="button" class="btn btn-primary" action="{{url('/addQuotation',$lead->id)}}" id="modal_fade">Add Quotation</button> -->
                                  <a href="{{route('quotations.createQuotation', ['id' => $lead->id])}}" class="btn btn-primary">Add Quotation</a>
                              </div>
                            @endif
                          </div>
                          <div class="material-datatables">
                              <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width: 100%" id="openactivities-table">
                                <!-- <thead class="inv"> -->
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Lead Name</th>
                                    <th>Company</th>
                                    <th>Amount</th>
                                    <th>Status</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($quotations as $quotation)
                                    <tr>
                                        @if($quotation->lead_id == $lead->id)
                                        <td class="">
                                            @if($quotation->status == "approved")
                                                <div class="btn  btn-success btn-just-icon btn-round">A</div>
                                            @elseif($quotation->status == "rejected")
                                                <div class="btn  btn-danger btn-just-icon btn-round">R</div>
                                            @elseif($quotation->status=="pending")
                                                <div class="btn  btn-warning btn-just-icon btn-round">P</div>
                                            @else
                                                <div class="btn  btn-primary btn-just-icon btn-round">S</div>
                                            @endif
                                        </td>
                                        <td><a  style="color:black!important" href=''>{{$lead->name}}</a></td>
                                        <td>{{$lead->company_name}}</td>
                                            @foreach($currency as $curr)
                                                @if($curr->currency_code == substr($quotation->currency,0,3))
                                        <td>{{$curr->symbol}}{{$quotation->amount}}</td>
                                                @endif
                                            @endforeach
                                        <td>{{$quotation->status}}</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                          </div>
                    </div>
                    <div class="tab-pane " id="invoice">
                        <div class="material-datatables">
                            <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width: 100%" id="openactivities-table">
                                <!-- <thead class="inv"> -->
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Lead Name</th>
                                    <th>Company</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($invoices as $invoice)
                                    <tr>
                                        @if($invoice->lead_id == $lead->id)
                                        <td><div class="btn  btn-success btn-just-icon btn-round">W</div></td>
                                        <td><a  style="color:black!important" href='leads/{{$lead->id}}'>{{$lead->name}}</a></td>
                                        <td>{{$lead->company_name}}</td>
                                        <td>{{$invoice->amount}}</td>
                                        <td>{{$invoice->public_notes}}</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane " id="Notes">
                        <div class="pull-right" >
                            <button type="button" class="btn btn-primary" onclick="addNotes({{$lead->id}},this)">Add Notes</button>

                        </div>
                        <div class="material-datatables" id="notescontent">
                            @include('leads.notes')
                        </div>

                </div>
            </div>

        </div>
    </div>

@stop




