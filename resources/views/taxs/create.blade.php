<div id="create_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Tax</h4>
            </div>
            <div class="modal-body">
{!! Form::open([
            'route' => 'taxs.store',
            'class' => 'ui-form',
            'id' => 'submit_form'
            ]) !!}
                <div class="form-group">
                    <label class="control-label">Name<font color="red">*</font></label>
                    <input type="text" class="form-control" name="tax_name" id="taxname">
                </div>
                <div class="form-group">
                    <label class="control-label">Rate(%)<font color="red">*</font></label>
                    <input type="number" class="form-control" name="rate" id="taxrate" min="0">
                </div>
                <div class="form-group">
                    <label class="control-label">Description</label>
                    <textarea type="text" class="form-control" name="description">
                    </textarea>
                </div>
                 <div class="form-group form-button">
                    <button type="submit" class="btn btn-fill btn-success">Save</button>
                </div>

{!! Form::close() !!}
                </div>
        </div>
    </div>
</div>