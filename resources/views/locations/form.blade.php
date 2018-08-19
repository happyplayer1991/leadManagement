

<input type="hidden" name="_token" value="{{ csrf_token() }}">
 
    <div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="tabDivCreate">
            
                <label for="customer_name" class="labelTabCreate">Location Name:</label>
                <div class="valcreate">
                    {!! Form::text('name',null,['class' => 'form-input' , 'id' => 'lname']) !!}
                </div>
            
            </div>
            <div class="tabDivCreate">
            
                <label for="state" class="labelTabCreate">Location State:</label>
                <div class="valcreate">
                    {!! Form::select('state_id', $states, null, ['class' => 'form-input ui search selection top right pointing search-select', 'id' => 'search-select']) !!}
               
                </div>
            
            </div>

             <div class="tabDivCreate">
            
                <label for="description" class="labelTabCreate">Location description:</label>
                <div class="valcreate">
                    
                     {!! Form::textarea('description', null, ['class' => 'form-input' , 'rows' => '3' , 'style' => 'width:150%']) !!}
                    
                </div>
            
            </div>
        </div>
    </div>
        
        <div class="row" style="margin-top: 30px;">
              {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary btn-sm']) !!}
              {!! Form::submit($submitButton, ['class' => 'btn btn-primary btn-sm']) !!}
        </div>
    </div>
