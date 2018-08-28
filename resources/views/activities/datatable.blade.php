       <div class="card">
            <div class="card-content">
                <h4 class="card-title">Activity Table</h4>
                <div class="material-datatables table-responsive">
                    <table id="activity-table" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width: 100%">
                        <thead>
                         <tr>
                            <th>Lead Name</th>
                            <th>Created On</th>
                            <th>Created By</th>
                            <th>Activity</th>
                            <th>Description</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($getAllClients as $getAll)

                                <tr>
                                    <td><a href=' leads/{{$getAll->lead_id}}'>{{$getAll->lead_name}}&nbsp;({{$getAll->lead_number}})</a></td>
                                    <td>{{date('d/m/Y', strtotime($getAll->created_at))}}</td>
                                    <td>{{$getAll->user_name}}</td>
                                    <td>{{$getAll->name}}</td>
                                    <td>{{$getAll->details}}</td>
                                    <td>{{date('d/m/Y', strtotime($getAll->date))}}</td>
                                    @if($getAll->end_date!='')
                                        <td>{{date('d/m/Y', strtotime($getAll->end_date))}}</td>
                                    @else
                                        <td></td>
                                    @endif                                
                                    <?php $status= array('Scheduled'=>'Scheduled','Completed' =>'Completed');?>
                                    @if($getAll->status == "Scheduled")
                                    <td>
                                     {!! Form::select('status', $status,null, ['class' => 'form-input ui search selection search-select  activity_status', 'id' => 'search-select', 'onchange'=> "activity_status('$getAll->id',this,'details')"]) !!}</td>
                                    @else
                                    <td>{{$getAll->status}}</td>
                                    @endif

                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                @if(!$getAllClients->isEmpty())
                    <div class="pull-right" id="act" >
                        {{$getAllClients->links()}}
                    </div>
                @endif
                </div>
            </div>
        </div>