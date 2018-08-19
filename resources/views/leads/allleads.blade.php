             <div class="card">
                            <div class="card-content">
                                <h4 class="card-title">AllLeads Table</h4>
                                <div class="table-responsive">
                                    <table id="allleadsdatatable" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width: 100%">

                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Lead</th>
                                            <th>Company</th>
                                            <th class="">Status</th>
                                            <th>Action</th>
                                            @if(Entrust::hasRole('administrator'))
                                            <th>Assign User</th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($getAllLeads as  $allClients)
                                            <tr>
                                                <td class="text-center">
                                                    @if($allClients->drop_status == "")
                                                        @if($allClients->lead_stage != "Won")
                                                            <div class="btn  btn-warning btn-just-icon btn-round"><a href=' leads/{{$allClients->id}}' style="color: white">P</a>

                                                            </div>
                                                        @elseif($allClients->lead_stage == "Won")
                                                            <div class="btn  btn-success btn-just-icon btn-round"><a href=' leads/{{$allClients->id}}' style="color: white">W</a>

                                                            </div>
                                                        @endif
                                                    @elseif($allClients->drop_status == "Not-Qualifield")
                                                        <div class="btn  btn-danger btn-just-icon btn-round" style="font-size: 14px;font-weight: bold;"><a href=' leads/{{$allClients->id}}' style="color: white">NQ</a>

                                                        </div>
                                                    @else
                                                        <div class="btn  btn-danger btn-just-icon btn-round"style=" font-size: 14px;font-weight: bold;"><a href=' leads/{{$allClients->id}}' style="color: white">L</a>

                                                        </div>
                                                    @endif</td>
                                                <td class=""><a href=' leads/{{$allClients->id}}'>{{$allClients->name}}({{$allClients->lead_number}})</a></td>
                                                <td>{{$allClients->company_name}}</td>
                                                <td>{{$allClients->lead_stage}}</td>
                                                <td class="">

                                                    <a action="{{url('leads/'.$allClients->id.'/edit')}}" class=" btn-icon aicon" id="modal_fade" style="cursor: pointer"><i class="material-icons ">create</i></a>
                                                </td>
                                                 @if(Entrust::hasRole('administrator'))
                                                <td>
                                                    <select name="user_id" class="form-control activity_status" onchange="assign_users('{{$allClients->id}}',this)">
                                                    <option hidden="true">Select Users...</option>
                                                    @foreach($users as $user)
                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                    @endforeach
                                                    </select>
                                                </td>
                                            @endif
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="align-right" id="led" style="float: right">
                                    {{$getAllLeads->links()}}
                                    </div>
                                </div>
                            </div>
                        </div>
