@extends('layouts.master')
@section('heading')
    <h1>All tasks</h1>
@stop

@section('content')
    <table class="table table-hover" id="tasks-table">
        <thead>
        <tr>

            <th>{{ __('Title') }}</th>
            <th>{{ __('Created at') }}</th>
            <th>{{ __('Deadline') }}</th>
            <th>{{ __('Assigned') }}</th>

        </tr>
        </thead>
        <tbody>
            @foreach($tasksDetails as $index => $task)
            <tr>
                <td><a href='tasks/{{$task->id}}'>{{$task->title}}</a></td>
                <td>{{$task->created_at ? with(new Carbon($task->created_at))->format('d/m/Y') : ''}}</td>
                <td>{{$task->created_at ? with(new Carbon($task->created_at))->format('d/m/Y') : ''}}</td>
                <td>{{$task->user->name}}</td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
@stop

@push('scripts')
<script>
    $(function () {
        $('#tasks-table').DataTable();
        //     processing: true,
        //     serverSide: true,
        //     ajax: '{!! route('tasks.data') !!}',
        //     columns: [

        //         {data: 'titlelink', name: 'title'},
        //         {data: 'created_at', name: 'created_at'},
        //         {data: 'deadline', name: 'deadline'},
        //         {data: 'user_assigned_id', name: 'user_assigned_id',},

        //     ]
        // });
    });
</script>
@endpush

