<div class="container">
  
    <div class="col-md-6">

        <!-- <div class="contHeadInfo">Create Source</div> -->
        <div class="tabDivCreate">
            
            <label for="customer_name" class="labelTabCreate">Name:</label>
            <div class="valcreate">
                {!! Form::text('name',null,['class' => 'form-input' , 'id' => 'sname']) !!}
            </div>
            
        </div>
        <div class="tabDivCreate">
            
            <label for="email" class="labelTabCreate">Email:</label>
            <div class="valcreate">
                {!! Form::text('email',null,['class' => 'form-input' , 'id' => 'semail']) !!}
                
            </div>
            
        </div>
        <div class="tabDivCreate">
            
            <label for="secondary_mobile" class="labelTabCreate">Phone Number:</label>
            <div class="valcreate">
                {!! Form::text('phone_number',null,['class' => 'form-input' , 'id' => 'phone_number']) !!}
                
            </div>
            
        </div>
   
        <div class="tabDivCreate">
            <?php $source_type = array('Facebook','Google','Architect','Friend','PMC','Builder','Interior Designer','Magazine','Expo','LinkedIn','Twitter','Instagram','Other'); ?>
            
            <label for="source_type" class="labelTabCreate">Types:</label>
            <div class="valcreate">
                {!! Form::select('types', $source_type, null, ['class' => 'form-input ui search selection top right pointing search-select  source_type', 'id' => 'search-select']) !!}
                
            </div>
            
        </div>
        <div class="tabDivCreate others" style="display: none;">
            @if($type == 'create')
                <label for="others" class="labelTabCreate">Other:</label>
                <div class="valcreate" id="other">
                    {!! Form::text('others',null,['class' => 'form-input' , 'id' => 'others']) !!}
                </div>

            @endif
            @if($type == 'edit')
                <?php $options = $source->types; ?>
                    @if($options!="12")
                        <label for="others" class="labelTabCreate">Other:</label>

                        <div class="valcreate" id="other">
                            {!! Form::text('others',null,['class' => 'form-input' , 'id' => 'others']) !!}
                        </div>
                    @endif
            @endif
        </div>

         <div class="tabDivCreate others" >
            @if($type == 'edit')
                <?php $options = $source->types; ?>
                @if($options=="12")
                    <label for="others" class="labelTabCreate">Other:</label>
                    <div class="valcreate" id="other">
                        {!! Form::text('others',null,['class' => 'form-input' , 'id' => 'others']) !!}
                
                    </div>
                @else
                    <div style="display: none;"> 
                        <label for="others" class="labelTabCreate">Other:</label>
                        <div class="valcreate" id="other">
                            {!! Form::text('others',null,['class' => 'form-input' , 'id' => 'others']) !!}
                
                        </div>
                    </div>
                        
                @endif
                
            @endif


        </div>

        

 
        <div class="tabDivCreate">
            
            <label for="secondary_mobile" class="labelTabCreate">Remarks:</label>
            <div class="valcreate">
                
                 {!! Form::textarea('remarks', null, ['class' => 'form-input' , 'rows' => '3' , 'style' => 'width:150%']) !!}
                
            </div>
            
        </div>

        
        
</div>

</div>

{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary btn-sm', 'id' => 'create_source']) !!}

{!! Form::submit($submitButton, ['class' => 'btn btn-primary btn-sm', 'id' => 'cancel']) !!}



