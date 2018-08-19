<div class="modal fade" id="justModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        {!! Form::open([
        'route' => ['invoice.emailAddress',$invoices->id],
        'class' => 'ui-form',
        'id'    =>  'inv_form'
        ]) !!}
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><strong>Email</strong></h4>
        </div>
        <div class="modal-body">
          <div class=col-md-12>

          <label> To</label>
            <input type="text" id="emailInvoice" class="form-control" name="emailInvoice" placeholder="Enter emails seperate with ,(comma)">
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
<!--   <script type="text/javascript">
    document.getElementById("myButton").onclick = function () {
        location.href = "/invoices";
    };
</script> -->