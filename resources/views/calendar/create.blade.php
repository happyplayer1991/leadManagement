
<div id="create_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Activity</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('activities.store')}}" id="submit_form" class="activity_form">

                        {{--<div class="form-group">--}}
                        {{--<select class="selectpicker form-control activities" data-live-search="true" data-style="select-with-transition" name ="lead_id" title="Lead Name" >--}}
                        {{--<option>Select Lead....</option>--}}
                        {{--@foreach($clients as $c)--}}
                        {{--<option value="{{$c->id}}">{{$c->name}}</option>--}}
                        {{--@endforeach--}}
                        {{--</select>--}}

                        {{--</div>--}}

                        <div class="">
                            <div class="form-group">
                                <label for="name" class="">Lead Name:</label>
                                {{--<select class="form-control selectpicker activities" placeholder="" data-live-search="true" name="lead_id">--}}
                                <select name="lead_id" class="activities form-control" placeholder="Lead Name..." id="leadname1">
                                    <option>Select Lead....</option>
                                    @foreach($clients as $c)
                                        <option value="{{$c->id}}">{{$c->name}}&nbsp;({{$c->lead_number}})</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        {{--<div class="">--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="number" class="">Lead Number:</label>--}}
                                {{--<select  class="activities form-control" data-live-search="true" placeholder="Lead Number..." >--}}

                                    {{--@foreach($clients as $c)--}}
                                        {{--<option value="{{$c->id}}" data-leadName="{{$c->name}}">{{$c->lead_number}}</option>--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                    <div class="">
                        <div class="form-group">
                            <label for="name" class="">Activity Type:</label>
                            <div class="">

	            <span>
                    <select name="activity" class="activities form-control" placeholder="Activity Type..." id="activitytype">
                                    <option hidden="true">Select Activity....</option>
                                    <option value="Email">Email</option>
                                    <option value="Call">Call</option>
                                    <option value="Meet">Meet</option>
                                </select>
	            </span>
                            </div>
                        </div>
                    </div>



                    <div class="">
                        <?php $status= array('Scheduled'=>'Scheduled');?>

                        <div class="form-group">

                            <label for="name" class="">Status:</label>
                            <div class="">
                <span>
            {!! Form::select('status', $status, null, ['class' => 'form-control  status']) !!}
                </span></div></div>
                    </div>
                    <div class="">
                        <?php $clock = array('00:00'=>'00:00','00:30'=>'00:30','01:00'=>'01:00','01:30'=>'01:30','02:00'=>'02:00','02:30'=>'02:30','03:00'=>'03:00','03:30'=>'03:30','04:00'=>'04:00','04:30'=>'04:30','05:00'=>'05:00','05:30'=>'05:30','06:00'=>'06:00','06:30'=>'06:30','07:00'=>'07:00','07:30'=>'07:30','08:00'=>'08:00','08:30'=>'08:30','09:00'=>'09:00','09:30'=>'09:30','10:00'=>'10:00','10:30'=>'10:30','11:00'=>'11:00','11:30'=>'11:30','12:00'=>'12:00','12:30'=>'12:30','13:00'=>'13:00','13:30'=>'13:30','14:00'=>'14:00','14:30'=>'14:30','15:00'=>'15:00','15:30'=>'15:30','16:00'=>'16:00','16:30'=>'16:30','17:00'=>'17:00','17:30'=>'17:30','18:00'=>'18:00','18:30'=>'18:30','19:00'=>'19:00','19:30'=>'19:30','20:00'=>'20:00','20:30'=>'20:30','21:00'=>'21:00','21:30'=>'21:30','22:00'=>'22:00','22:30'=>'22:30','23:00'=>'23:00','23:30'=>'23:30','24:00'=>'24:00');?>
                        <div class="form-group">
                            <label for="primary_number" class="">Date:</label>
                            <div class="">
                  <span>
                    <!-- <input type="text" name="date" value="{{$date}}"> -->
            {!! Form::date('date', $date, ['class' => 'form-control']) !!}
                      </span></div></div>
                        <div class="form-group" id="clock">
                            <label for="primary_number" class="time" >Time:</label>
                            <div class="">
                  <span>
                      {!! Form::select('time', $clock, null, ['class' => 'form-control ui search selection search-select  time']) !!}
                  </span></div></div>
                    </div>

                    <div class="form-group">
                    </div>
                    <div class="form-group " >
                        <label for="secondary_number" class="">Details:<font color="red">*</font></label>

                        <input type="input" name="details" rows='3' class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" style="width:100%">

                        {{--<input type="textarea" name="details" class="form-control " rows='3'  style="width:100%" />--}}

                        {{--{!! Form::textarea('details', null, ['class' => 'form-control' , 'rows' => '3','id'=>'tags']) !!}--}}
                    </div>

                    <div class="form-group">

                        {{Form::checkbox('remainder',1,null,['placeholder' => 'Remainder','id' =>'remainder','class' =>'remainder form-control','title'=>'Remainder','style'=>'width: 3%;'])}}
                        <label for="remainder" class="checkbox" style="margin-top: -5%;margin-left: 5%;" >Please remind me 30 mins ahead of this activity</label>



                    </div>


                    <input type="submit" value="Add Activity" class="btn btn-primary"  style="margin-left: 70%;">
                </form>
            </div>
            <div class="modal-footer">



            </div>

        </div>
    </div>
</div>

<script>
//    $(document).ready(function(){
//        // Defining the local dataset
//        var cars = ['Skype Call to know more about our products/Services', 'Conference Call to know more about our products/Services', 'Call to discuss about pricing',
//            'Skype Call for Product Demo', 'Web Conference for Product Demo', 'Customer asked to call again later', ' In-person meeting for demo/presentation',
//            'In-person meeting to understand more about our products and services', 'In-Person meeting to discuss pricing', 'Share product brochure','Share services brochure',
//            'Share conference call details','Share demo details','Share pricing details','Share NDA Document','Followup on NDA', 'Share Contract Signup Initiation Documents',
//            'Followup on Contract Signup','Lead requests for Product Pricing Negotiation', 'Followup on Product Pricing', 'Share Product Details to the lead','Share a Presentation/Demonstration to the lead',
//            'Share Offered Product Details', 'Share Services Details', 'Followup on Services Request', 'Share Services Customization Package details','Share Offered Services Details',
//            'Share Product Customization details','Followup on Product Customization ','Share Services Pricing Details','Lead requested for Services Pricing Negotiation','Lead requested for Site-Visit',
//            'Share Final Agreement Copy with the Lead','Followup on the Final Agreement Copy','Followup of NDA signed documents','Share Demo MoM and actions','Followup of Demo actions',
//            'Complete Vendor Agreement documents','Complete References documents'];
//
//        // Constructing the suggestion engine
////        var cars = new Bloodhound({
////            datumTokenizer: Bloodhound.tokenizers.whitespace,
////            queryTokenizer: Bloodhound.tokenizers.whitespace,
////            local: cars
////        });
//
//        // Initializing the typeahead
//        $('.typeahead').typeahead({
//                hint: true,
//                highlight: true, /* Enable substring highlighting */
//                minLength: 1 /* Specify minimum characters required for showing result */
//            },
//            {
//                name: 'cars',
//                source: cars
//            });
//    });
   $('#activitytype').on('change',function(){
           var selection = $(this).val();
           switch(selection){
               case "Call":
                   $("#clock").show()
                   break;
               case "Meet":
                   $("#clock").show()
                   break;
           default:
               $("#clock").hide()
   }
});
</script>


