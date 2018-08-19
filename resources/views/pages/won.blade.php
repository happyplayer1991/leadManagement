
<div class="z-depth-3 handle-item" data-id="{{$allLeads->id}}">
                                        <div class=" lmdd-block">
                                            <div class="col-md-12 actionhandler">
                                                <span class="text-left pull-left">
                                                <i class="material-icons handle">reorder</i>
                                                </span>
                                                <span class="text-right pull-right actionlist">
                                <a href="#" class="btn-icon aicon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>

                                    <p class="hidden-lg hidden-md">
                                        Actions
                                        <b class="caret"></b>
                                    </p>
                                <div class="ripple-container"></div></a>
                                <ul class="dropdown-menu">
                                 <li>
                                      <a action="{{url('leads/'.$allLeads->id.'/edit')}}" class=" btn-icon" id="modal_fade" style="cursor: pointer;">Edit Lead</a>
                                    </li>
                                    <li>
                                         <a action="{{url('activities/createActivity',$allLeads->id)}}" class="  btn-icon" id="modal_fade" style="cursor: pointer;">Add Activity</a>

                                    </li>
                                </ul>
                                                </span>
                                            </div>
                                            <div class="task">
                                                <div class="leadinfo lead{{$allLeads->id}}">
                                                    <div class="row leadinfoline">
                                                        <div class="key pull-left">Lead Name:</div>
                                                        <a href=' leads/{{$allLeads->id}}'>
                                                            <div class="value pull-left" style="color: white;text-decoration: underline;">{{$allLeads->name}}({{$allLeads->lead_number}})</div></a>
                                                    </div>
                                                    <div class="row leadinfoline">
                                                        <div class="key pull-left">Invoice Number:</div>
                                                        <a href=' invoices/{{$allLeads->invoice_id}}'>
                                                            <div class="value pull-left" style="color: white;text-decoration: underline;">{{$allLeads->invoice_number}}</div></a>
                                                    </div>
                                                    {{--<div class="row leadinfoline">--}}
                                                        {{--<div class="key pull-left">Name:</div>--}}
                                                        {{--<a href=' leads/{{$allLeads->id}}'>--}}
                                                            {{--<div class="value pull-left">{{$allLeads->name}}</div></a>--}}
                                                    {{--</div>--}}
                                                    <div class="row leadinfoline">
                                                        <div class="key pull-left">Amount:</div>
                                                        <div class="value pull-left">
                                                            <?php 
                                                            $text = $allLeads->currency; preg_match('#\((.*?)\)#', $text, $match); ?>
                                                            {{$match[1]}} {{$allLeads->amount}}</div>
                                                    </div>
                                                    <div class="row leadinfoline">
                                                        <div class="key pull-left">Status:</div>
                                                        <div class="value pull-left">{{$allLeads->public_notes}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
