<div id="create_modal" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title ">Edit Product</h4>
			</div>
			<div class="modal-body">

			 {!! Form::model($product, [
            'method' => 'PATCH',
            'route' => ['products.update',$product->id], 
            'id' => 'submit_form'
            ]) !!}

          

				<div class="form-group">
		            <label for="primary_number" class="control-label">Product Name:</label>
		            {!! Form::hidden('id',null,['class' => 'form-control']) !!}
		            {!! Form::text('product_name',null,['class' => 'form-control' , 'id' => 'product_name']) !!}

		          </div>

		           <div class="form-group">
		            <label for="" class="control-label">Price:</label>
		            
		            {!! Form::text('price',null,['class' => 'form-control' , 'id' => 'price']) !!}
		        </div>
		        <div class="form-group">
		            <label for="" class="control-label">Description:</label>

					{!! Form::textarea('description',null,['class' => 'form-control' , 'id' => 'product_description','rows'=>'5', 'maxlength'=>'255']) !!}
					<div id="characterLeft"></div>
		         </div>
			
			<input type="submit" value="Save" class="btn btn-primary">
			
           
		   {!! Form::close() !!}
		
			

     
			</div>
		</div>
	</div>
</div>












