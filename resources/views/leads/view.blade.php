@extends('layouts.master')
@section('content')
<!-- <h1>show</h1> -->
<!-- <div class="col-md-4">left</div>
<div class="col-md-8">
  <div class="row">right1</div>
  <div class="row">right2</div>
</div> -->
<div class="contactInfo">
<div class="col-md-4">
<div class="leftpanel">
  <ul>
    <li><a href="#notes" >Notes</a></li>
    <li><a href="#attachements" >Attachements</a></li>
    <li><a href="#openactivities" >Open Activities</a></li>
    <li><a href="#closedactivities" >Close Activities</a></li>
    <li><a href="#quotes" >Quotes</a></li>
    <!-- <li><a href="#Purchase" >Purchase Orders</a></li> -->
    <li><a href="#invoices" >Invoices</a></li>

  </ul>
  
</div>
</div>
<div class="col-md-8 rightpanel contact_info">
  
  <div id="detailview" class="detailview">
    <div class="row">
    <table id="detailtable">
      <td><h2>Name</h2></td>
      <td><button type="button" class="btn btn-success">Send Email</button></td>
      <td id="edit"><button type="button" class="btn btn-default">Edit</button></td>
    </table>
            
      
    </div>
  </div>
  <div id="sticky"></div>
  <div class="row">
    <div class="maininfo">
      
      <table class="mainview">
        
          <tr><td>Contact Owner</td></tr>
          <tr><td>Email</td></tr>
          <tr><td>Phone</td></tr>
          <tr><td>Department</td></tr>
      
      </table>

    </div>
  </div>
  <br><br>
  <div class="row">
    <input type="button" class="btn btn-primary" id="hide" value="Hide Details" />
    
  </div>
  <div id="hid">
  <div class="row">
  <h4>Contact Information</h4><br>
    <div class="col-md-6">
    <table class="table">
      <thead><tr><td>Contact Owner</td> </tr>
      <tr><td>Account Name</td></tr>
      <tr><td>Email</td></tr>
      <tr><td>Phone</td></tr>
      <tr><td>Reports To</td></tr>
      <tr><td>Created By</td></tr>
      <tr><td>Modified By</td></tr>
      </thead>
    </table>
      
    </div>
    
    
    <div class="col-md-6">
      <table class="table contactInforight">
      <thead><tr><td>Lead Source</td></tr>
      <tr><td>Contact Name</td></tr>
      <tr><td>Vendor Name</td></tr>
      <tr><td>Title</td></tr>
      <tr><td>Department</td></tr>
      <tr><td>Email</td></tr>
      <tr><td>Phone</td></tr></thead>
    </table>
    </div>
    
  </div>
  <br><br>
  <div class="row">
  <h4>Address Information</h4><br>
    <div class="address">
      <div class="col-md-6">
      <table class="table contactInforight">
        <thead><tr><td>Mailing Street</td></tr>
        <tr><td>Mailing City</td></tr>
        <tr><td>Mailing State</td></tr>
        <tr><td>Mailing Zip</td></tr>
        <tr><td>Mailing Country</td></tr></thead>
      </table>
    </div>
    </div>
  </div>
  <br><br>
  <div class="row">
    <h4>Description Information</h4><br>
    <label>Description</label>

  </div>
  </div>
  <br/>
  <div class="row">
    <h4>Notes</h4>
    <div id ="notes">
      <div class="form-group">
                <textarea style="min-width: 10%" class="form-control" name="note"></textarea>
                {!! Form::submit( __('Add Note') , ['class' => 'btn btn-primary'],['style'=>'margin-right: 20px;margin-bottom: 20px;'])!!}
      </div>
    </div>
  </div>
  
  <div class="row">
  <h4>Attachments</h4><label style="float: right;" class="btn btn-default" for="my-file-selector">
    <input id="my-file-selector" type="file" style="display:none;color: #2C7BD0;">
    Attach
    </label>
    <div id ="attachements">
      <table class="table">
        <thead class="inv">
          <tr>
            <td>File Name</td>
            <td>Attached by</td>
            <td>Date Added</td>
            <td>Size</td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          
        </tbody>
      </table>
      
    </div>
  </div>
  <div class="row">
  <h4>Open Activities</h4><a style="float: right;text-decoration: none;" class="glyphicon glyphicon-plus link"> New Task</a>&nbsp;<a style="float: right;text-decoration: none;" class="glyphicon glyphicon-plus link"> New Event</a>
    <div id ="openactivities">
      <table class="table">
        <thead class="inv">
          <tr>
            <td>Subject</td>
            <td>Activity Type</td>
            <td>Status</td>
            <td>Due Date</td>
            <td>Activity Owner</td>
            <td>Modified Time</td>
            
          </tr>
        </thead>
        <tbody>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          
        </tbody>
      </table>
    </div>
  </div>
  <div class="row">
  <h4>Closed Activities</h4>
    <div id ="closedactivities">
      <table class="table">
        <thead class="inv">
          <tr>
            <td>Subject</td>
            <td>Activity Type</td>
            <td>Status</td>
            <td>Due Date</td>
            <td>Activity Owner</td>
            <td>Modified Time</td>
            
          </tr>
        </thead>
        <tbody>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          
        </tbody>
      </table>
    </div>
  </div>
  <div class="row">
  <h4>Quotes</h4><a style="float: right;text-decoration: none;" class="glyphicon glyphicon-plus line"> New</a>
    <div id ="quotes">
      <table class="table">
        <thead class="inv">
          <tr>
            <td>Subject</td>
            <td>Quote Stage</td>
            <td>Valid Until</td>
            <td>Carrier</td>
            
          </tr>
        </thead>
        <!-- <tbody>
          <tr>
            <td>sfsfs</td>
            <td>created</td>
            <td>Jun 29, 2017</td>
            <td>fedx</td>
          </tr>
          
        </tbody> -->
      </table>
    </div>
  </div>
  <div class="row">
  <h4>Invoices</h4><a style="float: right;text-decoration: none;" class="glyphicon glyphicon-plus line"> New</a>
    <div id ="invoices">
      <table class="table">
        <thead class="inv">
          <tr>
            <td>Subject</td>
            <td>Status</td>
            <td>Invoice Date</td>
            <td>Due Date</td>
            <td>VAT</td>
            <td>Sales Commission</td>
          </tr>
        </thead>
        <!-- <tbody>
          <tr>
            <td>sfsfs</td>
            <td>created</td>
            <td>Jun 29, 2017</td>
            <td></td>
            <td>$232.00</td>
            <td>$12.00</td>
            
          </tr>
          
        </tbody> -->
      </table>
    </div>
  </div>




</div>
</div>
@stop






























