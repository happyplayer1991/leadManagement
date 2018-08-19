<?php foreach ($scrollText as $scroll) {} ?>
@if(count($scrollText)>0)
    <marquee behaviour="scroll" direction="left" style="background-color: #4096ec;;color: white;font-weight: bold;height: 35px;
     padding-top: 7px; width: 70%; margin-left: 25%;  border-radius: 25px;">{{$scroll->announcement}}</marquee>
@endif
@extends('layouts.master')
@section('heading')
    Dashboard
@endsection
@section('content')
    <div class="col-sm-12 col-md-12 col-lg-12" style="margin-top: -3%">
        <div class="" >

        @if(Auth::id() == 1)
            <div class="pull-left">
                <p>Your account is about to expire. For renew Please Click<a id="paypalbutton" style="cursor: pointer; text-decoration: underline;">&nbsp;here</a></p></div>

        @endif

        </div>
    </div>

<form action="{{url('leads/create')}}" method="get" id="modal_fade" >
    <div class="pull-right">
        <input type="submit" class="btn btn-primary" value="New Lead" >
    </div>
</form>

    <div id="ajaxContent">
        @include('pages.cardview')

    </div>


@endsection
@push('scripts')
    <script>
        
        (function () {
            lmdd.set(document.getElementById('handle-example'), {
                containerClass: 'handle-grid',
                 draggableItemClass: 'handle-item',
                 handleClass:'handle',
                 //dataMode:true
            });

            document.getElementById('handle-example').addEventListener("lmddend",function (e) {
                var fromContainer = $(e.detail.from.container);
                var toContainer = $(e.detail.to.container);
                var draggedElement = $(e.detail.draggedElement);
                 console.log(draggedElement.attr('data-id'));
                // console.log(leads.hasClass('leads'));
                // console.log(opportunity.find('.handle-item').attr('data-id'));

                if(fromContainer.hasClass('leads')){
                        var id = draggedElement.attr('data-id');
                    if(toContainer.hasClass('opportunity')){
                        console.log('opportunity');
                        dragToOpportunity(id,'Opportunity');
                    }
                    // else{
                    //     console.log('else');
                    //     dragToQuote(id,'Quote');
                    // }

                }else if(fromContainer.hasClass('opportunity')){
                     var id = draggedElement.attr('data-id');
                    if(toContainer.hasClass('quote')){
                        dragToQuote(id,'Quote');
                    }
                    // else if(toContainer.hasClass('won')){
                    //     dragToQuote(id,'Quote');
                        
                    // }
                }else if(fromContainer.hasClass('quote')){
                    var id = draggedElement.attr('data-id');
                    if(toContainer.hasClass('won')){
                        dragToWon(id,'Won');
                    }
                }
                // console.log("heloo...");


            })
        })();
              

    </script>

@endpush