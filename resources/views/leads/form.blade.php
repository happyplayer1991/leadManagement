<div class="@if(isset($type) && $type == 'edit') col-md-6 @else col-md-12 @endif" >
    <div class="form-group">
        {!! Form::text('name',null,['class' => 'form-control' , 'id' => 'customer_name','placeholder'=>'Lead Name...']) !!}
    </div>

    <div class="form-group">
        {!! Form::text('primary_number',null,['class' => 'form-control' , 'id' => 'mobile_num','placeholder'=>'Mobile Number...']) !!}
    </div>

    <div class="form-group">
        {!! Form::text('email',null,['class' => 'form-control','id'=>'cust_email','placeholder'=>'Email Address...']) !!}
        {!! Form::hidden('id',null,['class' => 'form-control' , 'id' => 'customer_id']) !!}
    </div>
</div>

@if(isset($type) && $type == 'edit')
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::text('address',null,['class' => 'form-control' , 'id' => 'adress','placeholder'=>'Address...']) !!}
        </div>

        <div class="form-group">
            {!! Form::text('country',null,['class' => 'form-control' , 'id' => 'country', 'placeholder'=>'Country...']) !!}
        </div>

        <div class="form-group">
            {!! Form::text('pin',null,['class' => 'form-control' , 'id' => 'pin','placeholder'=>'Pin...']) !!}
        </div>
    </div>

    <div class="col-md-12">
        <legend class="text-center" style=" margin-top: 4%;">Company Details</legend>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::text('company_name',null,['class' => 'form-control' , 'id' => 'company_name','placeholder'=>'Company Name...']) !!}
        </div>
        <div class="form-group">
            {!! Form::text('company_website',null,['class' => 'form-control' , 'id' => 'company_website','placeholder'=>'Company Website...']) !!}
        </div>
        <div class="form-group">
            {!! Form::text('annual_revenue',null,['class' => 'form-control' , 'id' => 'annual_revenue','placeholder'=>'Annual Revenue...']) !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::text('number_employee',null,['class' => 'form-control' , 'id' => 'number_employee','placeholder'=>'Number of Employees...']) !!}
        </div>
        <div class="form-group">
            {!! Form::select('interested_product', $products, null, ['class' => 'form-control' , 'id' => 'search-select', 'placeholder'=>'Interested Product...']) !!}
        </div>
        <div class="form-group">
            {!! Form::select('industry_type', $industries, null, ['class' => 'form-control', 'id' => 'search-select', 'placeholder'=>'Industry Type...']) !!}
        </div>
    </div>

    <div class="col-md-12">
       <legend class="text-center" style=" margin-top: 4%;">Lead Details</legend>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            @if($leads->lead_stage == 'Lead')
                <select class="form-control" id="lead_stage" name="lead_stage">
                    <option value="Lead">Lead</option>
                    <option value="Opportunity">Opportunity</option>
                </select>
            @elseif($leads->lead_stage == 'Opportunity')
                <select class="form-control" id="lead_stage" name="lead_stage">
                    <option value="Opportunity">Opportunity</option>
                    <option value="Quote" onchange="">Quote</option>
                </select>
            @elseif($leads->lead_stage == 'Quote')
                <select class="form-control" id="lead_stage" name="lead_stage">
                    <option value="Quote">Quote</option>
                    <option value="Won" onchange="">Won</option>
                </select>
            @elseif($leads->lead_stage == 'Won')
                <input type="text" name="lead_stage" value="Won" class="form-control" id="lead_stage" readonly="true" />
            @endif
            <!-- {!! Form::select('lead_stage', $leadstatus, null, ['class' => 'form-control lead_status if', 'id' => 'search-select','placeholder'=>'Lead Status...']) !!} 'onchange'=> "activity_status('$getAll->id',this,'details')"-->
        </div>
       
        <div class="form-group" id="display_status" style="display:none;">
            {!! Form::select('drop_status', $dropstatus, null, ['class' => 'form-control lead_status if', 'id' => 'search-select','placeholder'=>'Drop Status...']) !!}
        </div>

       
        <div class="form-group">
            {!! Form::select('lead_type', $leadtype, null, ['class' => 'form-control lead_status', 'id' => 'search-select','placeholder'=>'Lead Type...']) !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::select('user_id', $users, null, ['class' => 'form-control', 'id' => 'search-select','placeholder'=>'Lead Owner...']) !!}
        </div>

        <div class="form-group">
            {!! Form::select('source_id', $leadsource, null, ['class' => 'form-control', 'id' => 'search-select', 'placeholder'=>'Lead Source..']) !!}
        </div>

        <div class="form-group" id="display_comment" style="display:none;">
            {!! Form::textarea('comment',null, ['class' => 'form-control' , 'rows' => '1' , 'id' => 'comment','placeholder'=>'Comment...']) !!}
        </div>

        <input type="hidden" value="{{Request::path()}}" name="lead_url" />
    </div>
@endif


@if(!isset($type) || $type == 'create')
    <div class="col-md-12">
        <div class="form-group">
            Lead Type:
            {!! Form::select('lead_type', array('Hot' =>'Hot','Warm'=>'Warm','Cold' =>'Cold'), null, ['class' => 'form-control lead_status ', 'id' => 'search-select', 'style'=>'width:85%;']) !!}
        </div>
    </div>
@endif