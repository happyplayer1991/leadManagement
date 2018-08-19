
<div class="@if($type == 'edit') col-md-6 @else col-md-12 @endif" >



    <div class="form-group">
        {!! Form::text('name',null,['class' => 'form-control' , 'id' => 'customer_name','placeholder'=>'Lead Name...']) !!}
    </div>
    <div class="form-group">
        {!! Form::text('primary_number',null,['class' => 'form-control' , 'id' => 'mobile_num','placeholder'=>'Mobile Number...']) !!}

    </div>

    <div class="form-group">

        {!! Form::text('email',null,['class' => 'form-control','id'=>'cust_email','placeholder'=>'Email Address...']) !!}

        {!! Form::hidden('id',null,['class' => 'form-control' , 'id' => 'customer_id']) !!}

        @if($type == 'create')

            {!! Form::hidden('user_id',$user->id,['class' => 'form-control' ]) !!}
            {!! Form::hidden('industry_id',$user->id,['class' => 'form-control' ]) !!}
            {!! Form::hidden('company_id',$company_id, ['class' => 'form-control']) !!}

            {!! Form::hidden('lead_status','Lead',['class' => 'form-control']) !!}
        @endif

    </div>
</div>

@if($type == 'edit')
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

        <legend class="text-center">Company Details</legend>
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

        </div> </div>
    <div class="col-md-6">
        <div class="form-group">

            {!! Form::text('number_employee',null,['class' => 'form-control' , 'id' => 'number_employee','placeholder'=>'Number of Employees...']) !!}

        </div>
        <?php $interested_product = array('product1' => 'product1','product2' =>'product2','product3'=>'product3','product4'=>'product4');?>
        <div class="form-group">

            {!! Form::select('interested_product', $products, null, ['class' => 'form-control', 'id' => 'search-select', 'placeholder'=>'Interested Product...']) !!}

        </div>

        

        <div class="form-group">
            <?php $industry_type = array('Accommodations' => 'Accommodations','Accounting' => 'Accounting', 'Advertising' => 'Advertising','Aerospace' => 'Aerospace', 'Agriculture & Agribusiness' => 'Agriculture & Agribusiness' , 'Air Transportation ' => 'Air Transportation ','Apparel & Accessories' => 'Apparel & Accessories', 'Auto ' => 'Auto ', 'Banking '=> 'Banking ','Beauty & Cosmetics'=>'Beauty & Cosmetics','Biotechnology'=> 'Biotechnology' ,'Chemical'=>'Chemical','Communications ' => 'Communications ','Computer'=>'Computer','Construction ' => 'Construction ','Consulting' => 'Consulting' ,'Consumer Products '=>'Consumer Products','Electronics' =>'Electronics','Employment'=>'Employment','Energy'=>'
            Energy','Entertainment & Recreation'=>'Entertainment & Recreation','Education'=>'Education','Fashion'=>'Fashion','Financial Services '=>'Financial Services ','Fine Arts '=>'Fine Arts ','Food & Beverage'=>'Food & Beverage','Green Technology'=>'Green Technology','Health '=>'Health ','Information'=>'Information','Information Technology '=>'Information Technology ','Insurance '=>'Insurance ','Journalism & News'=>'Journalism & News','Legal Services'=>'Legal Services','Manufacturing'=>'Manufacturing','Media & Broadcasting '=>'Media & Broadcasting ','Medical Devices & Supplies'=>'Medical Devices & Supplies','Mining'=>'Mining','Motion Pictures & Video '=>'Motion Pictures & Video ','Music'=>'Music','Pharmaceutical '=>'Pharmaceutical ','Public Administration'=>'Public Administration','Public Relations'=>'Public Relations','Publishing'=>'Publishing','Rail '=>'Rail ','Real Estate'=>'Real Estate','Retail'=>'Retail','Service'=>'Service','Sports'=>'Sports ','Technology '=>'Technology ','Telecommunications'=>'Telecommunications ','Tourism '=>'Tourism ','Transportation'=>'Transportation',
                    'Travel '=>'Travel ','Utilities '=>'Utilities ','Video Game'=>'Video Game','Web Service'=>'Web Service');?>

            {!! Form::select('industry_type', $industry_type, null, ['class' => 'form-control', 'id' => 'search-select','placeholder'=>'Industry Type...']) !!}
        </div>


        <!-- <div class="form-group">
            <label for="country" class="control-label">Fax:</label>

            {!! Form::text('fax',null,['class' => 'form-control' , 'id' => 'industry_type']) !!}

                </div> -->
    </div>
    <div class="col-md-12">

       <legend class="text-center">Lead Details</legend>
    </div>


    <div class="col-md-6">

        <?php $lead_status = array('Lead' => 'Lead','Opportunity' => 'Opportunity', 'Quote' => 'Quote','Won' =>'Won','Drop' => 'Drop');?>

        <div class="form-group">
            {!! Form::select('lead_status', $lead_status, null, ['class' => 'form-control lead_status if', 'id' => 'search-select','placeholder'=>'Lead Status...']) !!}

        </div>
        <?php $reason= array('Lost - Cost High' => 'Lost - Cost High','Lost - Dislike' => 'Lost - Dislike','Lost- Late' => 'Lost- Late','Not the right product' => 'Not the right product','Looking for offers' => 'Looking for offers','Not-Qualifield' => 'Not-Qualifield');?>
        <div class="form-group" id="display_status" style="display:none;">

            {!! Form::select('drop_status', $reason, null, ['class' => 'form-control lead_status if', 'id' => 'search-select','placeholder'=>'Drop Status...']) !!}

        </div>

        <?php $lead_type =array('Hot' =>'Hot','Warm'=>'Warm','Cold' =>'Cold')?>
        <div class="form-group">

            {!! Form::select('lead_type', $lead_type, null, ['class' => 'form-control lead_status', 'id' => 'search-select','placeholder'=>'Lead Type...']) !!}

        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::select('user_id', $users, null, ['class' => 'form-control', 'id' => 'search-select','placeholder'=>'Lead Owner...']) !!}
        </div>
        <?php $lead_source = array('Web' => 'Web','Chat' => 'Chat', 'Phone' => 'Phone' ,'Referal' => 'Referal', 'Blogs' =>'Blogs', 'Social Media' => 'Social Media', 'Events' => 'Events' ,'Advertisements' => 'Advertisements' ,'Manually By Web' => 'Manually By Web');?>

        <div class="form-group">

            {!! Form::select('source_type', $lead_source, null, ['class' => 'form-control', 'id' => 'search-select', 'placeholder'=>'Lead Source..']) !!}

        </div>
        <div class="form-group" id="display_comment" style="display:none;">

            {!! Form::textarea('comment',null, ['class' => 'form-control' , 'rows' => '1' , 'id' => 'comment','placeholder'=>'Comment...']) !!}

        </div>

    </div>

@endif


@if($type == 'create')



    <div class="col-md-12">

        <?php $lead_type =array('Hot' =>'Hot','Warm'=>'Warm','Cold' =>'Cold')?>
        <div class="form-group">
            Lead Type:

            {!! Form::select('lead_type', $lead_type, null, ['class' => 'form-control lead_status ', 'id' => 'search-select', 'style'=>'width:85%;']) !!}

        </div>
    </div>

@endif