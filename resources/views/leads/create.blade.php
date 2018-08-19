

<div id="create_modal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<legend class="modal-title text-center">Lead Details</legend>
			</div>
			<div class="modal-body">

			<form action="{{route('leads.store')}}" method="post" id="submit_form" >
    		@include('leads.form', ['submitButtonText' => __('Create New Lead'),'submitButton'=>__('Cancel')])

    		<input type="submit" value="Create New Lead" class="btn btn-primary" id="add_lead"
     				style="margin-left: 70%;"/>


    		</form>

			</div>
     				


		</div>
	</div>
</div>