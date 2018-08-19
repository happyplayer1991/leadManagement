             <div class="card">
                            <div class="card-content">
                                <h4 class="card-title">Contact Table</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width: 100%" id="clients-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Lead</th>
                                            <th>Company</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($getAllClients as  $allClients)
                                            <!-- @if($allClients->lead_stage == "Won") -->
                                            <tr>
                                                <td class="text-center">
                                                    <div class="btn  btn-success btn-just-icon btn-round" ><a href='leads/{{$allClients->id}}' style="color: white">W</a></div>
                                                </td>
                                                <td class=""><a href='leads/{{$allClients->id}}'>{{$allClients->name}}({{$allClients->lead_number}})</a></td>
                                                </td>
                                                <td>{{$allClients->company_name}}</td>

                                            <!-- @endif -->
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="align-right" id="cust" style="float: right">
                                        {{$getAllClients->links()}}
                                    </div>
                                </div>
                            </div>
                        </div>