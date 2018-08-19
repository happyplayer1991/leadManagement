<div id="create_modal" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add Product</h4>
			</div>
			<div class="modal-body">

			
			{!! Form::open([
            'class' => 'ui-form',
            'route' => 'products.store',
            'id'    =>  'submit_form'
            ]) !!}
				<div class="form-group">
		            <label for="" class="control-label">Product Name<font color="red">*</font></label>
		            
		            {!! Form::text('product_name',null,['class' => 'form-control' , 'id' => 'product_name']) !!}
		        </div>
		        <div class="form-group">
		            <label for="" class="control-label">Price<font color="red">*</font></label>
		            
		            {!! Form::number('price',null,['class' => 'form-control' , 'id' => 'price', 'min' => '0']) !!}
		        </div>
		        <div class="form-group">
		            <label for="description" class="control-label">Description:</label>

		            {!! Form::textarea('description',null,['class' => 'form-control' , 'id' => 'product_description','rows'=>'5', 'maxlength'=>'255']) !!}
					<div id="characterLeft"></div>
		         </div>

		        <input type="submit" value="Create New Product" class="btn btn-primary" id="">
		           
		            {!! Form::close() !!}

     
			</div>
		</div>
	</div>
</div>











