@extends('layouts.master')

@section('heading')
    <h1>{{ __('viewing Sample Code') }}</h1>
    <br/>
@stop


@section('content')


<div class="col-md-8">
    <div class="row">
   

        <div class="col-md-4 form-group" align="left">

        <label>Sample code:</label>{{$samples->samplecode}}
     
        </div>
        <div class="col-md-4" align="right">

	<a href="{{ route('samples.edit', $samples['id']) }}" id="element1">Edit {{$samples->samplecode}} </a>
</div>
    </div>

     <?php 
        $item = unserialize($samples->itemcode);

        $c = count($item); 
    ?>
   
    	<br/><br/><br/><br/><br/>
    	
		  <h3>Item Code Table</h3>
		  <div class="table-responsive"> 
		  <table class="table table-bordered">

		    <thead>
		      <tr>
		        <th>Item</th>
		        <th>Make</th>
		        <th>Quantity</th>
		        <th>UOM</th>
		      </tr>
		    </thead>
		    <tbody>

		    <?php 
		    
		    for ($i=0; $i < $c; $i++) { ?>
		      <tr>
		        <td>{{$item[$i][0]}}</td>
		        <td>{{$item[$i][1]}}</td>
		        <td>{{$item[$i][2]}}</td>
		        <td>{{$item[$i][3]}}</td>
		      </tr>
		      
		     <?php } ?>
		    </tbody>
		  </table>
		  </div>
		
		<br/>

		<?php 
        $item = unserialize($samples->itemcodecolor);

        $c = count($item); 
        ?>

		<div class="table-responsive"> 
		  <table class="table table-bordered">
		    <thead>
		      <tr>
		        <th>Color</th>
		        <th>Make</th>
		        <th>Quantity</th>
		        <th>UOM</th>
		      </tr>
		    </thead>
		    <tbody>
		    <?php for ($i=0; $i < $c; $i++) { ?>
		      <tr>
		        <td>{{$item[$i][0]}}</td>
		        <td>{{$item[$i][1]}}</td>
		        <td>{{$item[$i][2]}}</td>
		        <td>{{$item[$i][3]}}</td>
		      </tr>
		      
		     <?php } ?>
		    </tbody>
		  </table>
		  </div>
		

		
			
		<div class="row">
			<h3>Color Wash Code Table</h3><br/>
	        <?php 
	        $color = unserialize($samples->colorcode);
	        
	         ?>
	        <div class="col-md-3">
	            <b>Make:  </b> {{$color[0][0]}}&nbsp;&nbsp;<b>ml</b>
	        </div>
	        <div class="col-md-3">
	            <b>Quantity:  </b> {{$color[0][1]}}&nbsp;&nbsp;<b>ml</b>
	        </div>

	        <div class="col-md-3">
	            <b>Water:  </b> {{$color[0][2]}}&nbsp;&nbsp;<b>ml</b>
	        </div>
	        
       </div>
       <br/>
       <!-- wash code color -->
       <?php 
        $item = unserialize($samples->colorcodecolor);

        $c = count($item); 
        ?>
        <div class="table-responsive"> 
		  <table class="table table-bordered">
		    <thead>
		      <tr>
		        <th>Color</th>
		        <th>Make</th>
		        <th>Quantity</th>
		        <th>UOM</th>
		      </tr>
		    </thead>
		    <tbody>
		    <?php for ($i=0; $i < $c; $i++) { ?>
		      <tr>
		        <td>{{$item[$i][0]}}</td>
		        <td>{{$item[$i][1]}}</td>
		        <td>{{$item[$i][2]}}</td>
		        <td>{{$item[$i][3]}}</td>
		      </tr>
		      
		     <?php } ?>
		    </tbody>
		  </table>
		 </div>
		
		<br/>

		<div class="row">
			{{ Form::label('briefdescription', __('Brief description: '), ['class' => 'control-label']) }}
			{{$samples->briefdescription}}
		</div>

</div>

<div class="col-md-4">
	
	<label>Sample Image</label>
        
        <div id="thumb-output">
            <!-- <img src="/images/Media/{{ $samples->image_path }}" style="width:150px; height:150px; float:bottom; border-radius:50%; margin-right:25px;"> -->

            <img width="150px" height="150px" 
          @if($samples->image_path != "")
          src="/images/Media/{{$samples->image_path}}"
          @else
          src="/images/no_image_found.png"
          @endif />
        </div>
</div>

@stop