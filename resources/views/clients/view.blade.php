<div id="client_view_modal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Lead Details</h4>
			</div>
			<div class="modal-body">
				<div class="card">
					<div class="personal-details">
						<dl>
							<dt>
							<label for="name" class="">Lead Name:</label></dt>
							<dd class="">
								<span> {{$getAllClients->name}}</span></dd>
						<dt class="">
							<label for="primary_number" class=>Mobile Number:</label></dt>
							<dd class="">
								<span> {{$getAllClients->primary_number}}</span></dd>
						<dt class="">
							<label for="email" class="">Email Address:</label></dt>
							<dd class="">
								<span>{{$getAllClients->email}}</span></dd>
						<dt class="">
							<label for="address" class="">Address:</label></dt>
							<dd class="">
								<span>{{$getAllClients->address}}</span></dd>
						<dt class="">
							<label for="country" class="">Country:</label></dt>
							<dd class="">
								<span>{{$getAllClients->country}}</span></dd>
						<dt class="">
							<label for="pin" class="">Pin:</label></dt>
							<dd class="">
								<span>{{$getAllClients->pin}}</span></dd>
						</dl>
					</div>
				</div>
				<div class="card">
					<div class="company-details">
						<dl>
						<dt class="">
							<label for="country" class="">Company Name:</label></dt>
							<dd class="">
								<span>{{$getAllClients->company_name}}</span></dd>
						<dt class="">
							<label for="country" class="">Company Website:</label></dt>
							<dd class="">
								<span>{{$getAllClients->company_website}}</span></dd>
						<dt class="">
							<label for="country" class="">Annual Revenue:</label></dt>
							<dd class="">
								<span> {{$getAllClients->annual_revenue}}</span></dd>
						<dt class="">
							<label for="country" class="">Number of Employees:</label></dt>
							<dd class="">
								<span>{{$getAllClients->number_employee}}</span></dd>
						<dt class="">
							<label for="country" class="">Industry Type:</label></dt>
							<dd class="">
			            <span>
			                {{$getAllClients->industry_type}}</span></dd>

						</dl>
					</div>
				</div>
				<div class="card">
					<div class="lead-details">
						<dl>
						<dt class="">
							<label for="state" class="">Lead Type:</label></dt>
							<dd class="">
								<span> {{$getAllClients->lead_type}}</span></dd>
						<dt class="">
							<label for="state" class="">Lead Status:</label></dt>
							<dd class="">
								<span> {{$getAllClients->lead_status}}</span></dd>
						<dt class="">
							<label for="state" class="">Interested Product:</label></dt>
							<dd class="">
								<span>  {{$getAllClients->interested_product}}</span></dd>
						<dt class="">
							<label for="state" class="">Lead Owner:</label></dt>
							<dd class="">
								<span> {{$users->name}}<br></span></dd>
						<dt class="">
							<label for="state" class="">Lead Source:</label></dt>
							<dd class="">
								<span> {{$getAllClients->source_type}}<br></span></dd>

						</dl>
					</div>
				</div>


			</div>
		</div>
	</div>
</div>




