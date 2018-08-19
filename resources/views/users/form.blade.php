<div class="card-content">
    <div class="form-group">
      {{--{{ Form::label('image_path', __('Image'), ['class' => 'control-label']) }}--}}
        <div  class="container usr">

            <div class="col-md-12 col-sm-12">
                <div class="col-md-4 col-sm-4">

                </div>
                <div class="col-md-4 col-sm-4">
                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                    <!-- <div class="fileinput-new thumbnail img-circle"> -->
                    @if($type == 'edit')
                            @if( !@empty($user) && $user->image_path != "")
                            <img src="{{$user->image_path}}" alt=" " width="10px">
                            @else
                            
                                <img src="../../assets/img/placeholder.jpg" alt="...">
                            @endif

                      @else
                            <img src="../../assets/img/placeholder.jpg" alt="...">
                      @endif
                    <!-- </div> -->
                    <div class="fileinput-preview fileinput-exists thumbnail img-circle"></div>
                    <div>
                                                    <span class="btn btn-round btn-primary btn-file">
                                                        <span class="fileinput-new">Add Photo</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" name="image_path" />
                                                    </span>
                        <br />
                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                    </div>
                </div>
            </div>
                <div class="col-md-4 col-sm-4">

                </div>
            </div>

        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">




            @if(Entrust::hasRole('administrator'))
            	{!! Form::text('name',null,['class' => 'form-control' , 'id' => 'name','readonly' => 'true','placeholder'=>'Name...']) !!}
            @else                 
                {!! Form::text('name',null,['class' => 'form-control' , 'id' => 'name'  , 'readonly' => 'true','placeholder'=>'Name...']) !!}
            @endif

        </div>

            <div class="form-group">

               <div class="valcreate">
                  {!! Form::number('personal_number',null,['class' => 'form-control' , 'id' => 'personal_number','placeholder'=>'Mobile...']) !!}
               </div>
            </div>
            <div class="form-group">

            <div class="valcreate">
                {!! Form::number('work_number',null,['class' => 'form-control' , 'id' => 'work_number', 'placeholder'=>'Office Number...']) !!}

                <!-- {!! Form::password('password', ['class' => 'form-control' , 'id' => 'password','placeholder'=>'New Password...']) !!} -->
            </div>
          </div>


           <div class="form-group">
            


                 @if(Entrust::hasRole('administrator'))
                  <!-- <select class="form-control" id="search-select" name="roles">
                 



                    <option value="" hidden="true">Assign Role</option>
                    <option value="1">Administrator</option>
                    <option value="2">Manager</option>
                    <option value="3">Employee</option>
                  </select> -->
                    {!! Form::select('roles', $roles, null, ['class' => 'form-control', 'id' => 'search-select','placeholder'=>'Assign Role..']) !!}

               @elseif(Entrust::hasRole('employee'))
               <select class="form-control" id="search-select" name="roles">
                    <option value="3">Employee</option>
                  </select>
                  <!-- <input type="text" name="roles" value="3" class="form-control" id="roles" readonly="true" /> -->
               @elseif(Entrust::hasRole('manager'))
                <select class="form-control" id="search-select" name="roles">
                    <option value="2">Manager</option>
                  </select>
                  <!-- <input type="text" name="roles" value="2" class="form-control" id="roles" readonly="true" /> -->
               @endif

            
        </div>
            
            <!-- <div class="form-group">
               <div class="valcreate" >
                  {!! Form::password('password_confirmation', ['class' => 'form-control' , 'id' => 'confirm_password','placeholder'=>'Confirm Password...']) !!}
               </div>
            </div> -->

           <!-- <div class="tabDivCreate">
            
                <label for="Assign_department" class="labelTabCreate">Assign Department   <font color="red">*</font></label>
                <div class="valcreate">
                    {!! Form::select('departments', $departments, null, ['class' => 'form-control ', 'id' => 'search-select']) !!}
               
                </div>
            
            </div> -->
            <!-- <div class="form-group">
            


                 @if(Entrust::hasRole('administrator'))
                  <select class="form-control" id="search-select" name="roles">
                    <option value="" hidden="true">Assign Role</option>
                    <option value="1">Administrator</option>
                    <option value="2">Manager</option>
                    <option value="3">Employee</option>
                  </select>
                    <{!! Form::select('roles', $roles, null, ['class' => 'form-control', 'id' => 'search-select','placeholder'=>'Assign Role..']) !!} -->
<!-- 
               @elseif(Entrust::hasRole('employee'))
               <select class="form-control" id="search-select" name="roles">
                    <option value="3">Employee</option>
                  </select>
                  <!<input type="text" name="roles" value="3" class="form-control" id="roles" <!- readonly="true" /> -->
               <!-- @elseif(Entrust::hasRole('manager'))
                <select class="form-control" id="search-select" name="roles">
                    <option value="2">Manager</option>
                  </select> -->
                  <!-- <input type="text" name="roles" value="2" class="form-control" id="roles" readonly="true" /> -->
              <!--  @endif  

          
        </div>  -->
            
     </div>
          
           <div class="col-md-6">
              <div class="form-group">


             @if(Entrust::hasRole('administrator'))
             	{!! Form::text('email',null,['class' => 'form-control' , 'id' => 'mail','readonly' => 'true','placeholder'=>'E-Mail...'])!!}
             @else
                {!! Form::text('email',null,['class' => 'form-control' , 'id' => 'mail' , 'readonly' => 'true','placeholder'=>'E-Mail...']) !!}
              @endif

                </div>
                 <div class="form-group">
                       {!! Form::text('company_name',null,['class' => 'form-control' , 'id' => 'companyname','readonly' => 'true','placeholder'=>'Company Name...']) !!}

               </div>
                 <div class="form-group">
                       {!! Form::text('address',null,['class' => 'form-control' , 'id' => 'address','placeholder'=>'Address...']) !!}

               </div>
<!-- 
               <div class="form-group">
                       {!! Form::text('address',null,['class' => 'form-control' , 'id' => 'address','placeholder'=>'Address...']) !!}

               </div> -->
        
       <!-- <div class="form-group">


                {!! Form::number('work_number',null,['class' => 'form-control' , 'id' => 'work_number', 'placeholder'=>'Office Number...']) !!}

        </div> -->
      
            
        
           
        <!-- <div class="form-group">
            


                 @if(Entrust::hasRole('administrator'))
                  <select class="form-control" id="search-select" name="roles">
                    <option value="" hidden="true">Assign Role</option>
                    <option value="1">Administrator</option>
                    <option value="2">Manager</option>
                    <option value="3">Employee</option>
                  </select>
                    <!-- {!! Form::select('roles', $roles, null, ['class' => 'form-control', 'id' => 'search-select','placeholder'=>'Assign Role..']) !!} -->

               <!-- @elseif(Entrust::hasRole('employee'))
               <select class="form-control" id="search-select" name="roles">
                    <option value="3">Employee</option>
                  </select>
                  <!-- <input type="text" name="roles" value="3" class="form-control" id="roles" readonly="true" /> -->
               <!-- @elseif(Entrust::hasRole('manager'))
                <select class="form-control" id="search-select" name="roles">
                    <option value="2">Manager</option>
                  </select>
                  <!-- <input type="text" name="roles" value="2" class="form-control" id="roles" <!-- readonly="true" /> -->
               <!-- @endif

            
        </div>   -->

    </div>
</div>
<div class="form-group pull-right">

{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary btn-sm btn1']) !!}
</div>


