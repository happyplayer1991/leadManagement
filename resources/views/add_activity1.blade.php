<div class="pop-over"  id="add_activity" >
  
 <a  style="color:black!important;cursor: pointer;" class="close_pop_over"><i class="material-icons">close</i></a>
    <div class=""> 

    {!! Form::model($client, [
               'method' => 'POST',
               'url' => ['clients/detail', $client->id],
               'id' => 'activity_form'
               ]) !!}


          <div class="form-group">
            <label for="name" class="control-label">Lead Name:</label> 
            {{$client->name}}
            
          </div>   

         <?php $next_activity = array('Call-First' => 'Call-First','Call-Follow up' => 'Call-Follow up','Meet-Office' => 'Meet-Office','Meet-Site' => 'Meet-Site');?>

                <?php $next_activity = array('Email' => 'Email','Call' => 'Call','Meet' => 'Meet');?>


         <div class="form-group">
            <label for="name" class="control-label">Next Follow Up Activity:</label> 
           
             {!! Form::select('activity', $next_activity, null, ['class' => 'form-input ui search selection top right pointing search-select activity', 'id' => 'search-select']) !!}
          </div>
          <?php $clock = array('1:00'=>'1:00','1:30'=>'1:30','2:00'=>'2:00','2:30'=>'2:30');?>
          <div class="form-group">

            <label for="primary_number" class="control-label">Date:</label>         
            

            {!! Form::date('date', \Carbon\Carbon::now(), ['class' => 'form-input']) !!}
            {!! Form::select('time', $clock, null, ['class' => 'form-input ui search selection search-select  time', 'id' => 'search-select', 'style'=>'display:none']) !!}
          </div>
          
          <div class="form-group">          
           	
          </div>
          <div class="form-group">
            <label for="secondary_number" class="control-label">Details:<font color="red">*</font></label>

          <!--   <input type="textarea" name="details" class="form-control" rows='3' style="width:61%" /> -->
           {!! Form::textarea('details', null, ['class' => 'form-control' , 'rows' => '3']) !!}
          </div>
          <?php $status= array('Scheduled'=>'Scheduled','Completed' =>'Completed');?>
           <div class="form-group">
             <label for="name" class="control-label">Status:</label> 
             {!! Form::select('status', $status, null, ['class' => 'form-input ui search selection search-select  status', 'id' => 'search-select']) !!}

          
          </div>

            <input type="hidden" name="client_id" value="{{$id}}"/>
            {!! Form::close() !!}
            <input type="submit" value="Add Activity" class="btn btn-primary" id="add_lead_activity" style="margin-left: 70%;">
   




            

        
     
    </div>
  

</div>

