<div id="create_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

     

        <!-- Modal content-->
        <div class="modal-content">
        {!! Form::model($leads, [
                          'method' => 'PATCH',
                          'route' => ['leads.update',$leads->id], 
                          'id' => 'submit_form',
                          'data_client_id'    => $leads->id
                          ]) !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <legend class="modal-title text-center">{{$leads->name}}({{$leads->lead_number}})</legend>
            </div>
            <div class="modal-body">
               

                @include('leads.form', ['submitButtonText' => __('Update Lead'),'submitButton'=>__('Cancel')])


            </div>
            <input type="submit" value="Update Lead" class=" btn btn-primary "  style="margin-left: 70%;">
             {!! Form::close() !!}    
        
          
            
            </div>
    </div>
</div>