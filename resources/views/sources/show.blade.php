@extends('layouts.master')

@section('heading')
<h1>{{ __('Viewing Source') }}</h1>

@stop


@section('content')


<div class="container">
	<div class="col-md-6">
		
		<div class="tabDivCreate">
            <div class="labelTabCreate">Name</div>
            <div class="valcreate">
                {{$sources->name}}
            </div>
            
        </div>
        <div class="tabDivCreate">
            <div class="labelTabCreate">Email</div>
            <div class="valcreate">
                {{$sources->email}}
            </div>
            
        </div>
        
        <div class="tabDivCreate">
            <div class="labelTabCreate">Phone Number</div>
            <div class="valcreate">
                {{$sources->phone_number}}
            </div>
            
        </div>
        <div class="tabDivCreate">
        	<?php $source_type = array('Facebook','Google','Architect','Friend','PMC','Builder','Interior Designer','Magazine','Expo','LinkedIn','Twitter','Instagram','Other'); ?>

            <div class="labelTabCreate">Types</div>
            <div class="valcreate">
            	<?php if($sources->types == '12'){ ?>
            	    {{$sources->others}}
                <?php } else { ?>
                 {{$source_type[$sources->types]}} <?php } ?>
            </div>
            
        </div>
        <div class="tabDivCreate">
            <div class="labelTabCreate">Remarks</div>
            <div class="valcreate">
                {{$sources->remarks}}
            </div>
            
        </div>
	</div>
</div>
@endsection