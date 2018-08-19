<!-- @extends('layouts.master')

@section('heading')
<h1>{{ __('Viewing Location') }}</h1>

@stop


@section('content')


<div class="container">
	<div class="col-md-6">
		
		<div class="tabDivCreate">
            <div class="labelTabCreate">Location Name</div>
            <div class="valcreate">
                {{$locations->name}}
            </div>
            
        </div>
        <div class="tabDivCreate">
            <div class="labelTabCreate">Location State</div>
            <div class="valcreate">
               
            </div>
            
        </div>
        <div class="tabDivCreate">
            <div class="labelTabCreate">Location Description</div>
            <div class="valcreate">
                {{$locations->description}}
            </div>
            
        </div>
        
     
	</div>
</div>
@endsection -->


<div class="pop-over"  id="view_client" >
  
 <a style="color:black!important" class="close_pop_over"><i class="material-icons">close</i></a>
    <div class=""> 
    {!! Form::open([
            'route' => 'clients.store',
            'class' => 'ui-form',
            'id'    =>  'lead_form'
            ]) !!}
    @include('clients.form', ['submitButtonText' => __('Create New Lead'),'submitButton'=>__('Cancel')])


    
    {!! Form::close() !!}



        <input type="submit"  class="btn btn-primary" id="view_lead">
</div>
<script>
$(document).ready(function(){
    $('#view_lead').on('click',function(){
        alert();
        $.ajax({
              url: "locations/viewLead",
              type: 'PATCH',
              data: data,
              // data: ajax_data ,
              success: function (response) {
                 console.log(response);
                 // var messages = " Lead dropped sucessfully";
                 $('#view_client').hide();
                 alert();
                 toastr.success('', messages);
              },
              error: function(xhr, status, error) {
                   console.log(xhr.responseText);
              }
        }); 

    });
 })
</script>


