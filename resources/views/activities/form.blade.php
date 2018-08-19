
<div class="col-md-8">
<div class="row">
   <div class="form-group">
<div class="col-md-1"></div>
 <div class="col-md-3">
     {!! Form::label('samplecode', __('Sample code'), ['class' => 'control-label']) !!}
    @if($type == 'create')

    {!! Form::text('samplecode', null, ['class' => 'form-control','style'=>'width:50%']) !!}
    @else
    {!! Form::text('samplecode',null, ['disabled' => 'disabled'], ['class' => 'form-control']) !!}
    @endif
 </div>
@if($errors->any())
<h4>{{$errors->first()}}</h4>
@endif
    
</div>  
</div>
 

<div class="form-group">
<br>
 <label class="control-label">Item Code</label>

 <!--item code -->
@if($type == 'create')
<div class="row tr_clone">

    <div class="col-md-2">
        <input class="form-control" type="text" name="item[]" placeholder="Item">
    </div>
    <div class="col-md-2">
       <input class="form-control" type="text" name="make[]" placeholder="Make">
    </div>
    <div class="col-md-2">
        <input class="form-control" type="text" name="qty[]" placeholder="Quantity">
    </div>
    <div class="col-md-2">
      <select class="form-control" id="unit" name="uom[]">
       
        <option value="kg">Kg</option>
        <option value="lt">Lt</option>
        <option value="ml">ml</option>
        
      </select>
    </div>
    <div class="col-md-2">
       <td><a href="javascript:void(0);" class="tr_clone_add" title="Add field"><i class="glyphicon glyphicon-plus"></i></a></td>
    </div>
       
</div>   
@else
<?php 
$item = unserialize($samples->itemcode);
$c = count($item); 
?>
<?php for ($i=0; $i < $c; $i++) { ?>
   
    <!--item code -->
        <div class="row tr_clone">

            <div class="col-md-2">
                <input class="form-control" type="text" name="item[]" value ="{{ $item[$i][0] }}" placeholder="Item">
            </div>
            <div class="col-md-2">
               <input class="form-control" type="text" name="make[]" value ="{{ $item[$i][1] }}" placeholder="Make">
            </div>
            <div class="col-md-2">
                <input class="form-control" type="text" name="qty[]" value ="{{ $item[$i][2] }}" placeholder="Quantity">
            </div>
            <div class="col-md-2">
               <?php $options = $item[$i][3]; ?>
              <select class="form-control" id="unit" name="uom[]" >
               
                <option value="kg" <?php if($options=="kg") echo 'selected="selected"'; ?>>Kg</option>
                <option value="lt" <?php if($options=="lt") echo 'selected="selected"'; ?>>Lt</option>
                <option value="ml" <?php if($options=="ml") echo 'selected="selected"'; ?>>ml</option>
                
              </select>
            </div>

            
            @if($i == $c -1) 
                <td><a href="javascript:void(0);" class="tr_clone_add" title="Add field"><i class="glyphicon glyphicon-plus"></i></a></td>
            @else
                <td><a href="javascript:void(0);" class="tr_clone_minus" title="Add field"><i class="glyphicon glyphicon-minus"></i></a></td>
            @endif
       
    </div>  
 <?php } ?>
 @endif
</div>

<!-- item color code -->
<br/><br/><br/>

<div class="form-group">
@if($type == 'create')
<div class="row tr_clone">

    <div class="col-md-2">
        <input class="form-control" type="text" name="color1[]" placeholder="Color">
    </div>
    <div class="col-md-2">
        <input class="form-control" type="text" name="make1[]" placeholder="Make">
    </div>
    <div class="col-md-2">
        <input class="form-control" type="text" name="qty1[]" placeholder="Quantity">
    </div>
    <div class="col-md-2">
      <select class="form-control" id="unit" name="uom1[]">
        
        <option value="kg">Kg</option>
        <option value="lt">Lt</option>
        <option value="ml">ml</option>
      </select>
    </div>
    <div class="col-md-2">
         <a href="javascript:void(0);" class="tr_clone_add" title="Add field"><i class="glyphicon glyphicon-plus"></i></a>
    </div>
    
</div>
@else

<?php 
        $code = unserialize($samples->itemcodecolor);

        $count = count($code); 
    ?>
    
    <?php for ($n=0; $n < $count; $n++) { ?>
 
    <div class="row tr_clone">

        <div class="col-md-2">
            <input class="form-control" type="text" name="color1[]" value ="{{ $code[$n][0] }}" placeholder="color">
        </div>
        <div class="col-md-2">
           <input class="form-control" type="text" name="make1[]" value ="{{ $code[$n][1] }}" placeholder="Make">
        </div>
        <div class="col-md-2">
            <input class="form-control" type="text" name="qty1[]" value ="{{ $code[$n][2] }}" placeholder="Quantity">
        </div>
        <div class="col-md-2">
           <?php $options = $code[$n][3]; ?>
          <select class="form-control" id="unit" name="uom1[]" >
           
            <option value="kg" <?php if($options=="kg") echo 'selected="selected"'; ?>>Kg</option>
            <option value="lt" <?php if($options=="lt") echo 'selected="selected"'; ?>>Lt</option>
            <option value="ml" <?php if($options=="ml") echo 'selected="selected"'; ?>>ml</option>
            
          </select>
        </div>
        
        @if($n == $count -1) 
            <td><a href="javascript:void(0);" class="tr_clone_add" title="Add field"><i class="glyphicon glyphicon-plus"></i></a></td>
        @else
            <td><a href="javascript:void(0);" class="tr_clone_minus" title="Remove field"><i class="glyphicon glyphicon-minus"></i></a></td>
        @endif
      
           
    </div>   
<?php } ?>
@endif
</div>
<!--color wash code -->
<div class="form-group">
 <label class="control-label">Color wash Code</label>
