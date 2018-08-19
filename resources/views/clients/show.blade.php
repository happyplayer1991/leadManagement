@extends('layouts.master')
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
                        <a onclick="editLead({{$client->id}},this)" class=" btn-icon aicon "><i class="material-icons pull-right "style="color: black;">create</i></a>
                        <div class="material-datatables">
                                <dl>

                                        <dt class="">Lead Name</dt>
                                        <dd class="">
                                            <span>{{$client->name}}</span>
                                        </dd>

                                        <dt class="">Mobile Number</dt>
                                        <dd class="">
                                            <span>{{$client->primary_number}}</span>
                                        </dd>

                                        <dt class="">Email Address</dt>
                                        <dd class="">
                                            <span>{{$client->email}}</span>
                                        </dd>

                                        <dt class=""> Address</dt>
                                        <dd class="">
                                            <span>{{$client->address}}</span>
                                        </dd>

                                        <dt class=""> Country</dt>
                                        <dd class="">
                                            <span>{{$client->country}}</span>
                                        </dd>

                                        <dt class=""> Pin</dt>
                                        <dd class="">
                                            <span>{{$client->pin}}</span>
                                        </dd>
                                        <dt class=""> Company Name</dt>
                                        <dd class="">
                                            <span>{{$client->company_name}}</span>
                                        </dd>
                                        <dt class=""> Company Website</dt>
                                        <dd class="">
                                            <span>{{$client->company_website}}</span>
                                        </dd>
                                        <dt class=""> Annual Revenue </dt>
                                        <dd class="">
                                            <span>{{$client->annula_revenue}}</span>
                                        </dd>
                                        <dt class="">Number Of Employees</dt>
                                        <dd class="">
                                            <span>{{$client->number_employee}}</span>
                                        </dd>
                                        <dt class=""> Industry Type</dt>
                                        <dd class="">
                                            <span>{{$client->industry_type }}</span>
                                        </dd>
                                        <dt class="">Lead Status</dt>
                                        <dd class="">
                                            <span>{{$client->lead_status}}</span>
                                        </dd>
                                        <dt class="">Intrested Product </dt>
                                        <dd class="">
                                            <span>{{$users->intrested_product}}</span>
                                        </dd>
                                        <dt class="">Lead Owner</dt>
                                        <dd class="">
                                            <span>{{$users->name}}</span>
                                        </dd>
                                        <dt class=""> Lead Source</dt>
                                        <dd class="">
                                            <span>{{$client->source_type}}</span>
                                        </dd>
                                </dl>

                        </div>
                    </div>
                    <div class="tab-pane " id="activities">
                        <div class="material-datatables">
                            <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width: 100%" id="openactivities-table">
                                <!-- <thead class="inv"> -->
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Lead Name</th>
                                    <th>Activity Type</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Details</th>
                                    <th>
                                        <a style="float: right;text-decoration: none;cursor:pointer" class="btn btn-primary " onclick ="addActivity({{$client->id}},this,'details')"  >Add Activity </a>

                                    </th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if($follow_up_activity != '')
                                    @foreach($follow_up_activity as $follow_up)

                                        @if($follow_up->status == "Scheduled")
                                            <tr>
                                                <td class="">
                                                    @if($allClients->drop_status == "")
                                                        @if($allClients->lead_stage != "Won")
                                                            <div class="btn  btn-success btn-just-icon btn-round">P

                                                            </div>
                                                        @elseif($allClients->lead_stage == "Won")
                                                            <div class="btn  btn-danger btn-just-icon btn-round">W

                                                            </div>
                                                        @endif
                                                    @endif
                                                   </td>
                                                <td><a  style="color:black!important" href='clients/{{$client->id}}'>{{$client->name}}</a></td>
                                                <td>{{$follow_up->next_follow_up_name}}</td>

                                                <td>{{ date('d/m/Y', strtotime($follow_up->date))}}</td>
                                                <?php $status= array('Scheduled'=>'Scheduled','Completed' =>'Completed');?>
                                                <td>
                                                    {!! Form::select('status', $status,null, ['class' => 'form-input ui search selection search-select  activity_status', 'id' => 'search-select', 'onchange'=> "activity_status('$follow_up->id',this,'details')"]) !!}
                                                </td>

                                                <td>{{$follow_up->details}}</td>
                                            <!-- {!! Form::model($client, [
                           'method' => 'POST',
                           'url' => ['clients/follow_up', $follow_up->id],
                           ]) !!} -->
                                            <!-- <td>{{ Form::button('<span class="glyphicon glyphicon-menu-right" data-toggle="tooltip" title="CLOSE"></span>', ['type' => 'submit','style'=>'border:none;font-size:20px;background-color:transparent' ]) }}
                                                    <! <a href="#" data-toggle="tooltip" title="Hooray!">Hover over me</a></td> -->

                                                {!! Form::close() !!}
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane " id="Quotations">
                        <div class="material-datatables">
                        
                        <div class="container">
                        

                        @if(count($quotations)>0)  

                        @foreach($quotations as $quotation)

                          <a href="#demo{{$quotation->quotation_id}}" class="btn btn-info" data-toggle="collapse">{{$quotation->quotation_id}}</a>                   
                          

                          <div id="demo{{$quotation->quotation_id}}" class="collapse">
                              <button class="btn btn-just-icon btn-round btn-linkedin">
                                  <i class="fa fa-linkedin"></i>
                                  <div class="ripple-container"></div></button>
                            <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th >Products</th>
                                    <th>Description</th>
                                    <th >Price</th> 
                                </tr>
                            </thead>
                            <tbody>  
                             @foreach($quotation_product as $product)  
                                @if($quotation->quotation_id == $product->quotation_id)
                                    <tr >
                                        <td>{{$product->product_name}}</td>
                                        <td>{{$product->description}}</td>
                                        <td>{{$product->price}}</td>
                                    </tr>
                                @endif
                            @endforeach
                                    <tr>
                                    <td></td>
                                    <td>sum</td>
                                    <td>{{$quotation->total_amount}}</td>
                                    </tr>                   
                            </tbody>
                        </table>
                          </div>
                       

                       @endforeach
                        @endif
                         </div>
                             {!! Form::open(array('url' => array('/clients/quotations/create',$client->id ))) !!}
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th >Products</th>
                                    <th>Description</th>
                                    <th >Price</th>

                                    <th><input type="submit"  name="area_statement_save" value="Save" class="btn btn-primary btn-sm"/></th>

                                </tr>
                            </thead>
                            <tbody>

                                    <tr class="tr_clone">
                                        <td > {!! Form::select('products[]', $products, null, ['class' => 'form-input ui search selection top right pointing search-select if', 'id' => 'search-select']) !!}</td>
                                        <td>{!! Form::textarea('description[]',null,['class'=>'form-control','rows'=>'1','cols'=>'20'])!!}</td>
                                        <td >{!! Form::text('price[]', null, ['class' => 'form-control price', 'id' =>'price']) !!}</td>
                                        
                                        <td><a href="javascript:void(0);" class="tr_clone_add" title="Add field"><i class="glyphicon glyphicon-plus"></i></a></td>
                                    </tr>
                                    <tr>
                                    <td></td>
                                    <td>sum</td>
                                    <td><span id="sum_total"></span><input name="quotation_total" type="hidden" id="total_value"/> </td>
                                    </tr>
                            </tbody>
                        </table>
                                {!! Form::close() !!}

                        </div>
                    </div>
                    <div class="tab-pane " id="Notes">
                        <div class="material-datatables">
                            <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width: 100%" id="notes-table">


                            </table>
                        </div>
                    </div>

                            <div class="tab-pane " id="Notes">
                        <div class="material-datatables">
                            <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width: 100%" id="notes-table">

                                @if($notes != '')
                                    @foreach($notes as $comment)
                                        @if($comment->status == "Lead")
                                            <div class="panel panel-primary shadow" style="margin-top:15px; padding-top:10px;">
                                                <div class="panel-body">
                                                    <p>  {{$comment->note}}</p>
                                                    <p class="smalltext">{{ __('Comment by') }}: <a
                                                                href="{{route('users.show', $comment->user->id)}}"> {{$comment->user->name}} </a>
                                                    </p>
                                                    <p class="smalltext">{{ __('Created at') }}:
                                                    {{ date('d F, Y, H:i:s', strtotime($comment->created_at))}}
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif




                                {!! Form::open(array('url' => array('/clients/notes',$client->id ))) !!}
                                <div class="form-group">
                                    {!! Form::textarea('note', null, ['class' => 'form-control']) !!}
                                    {!! Form::hidden('status', 'Lead', ['class' => 'form-control']) !!}
                                    {!! Form::hidden('client_id', $client->id, ['class' => 'form-control']) !!}
                                </div>
                                <div class="pull-right">
                                    {!! Form::submit( __('Add Note') , ['class' => 'btn btn-primary btn-sm']) !!}
                                </div>
                                {!! Form::close() !!}
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

            // $('#openactivities-table').DataTable();
            // $('#closedactivities-table').DataTable();
            // $('#notes-table').DataTable();

        });


    </script>
@endpush



