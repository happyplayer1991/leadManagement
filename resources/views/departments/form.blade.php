<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div id="create_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Product</h4>
            </div>
            <div class="modal-body">
 
    <div class="form-group">
            
                <label for="customer_name" class="labelTabCreate">Department Name:</label>
                <div class="valcreate">
                    {!! Form::text('name',null,['class' => 'form-control' , 'id' => 'dname']) !!}
                </div>
            
            </div>
        

             <div class="form-group">
            
                <label for="description" class="labelTabCreate">Department description:<font style="color: red">*</font></label>
                <div class="valcreate">
                    
                     {!! Form::textarea('description', null, ['class' => 'form-control' , 'rows' => '5' ,'id' => 'product_description']) !!}
                    <div id="characterLeft"></div>
                </div>
            
            </div>
        <div class="form-group">
              {!! Form::submit($submitButtonText, ['class' => 'btn btn3 btn-primary btn-sm']) !!}
        </div>

</div>
        </div>
    </div>
</div>
   
  