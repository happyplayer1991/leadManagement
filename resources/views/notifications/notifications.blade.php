<div id="notification_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Pending Tasks</h4>
      </div>
      <div class="modal-body">
        <table class="table table-hover">
        <thead>
        <tr>

            <th>{{ __('TITLE') }}</th>
            <th>{{ __('CREATED AT') }}</th>
            <th>{{ __('DETAILS') }}</th>
            <th>{{__('LEAD NAME')}}</th>

        </tr>
        </thead>
        <tbody>
            @foreach($getAllClients as  $task)
            @if($task->status == 'Scheduled')
            <tr>
                <td>{{$task->next_follow_up_name}}</td>
                <td>{{$task->created_at ? with(new Carbon($task->created_at))->format('d/m/Y') : ''}}</td>
                <td>{{$task->details}}</td>
                <td>{{$task->name}}</td>
                
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>