@if($type=="create")
 <div class="row">

    <div class="col-md-3">
        Make<input class="form-control" type="text" name="make2[]" >ml
    </div>
    <div class="col-md-3">
        Quantity<input class="form-control" type="text" name="qty2[]" >ml
    </div>
    <div class="col-md-3">
        Water<input class="form-control" type="text" name="water[]">ml
    </div>
    
   
</div>
@else
<div class="row">
        <?php 
        $color = unserialize($samples->colorcode);
        
         ?>
        <div class="col-md-3">
            Make<input class="form-control" type="text" name="make2[]" value="{{$color[0][0]}}" >ml
        </div>

        <div class="col-md-3">
            Quantity<input class="form-control" type="text" name="qty2[]" value="{{$color[0][1]}}">ml
        </div>

        <div class="col-md-3">
            Water<input class="form-control" type="text" name="water[]" value="{{$color[0][2]}}">ml
        </div>

        
</div>
@endif
   
</div>

<!--wash color -->
<div class="form-group">
@if($type=="create")
<div class="row tr_clone">

    <div class="col-md-2">
        <input class="form-control" type="text" name="color3[]" placeholder="Color">
    </div>
    <div class="col-md-2">
        <input class="form-control" type="text" name="make3[]" placeholder="Make">
    </div>
    <div class="col-md-2">
        <input class="form-control" type="text" name="qty3[]" placeholder="Quantity">
    </div>
    <div class="col-md-2">
      <select class="form-control" id="unit" name="uom3[]">
        
        <option value="kg">Kg</option>
        <option value="lt">Lt</option>
        <option value="ml">ml</option>
      </select>
    </div>
    <div class="col-md-2">
         <td><a href="javascript:void(0);" class="tr_clone_add" title="Add field"><i class="glyphicon glyphicon-plus"></i></a></td>
    </div>
    
</div>
@else
<?php 
        $color = unserialize($samples->colorcodecolor);

        $cn = count($code); 
    ?>
    <!-- <label class="control-label">Item Code</label> -->
    <?php for ($j=0; $j < $cn; $j++) { ?>
 
    <div class="row tr_clone">

        <div class="col-md-2">
            <input class="form-control" type="text" name="color3[]" value ="{{ $color[$j][0] }}" placeholder="color">
        </div>
        <div class="col-md-2">
           <input class="form-control" type="text" name="make3[]" value ="{{ $color[$j][1] }}" placeholder="Make">
        </div>
        <div class="col-md-2">
            <input class="form-control" type="text" name="qty3[]" value ="{{ $color[$j][2] }}" placeholder="Quantity">
        </div>
        <div class="col-md-2">
           <?php $options = $color[$j][3]; ?>
          <select class="form-control" id="unit" name="uom3[]" >
           
            <option value="kg" <?php if($options=="kg") echo 'selected="selected"'; ?>>Kg</option>
            <option value="lt" <?php if($options=="lt") echo 'selected="selected"'; ?>>Lt</option>
            <option value="ml" <?php if($options=="ml") echo 'selected="selected"'; ?>>ml</option>
            
          </select>
        </div>
        
        @if($j == $cn -1) 
            <td><a href="javascript:void(0);" class="tr_clone_add" title="Add field"><i class="glyphicon glyphicon-plus"></i></a></td>
        @else
            <td><a href="javascript:void(0);" class="tr_clone_minus" title="Add field"><i class="glyphicon glyphicon-minus"></i></a></td>
        @endif
      
           
    </div>   
<?php } ?>
@endif
</div>

 
</div>

<div class="col-md-4">

     
    @if($type=="create")
    {{ Form::label('image_path', __('Sample Image'), ['class' => 'control-label']) }}
    <input type="file" name="image_path" id="file-input"/>

    <div id="thumb-output"></div>
    @else
    <label>Update Sample Image</label>
        <input type="file" name="image_path" id="file-input">
        
        <div id="thumb-output">
            <!-- <img src="/images/Media/{{ $samples['image_path'] }}" style="width:150px; height:150px; float:bottom; border-radius:50%; margin-right:25px;"> -->
            <img width="150px" height="150px" 
          @if($samples->image_path != "")
          src="/images/Media/{{$samples->image_path}}"
          @else
          src="/images/no_image_found.png"
          @endif />
        </div>

        
    @endif

</div>


<div class="col-md-4">
    <!-- {{ Form::label('briefdescription', __('Brief description'), ['class' => 'control-label']) }}
    @if($type=="create")
    <textarea class="form-control" name="briefdescription" placeholder="Brief Description"></textarea>
    @else
    <textarea class="form-control" name="briefdescription" placeholder="briefdescription">{{$samples->briefdescription}}</textarea>
    @endif -->

            <div class="tabDivCreate">
            
                <label for="description" class="labelTabCreate">Brief Description:</label>
                <div class="valcreate">
                   {!! Form::textarea('description', null, ['class' => 'form-input' , 'rows' => '3' , 'style' => 'width:150%']) !!}
                    
                </div>
            
            </div>

</div>
    
  
<div class="col-md-8">
    <div class="row" >
        {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary btn-sm']) !!}
        {!! Form::submit($submitButton, ['class' => 'btn btn-primary btn-sm']) !!}  
    </div>   
</div>




