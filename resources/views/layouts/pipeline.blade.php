@extends('layouts.master')
@section('heading')
    PipeLine
@stop
@section('content')
    <div class="card">
        <div class="card-content">
            <div class="col-md-12">
                <h5><strong>
                        Activities Pipeline</strong>
                </h5>
                <div class="col-md-3">
                    <div class="text-center" style="font-weight: 600; padding: 14px; ">To do</div>
                    <div class="text-center" style="font-weight: 400; padding: 14px; ">Late</div>
                    <div class="text-center"  style="font-weight: 400; padding: 10px;">Now</div>
                    <div class="text-center" style="font-weight: 400; padding: 7px; ">Ahead</div>
                </div>

                <div class="col-md-3">
                    <div class="card" style="background-color:#4caf50;color: white;margin-top: 0%">
                        <div class="text-center" style=" border-top-right-radius: 6px; border-top-left-radius: 6px; font-weight: 400; padding: 7px;border-bottom: 1px solid lightgrey;background-color: orange">
                            <div>Meetings</div>
                            <div>(inperson&virtual)</div>
                        </div>
                        <div class="text-center" style="border-bottom: 1px solid lightgrey;font-weight: 400; padding: 7px;">
                            {{$meet_late}}
                        </div>
                        <div class="text-center" style="border-bottom: 1px solid lightgrey;font-weight: 400; padding: 7px;">
                            {{$meet_now}}
                        </div>
                        <div class="text-center" style="font-weight: 400;padding: 7px">
                            {{$meet_ahead}}
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card" style="background-color: #4caf50;color: white; margin-top: 0%">
                        <div class="text-center" style=" border-top-right-radius: 6px; border-top-left-radius: 6px; font-weight: 400; padding: 7px; border-bottom: 1px solid lightgrey;background-color: orange">
                            <div>Actions</div>
                            <div>(Calls& Emails)</div>
                        </div>
                        <div class="text-center" style="border-bottom: 1px solid lightgrey;font-weight: 400; padding: 7px;">
                            {{$callemail_late}}
                        </div>
                        <div class="text-center" style="border-bottom: 1px solid lightgrey;font-weight: 400; padding: 7px;">
                            {{$callemail_now}}
                        </div>
                        <div class="text-center" style="border-bottom: 1px solid lightgrey;font-weight: 400; padding: 7px;">
                            {{$callemail_ahead}}
                        </div>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card" style="background-color: #4caf50;color: white; margin-top: 0%">
                        <div class="text-center" style=" border-top-right-radius: 6px; border-top-left-radius: 6px; font-weight: 400;padding: 7px;border-bottom: 1px solid lightgrey; background-color: orange">
                            <div>Completed</div>
                            <div>(To be Closed)</div>
                        </div>
                        <div class="text-center" style="border-bottom: 1px solid lightgrey;font-weight: 400; padding: 7px;">
                            {{$completed_late}}
                        </div>
                        <div class="text-center" style="border-bottom: 1px solid lightgrey; font-weight: 400; padding: 7px;">
                             {{$completed_now}}
                        </div>
                        <div class="text-center" style="border-bottom: 1px solid lightgrey;font-weight: 400; padding: 7px;">
                            {{$completed_ahead}}
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-content">
            <div class="col-md-12">
                <h5><strong>
                        Invoice</strong>
                </h5>
                <div class="col-md-3">
                    <div class="text-center" style="font-weight: 600;padding: 7px;">Performance</div>
                    <div class="text-center" style="font-weight: 400;padding: 7px;">This Month</div>
                    <div class="text-center"  style="font-weight: 400;padding: 7px;">Target</div>
                    <div class="text-center" style="font-weight: 400;padding: 7px; ">Last Month</div>
                </div>

                <div class="col-md-3">
                    <div class="card" style="background-color: lightgrey;color: black;margin-top: 0%">
                        <div class="text-center" style="font-weight: 500; padding: 7px; border-bottom: 1px solid white;">
                            Quotations Submitted
                        </div>
                        <div class="text-center" style="font-weight: 400;border-bottom: 1px solid white; padding: 7px;">
                             @if(Entrust::hasRole('administrator'))
                            {{$submit_this}}   {{$currency}}
                            @else
                            {{$submit_this}}
                            @endif
                              
                        </div>
                        <div class="text-center" style="border-bottom: 1px solid white; font-weight: 400; padding: 7px;">
                             @if(Entrust::hasRole('administrator'))
                          {{$target}}   {{$currency}}  
                           @else
                           {{$target}}
                           @endif
                        </div>
                        <div class="text-center" style="font-weight: 400;padding: 7px;">
                             @if(Entrust::hasRole('administrator'))
                            {{$submit_last}}   {{$currency}}
                             @else
                             {{$submit_last}}
                             @endif
                          
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card" style="background-color: lightgrey;color: black;margin-top: 0%">
                        <div class="text-center" style="font-weight: 500; padding: 7px;border-bottom: 1px solid white;">
                           Quotations Approved
                        </div>
                        <div class="text-center" style="font-weight: 400;border-bottom: 1px solid white; padding: 7px;">
                            @if(Entrust::hasRole('administrator'))
                            {{$approve_this}}   {{$currency}}
                            @else
                            {{$approve_this}}
                            @endif
                         
                        </div>
                        <div class="text-center" style="border-bottom: 1px solid white; font-weight: 400; padding: 7px;">
                            @if(Entrust::hasRole('administrator'))
                            {{$target_approved}}   {{$currency}} 
                            @else
                            {{$target_approved}} 
                            @endif


                         </div>
                        <div class="text-center" style="font-weight: 400; padding: 7px;">
                            @if(Entrust::hasRole('administrator'))
                            {{$approve_last}}   {{$currency}}
                            @else
                            {{$approve_last}}
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card" style="background-color: lightgrey;color: black;margin-top: 0%">
                        <div class="text-center" style="font-weight: 500;padding: 7px;border-bottom: 1px solid white;">
                           Invoices
                        </div>
                        <div class="text-center" style="font-weight: 400;border-bottom: 1px solid white; padding: 7px;">
                            @if(Entrust::hasRole('administrator'))
                            {{$invoice_this}}   {{$currency}}
                            @else
                            {{$invoice_this}}  
                            @endif
                            
                        </div> 
                        <div class="text-center" style="border-bottom: 1px solid white; font-weight: 400; padding: 7px;">
                            @if(Entrust::hasRole('administrator'))
                          {{$target_invoice}}   {{$currency}}
                          @else
                          {{$target_invoice}}
                          @endif
                        </div>
                        <div class="text-center" style="font-weight: 400; padding: 7px;">
                            @if(Entrust::hasRole('administrator'))
                            {{$invoice_last}}   {{$currency}}
                            @else
                            {{$invoice_last}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="card" style="border: 5px solid grey">
        <div class="card-content" >
            <h4><strong>Final Report </strong></h4>
            <div class="card">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <button class="btn btn-success btn-md text-center">Pipeline</button>
                    </div>
                    <div class="col-md-6">
                        <!-- <div class="text-center" style="font-weight: bold; color: green">Activities Analysis</div> -->
                        <div class="text-center" style="font-weight: bold; color: green;margin-top: 4%;">Invoice Analysis</div>
                    </div>
                </div>
            </div>
            <div class="col-md-12" >
                <div class="col-md-2">
                    <div class="text-center" style="margin-bottom: 20px;">Invoice</div>
                </div>
                <div class="col-md-8" >
                    <div class="text-center" style="margin-bottom: 20px;">
                        <div class="progress" style=" margin: 10px;    height: 18px;">
                            <div id="progressbar">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="text-center" style="margin-bottom: 20px;">
                        @if($quote != 0)
                            {{$invoice}}/{{$quote}}
                        @else
                            0/0
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

@stop
@push('scripts')
    <script>
//        $(".progress-bar").loading();

$(function() {
    var quotes = {!! $quote !!};
    var invoices = {!! $invoice !!};
    if(quotes != 0){
        $( "#progressbar" ).progressbar({
            value: ((invoices/quotes)*100)
        });

    }
else{
        $( "#progressbar" ).progressbar({
            value: 0
        });
    }
});
    </script>
@endpush
