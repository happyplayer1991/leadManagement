<div id="create_modal" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
			<form action="{{url('leads/convertToOppurtunity')}}" method="post" id="submit_form">
				<div> 

			            @if($status == "Oppurtunity")
			                Convert Lead to Oppurtunity?
			            @elseif($status == "Quote")
			                Convert Opportunity to Quote?
			            @elseif($status == "Won")
			                Convert Quote to Won?
			            @endif
			            <input type="hidden" name="id" value="{{$id}}"/>
			            <input type="hidden" name="status" value="{{$status}}"/>
			                
			        </div>
			
			
			       
			        <input type="submit" value="OK" class="btn btn-primary">
			</form>		
			</div>
		</div>
	</div>
</div>




