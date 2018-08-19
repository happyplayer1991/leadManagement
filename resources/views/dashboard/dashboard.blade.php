@extends('layouts.master')

@section('content')

	<div class="col-sm-12">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					{!! Form::open([
                    'route' => 'dashboard.dashboard',
                    'class' => 'ui-form',
                    'id'    =>  'lead_form'
                    ]) !!}
					<div class="col-md-3">
						{!! Form::date('start_date', $start_date, ['class' => 'form-control']) !!}
					</div>
					<div class="col-md-3">
						{!! Form::date('end_date', $end_date, ['class' => 'form-control']) !!}
					</div>
					<div class="col-md-3">
						{!! Form::submit(__('Submit'), ['class' => 'btn btn-primary btn-sm']) !!}
					</div>
					{!! Form::close() !!}
				</div>
				<div class="row"></div>
				<div class="row" style="margin-top: 5%;">
					<div class="col-md-6">
						<div class="card">
						<span>&nbsp;</span>
								<a id="pdf1" href="reportview">
									<i class="fa fa-file-pdf-o pull-right" aria-hidden="true"  target="_blank" style="font-size: large;margin-right: 4%;margin-top: 3%;"></i></a>
						{!! $chart->html() !!}
						{!! Charts::scripts() !!}
						{!! $chart->script() !!}
						</div>
					</div>
					<div class="col-md-6">
						<div class="card">
						<span>&nbsp</span>
							<a id="pdf1" href="reportview1">
							<i class="fa fa-file-pdf-o pull-right" aria-hidden="true" target="_blank" style="font-size: large;margin-right: 4%;margin-top: 3%;"></i></a>
						{!! $chart1->html() !!}
						{!! Charts::scripts() !!}
						{!! $chart1->script() !!}
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="card">
							<div class="card-content">
								<span>&nbsp;</span>
								<a href="{{ route('layouts.leadspdf',['download'=>'pdf']) }}">
									<i class="fa fa-file-pdf-o pull-right" aria-hidden="true"  target="_blank" style="font-size: large"></i></a>
								<ul class="nav nav-pills nav-pills-primary">
									<li class="active">
										<a href="#pendingLeads" data-toggle="tab" aria-expanded="true">Pending Leads</a>
									</li>
									<li class="">
										<a href="#wonLeads" data-toggle="tab" aria-expanded="false">Won Leads</a>
									</li>
									<li class="">
										<a href="#lostLeads" data-toggle="tab" aria-expanded="false">Lost Leads</a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="pendingLeads">
										<div class="material-datatables table-responsive">
											<table id="clients-table" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width: 100%">

												<thead>
												<tr>
													<th style="width:30%">{{ __('Lead Number') }}</th>
													<th>{{ __('Name') }}</th>


												</tr>
												</thead>
												<tbody>
												@foreach($pendingLeads as $allClients)
													<tr>
														<td style="" href='leads/{{$allClients->id}}'>{{$allClients->lead_number}}</td>

														<td><a  style="color:black!important; width: 70%; word-break: keep-all;" href='leads/{{$allClients->id}}'>{{$allClients->name}}</a>
														</td>

													</tr>
												@endforeach
												</tbody>
											</table>

										</div>
									</div>
									<div class="tab-pane " id="wonLeads">
										<div class="material-datatables table-responsive">
											<table id="clients-table" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width: 100%">
												<thead>
												<tr>

													<th style="width: 30%">{{ __('Lead Number') }}</th>
													<th>{{ __('Name') }}</th>
												</tr>
												</thead>
												<tbody>
												@foreach($wonLeads as $allClients)
													<tr>
														<td style="" href='leads/{{$allClients->id}}'>{{$allClients->lead_number}}</td>

														<td><a  style="color:black!important; width: 70%; word-break: keep-all;" href='leads/{{$allClients->id}}'>{{$allClients->name}}</a>
														</td>

													</tr>
												@endforeach
												</tbody>
											</table>
										</div>
									</div>
									<div class="tab-pane " id="lostLeads">
										<div class="material-datatables table-responsive">
											<table id="clients-table" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width: 100%">
												<thead>
												<tr>
													<th style="width: 30%">{{__('Lead Number')}}</th>
													<th>{{ __('Name') }}</th>

												</tr>
												</thead>
												<tbody>
												@foreach($lostLeads as $allClients)
													<tr>
														<td style="" href='leads/{{$allClients->id}}'>{{$allClients->lead_number}}</td>

														<td><a  style="color:black!important; width: 70%; word-break: keep-all;" href='leads/{{$allClients->id}}'>{{$allClients->name}}</a>
														</td>

													</tr>
												@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="card">
							<div class="card-content">
								<span>&nbsp;</span>
								<a href="{{ route('layouts.activitiespdf',['download'=>'pdf']) }}">
									<i class="fa fa-file-pdf-o pull-right" aria-hidden="true" target="_blank" style="font-size: large"></i></a>
								<ul class="nav nav-pills nav-pills-primary">
									<li class="active">
										<a href="#openActivites" data-toggle="tab" aria-expanded="true">Open Activities</a>
									</li>
									<li class="">
										<a href="#closedActivities" data-toggle="tab" aria-expanded="false">Closed Activities</a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="openActivites">
										<div class="material-datatables table-responsive">
											<table id="closed-table" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width: 100%">
												<thead>
												<tr>
													<th>{{__('Name')}}</th>
													<th>{{ __('Activity Type') }}</th>
													<th>{{ __('Assigned User') }}</th>
													<th>{{__('Date')}}</th>
												</tr>
												</thead>
												<tbody>
												@foreach($pending_activities as $allClients)
													@if($allClients->status == 'Scheduled')
														<tr>

															@foreach($lead_names as $lead)
																@if($lead->activity_id == $allClients->id)
																	<td><a   style="color:black!important; max-width: 50%; word-break: keep-all;" href='leads/{{$lead->lead_id}}'>{{$lead->lead_name}}</a>
																	</td>

																@endif
															@endforeach

																<td>{{$allClients->name}}</td>
																@foreach($user_name as $user)
																@if($allClients->user_id == $user->id)
																<td style="word-break: keep-all">{{$user->name}}</td>
																@endif
																@endforeach
															<td>{{ date('d/m/Y', strtotime($allClients->date))}}</td>

														</tr>
													@endif
												@endforeach
												</tbody>
											</table>
										</div>
									</div>
									<div class="tab-pane" id="closedActivities">
										<div class="material-datatables table-responsive">
											<table id="closed-table" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width: 100%">
												<thead>
												<tr>
													<th>{{__('Name')}}</th>
													<th>{{ __('Activity Type') }}</th>
													<th>{{ __('Assigned User') }}</th>
													<th>{{__('Date')}}</th>

												</tr>
												</thead>
												<tbody>
												@foreach($closed_activities as $allClients)
													@if($allClients->status == 'Completed')
														<tr>
															@foreach($lead_names as $lead)
																@if($lead->activity_id == $allClients->id)
																	<td><a   style="color:black!important; max-width: 50%; word-break: keep-all;" href='leads/{{$lead->lead_id}}'>{{$lead->lead_name}}</a>
																	</td>

																@endif
															@endforeach

															<td>{{$allClients->name}}</td>
																@foreach($user_name as $user)
																@if($allClients->user_id == $user->id)
																<td style="word-break: keep-all">{{$user->name}}</td>
																@endif
																@endforeach
															<td>{{ date('d/m/Y', strtotime($allClients->date))}}</td>

														</tr>
													@endif
												@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection