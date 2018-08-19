<div id="client_drop_modal" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Drop Lead</h4>
			</div>
			<div class="modal-body">
				
				<?php $reason= array('Lost - Cost High' => 'Lost - Cost High','Lost - Dislike' => 'Lost - Dislike','Lost- Late' => 'Lost- Late','Not the right product' => 'Not the right product','Looking for offers' => 'Looking for offers','Not-Qualifield' => 'Not-Qualifield');?>
       
		    <form id="status_form">
				<div class="">
					<div class="form-group">
						<label for="name" class=""style="float: left;width: 30%;">Lead Number:</label>
						<div class="">
							<span>LDoo1</span></div></div>
				</div>
		        <div class="">
		    	<div class="form-group">
		            <label for="name" class=""style="float: left;width: 30%;">Lead Name:</label>
		            <div class="">
		                <span>{{$client_name->name}}</span></div></div>
		          </div>
		        <div class="">
		        <div class="form-group">
		            <label for="name" class=""style="float: left;width: 30%;">Reason:</label>
		            <div class="">
		                <span>
		            {!! Form::select('status', $reason, null, ['class' => 'form-input ui search selection search-select  reason', 'id' => 'search-select']) !!}
		                </span></div></div>
		          </div>
		        <div class="">
		          <div class="form-group">
		            <label for="primary_number" class=""style="float: left;width: 30%;">Comment: <font color="red">*</font></label>
		              <div class="">
		                <span>
		            {!! Form::textarea('comment',null, ['class' => 'form-control' , 'rows' => '2' , 'id' => 'remarks']) !!}
		            {!! Form::hidden('id',$id,['class' => 'form-control' , 'id' => 'customer_id']) !!}
		                </span></div></div>
		          </div>
		    </form>
			</div>
           <input type="submit" value="Drop Lead" class="btn btn-primary" id="drop_lead"style="margin-left: 70%;">
					

		</div>
	</div>
</div>










