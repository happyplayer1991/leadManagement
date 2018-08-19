<div class="modal fade" id="justModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            {!! Form::open([
            'method'=>'post',
            'route' => 'sms',
            'class' => 'ui-form',
            'id'    =>  'email_form'
            ]) !!}
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><strong>Email</strong></h4>
                </div>
                <div class="modal-body">
                    <div class=col-md-12>

                        <label> To</label>
                        <input type="text" id="smsLead" value="{{$lead->email}}" class="form-control" name="sendSms" placeholder="Enter phone numbers seperate with ,(comma)">

                        <label> Mail Body</label>
                        <textarea type="text" id="smsInfo" class="form-control" name="smsText" placeholder="Please enter mail body"></textarea>

                    </div>
                    <div class="modal-footer">
                        <input type="submit" value="Send" class="btn btn-primary"  style="margin-left: 50%;">
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>