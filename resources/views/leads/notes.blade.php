
    <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width: 100%" id="notes-table">

        @if($notes != '')
            @foreach($notes as $comment)
                @if($comment->lead_id == $lead->id && $comment->company_id == \Auth::user()->company_id)
                    <div class="panel panel-primary shadow" style=" ">

                        <div class="panel-body">
                            <div class="card" style="border-left: 3px solid orange; border-radius: 0px; padding-left: 10px; margin: 0px !important;">
                                <div class="step-connector">
                                </div>
                            <p>  {{$comment->note}}</p>
                            <p class="smalltext">{{ __('Comment by') }}: <a
                                        href="{{route('users.show', $comment->user->id)}}"> {{$comment->user->name}} </a>
                            </p>
                            <p class="smalltext">{{ __('Created at') }}:
                            {{ date('d F, Y, H:i:s', strtotime($comment->created_at))}}
                        </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
        {{--{!! Form::open(array('url' => array('/leads/notes',$lead->id ))) !!}--}}
        {{--<div class="form-group">--}}
            {{--{!! Form::textarea('note', null, ['class' => 'form-control']) !!}--}}
            {{--{!! Form::hidden('status', 'Lead', ['class' => 'form-control']) !!}--}}
            {{--{!! Form::hidden('lead_id', $lead->id, ['class' => 'form-control']) !!}--}}
        {{--</div>--}}
        {{--<div class="pull-right">--}}
        {{--{!! Form::submit( __('Add Note') , ['class' => 'btn btn-primary btn-sm']) !!}--}}
        {{--</div>--}}
        {{--{!! Form::close() !!}--}}
    </table>
</div>
</div>