<div id="client_create_modal" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<legend class="modal-title text-center">Lead Details</legend>
			</div>
			<div class="modal-body">

					{!! Form::open([
            'route' => 'clients.store',
            'class' => 'ui-form',
            'id'    =>  'lead_form'
            ]) !!}
    		@include('clients.form', ['submitButtonText' => __('Create New Lead'),'submitButton'=>__('Cancel')])


    {!! Form::close() !!}
			</div>
     				<input type="submit" value="Create New Lead" class="btn btn-primary" id="add_lead"style="margin-left: 70%;">


		</div>
	</div>
</div>