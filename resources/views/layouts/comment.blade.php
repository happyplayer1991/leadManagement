
<div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<thead>
	<tr>
		<th>Date</th>
		<th>Time</th>
		<th>By</th>
		<th>Department</th>
		<th>Comments</th>
		</tr>
	</thead>
	<tbody>
	<tr class="tr_clone">
		<td>{{date('d/m/Y')}}</td>
		<td>{{date("h:i:sa") }}</td>
		<td>{{$user->name}}</td>
		<td>development</td>
		<td>{!! Form::textarea('note[]',null, ['class' => 'form-control' , 'rows' => '2' , 'id' => 'remarks']) !!}</td>
		<td><a href="javascript:void(0);" class="tr_clone_add" title="Add field"><i class="glyphicon glyphicon-plus"></i></a></td>
		</tr>
		
	</tbody>
</table>
</div>

