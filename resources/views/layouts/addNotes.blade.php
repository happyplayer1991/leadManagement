<div class="modal fade" id="newModel" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
                {!! Form::open([
                'route' => 'notes.store',
                'class' => 'ui-form',
                'id'    =>  'notes_form'
                ]) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><strong>Add Notes</strong></h4>
                </div>
                <div class="modal-body">

                    <div class="modal-footer">

                        <div class="form-group" style="width: 100%">
                            {!! Form::textarea('note', null, ['class' => 'form-control', 'style'=>' border: 2px solid lightgrey; border-bottom: none;']) !!}
                            {!! Form::hidden('status', 'Lead', ['class' => 'form-control']) !!}
                            {!! Form::hidden('lead_id', $lead->id, ['class' => 'form-control']) !!}
                            {!! Form::hidden('company_id', $lead->company_id, ['class' => 'form-control']) !!}
                        </div>
                        <div class="pull-right">
                            {!! Form::submit( __('Add Note') , ['class' => 'btn btn-primary btn-sm']) !!}
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
        </div>
    </div>
</div>