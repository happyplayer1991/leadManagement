         <div class="card">
                            <div class="card-content">
                                <h4 class="card-title">Contact Table</h4>
                                <div class="table-responsive">
                                    <table id="contactsdatatable" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width: 100%">

                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Lead </th>
                                            <th>Company</th>
                                            <th class="">Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($getAllClients as  $allClients)
                                        <tr>
                                            <td class="text-center">
                                                @if($allClients->drop_status == "")
                                                    @if($allClients->lead_stage != "Won")
                                                        <div class="btn  btn-warning btn-just-icon btn-round" ><a href=' leads/{{$allClients->id}}' style="color: white">P</a>

                                                        </div>
                                                    @elseif($allClients->lead_stage == "Won")
                                                        <div class="btn  btn-success btn-just-icon btn-round" ><a href=' leads/{{$allClients->id}}'style="color: white">W</a>

                                                        </div>
                                                    @endif
                                                @elseif($allClients->drop_status == "Not-Qualifield")
                                                    <div class="btn  btn-danger btn-just-icon btn-round" style="font-size: 14px;font-weight: bold;"><a href=' leads/{{$allClients->id}}' style="color: white">NQ</a>

                                                    </div>
                                                @else
                                                    <div class="btn  btn-danger btn-just-icon btn-round"style="font-size: 14px;font-weight: bold; "><a href=' leads/{{$allClients->id}}' style="color: white">L</a>

                                                    </div>
                                                @endif</td>
                                            <td class=""><a href=' leads/{{$allClients->id}}'>{{$allClients->name}}({{$allClients->lead_number}})</a></td>
                                            <td>{{$allClients->company_name}}</td>
                                            <td>{{$allClients->lead_stage}}</td>
                                            <td class="">
                                                 @if($allClients->drop_status == '')
                                                    <i class="material-icons" style="font-size:16px" onclick="">refresh</i>
                                                 @else
                                                    <a>  <i class="material-icons" style="font-size:16px;cursor: pointer;" onclick="returnLead({{$allClients->id}})" >refresh</i></a>
                   
                                                 @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="align-right" id="cntct" style="float: right">
                                    {{$getAllClients->links()}}
                                    </div>
                                </div>
                            </div>
                        </div>