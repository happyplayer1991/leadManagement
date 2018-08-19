@extends('layouts.master')
@section('heading')
    Product And Lead Interest
@stop

@section('content')


    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col-md-12">
                    @foreach($view as $v)
                        <div class="col-md-4 ">
                            <div class="card ">
                                <div class="card-content text-center">
                                    <h3 style="margin-top: -5%;" > <a href=''>
                                            <div class="cardtitle">{{$v->product_name}}</div></a></h3>
                                    <div class="task">
                                        <div class="leadinfo lead">
                                            <div class="row leadinfoline">
                                                @if($v->description == '')
                                                @else
                                                <div class="key pull-left">Description</div>
                                                {{--<span>{{$v->description}}</span>--}}

                                                <p class="value pull-left"  style="  width:70%; white-space: nowrap;  overflow: hidden;text-overflow: ellipsis;" >
                                                    {{$v->description}}   </p>

                                                <a class="pull-left" href=""style="margin: -4% 0 4% 0;font-size: 13px;
    color: blue;"><button type="button" class="morebtn btn btn-xs btn-info" data-toggle="tooltip" title=" {{$v->description}}" data-placement="top" >More...</button></a>
                                                {{--<button type="button" class="btn btn-sm btn-primary" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?">Click to toggle popover</button>--}}
                                                @endif
                                            </div>

                                            <div class="row leadinfoline">
                                            
                                                <div class="col-sm-12">
                                                    @foreach($ld as $lds)
                                                        @if($lds->id == $v->id)
                                                            <a onclick="leadCount({{$v->id}},this)"><div class="col-sm-4" style="color: orangered; cursor: pointer;" >
                                                            <p style="font-size: 17px; ">Leads</p>
                                                            <span>{{$lds->ltotal}}</span>
                                                            </div></a>
                                                        @endif
                                                    @endforeach
                                                    @foreach($qt as $qts)
                                                        @if($qts->id == $v->id)
                                                            <a onclick="quoteCount({{$v->id}},this)"><div class="col-sm-4" style="color:blue; cursor: pointer;">
                                                            <p style="font-size: 17px">Quotes</p>
                                                            <span>{{$qts->qtotal}}</span>
                                                            </div></a>
                                                        @endif
                                                    @endforeach
                                                    @foreach($in as $ins)
                                                        @if($ins->id == $v->id)
                                                            <a onclick="invoiceCount({{$v->id}},this)"><div class="col-sm-4" style="color: green; cursor: pointer;">
                                                            <p style="font-size: 17px">Invoices</p>
                                                            <span>{{$ins->itotal}}</span>
                                                             </div></a>
                                                        @endif
                                                    @endforeach
                                                </div>
                                               

                                                    {{--<div class="key pull-left"><a href="leads/{{$lead->lead_id}}">{{$lead->name}} &nbsp;</a> <span style="color: black;">|</span>--}}
                                                    {{--<a href="quotations/{{$lead->quote_id}}">&nbsp; QU{{$lead->quotation_number}} &nbsp;</a><span style="color: black;">| &nbsp;--}}
                                                    {{--<time class="timeago" datetime="2018-02-02T09:24:17Z"></time></span> </div>--}}

                                                

                                                    {{--<div class="value pull-left">--}}
                                                    {{--</div>--}}

                                            </div>
                                            {{--<div class="pull-right" >--}}
                                            {{--<button type="button" class="btn btn-success btn-sm" onclick="more">More</button>--}}
                                            {{--</div>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>



@stop