<div id="client_edit_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <legend class="modal-title text-center">Edit <span>Prashanthi</span>-<span>LD001</span> </legend>
            </div>
            <div class="modal-body">
                {!! Form::model($client, [
                          'method' => 'PATCH',
                          'route' => ['clients.update', $client->id],
                          'id'    =>  'lead_edit_form',
                          'data_client_id'    => $client->id
                          ]) !!}

                @include('clients.form', ['submitButtonText' => __('Update Lead'),'submitButton'=>__('Cancel')])



                {!! Form::close() !!}
            </div>
            <input type="submit" value="Update Lead" class=" btn btn-primary " id="edit_lead" style="    margin-left: 70%;">

    </div>
</div>








