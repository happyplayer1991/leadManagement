<div class="z-depth-3 handle-item" data-id="{{$allLeads->id}}">
                                        <div class="content lmdd-block">
                                            <div class="col-md-12 actionhandler">
                                                <span class="text-left pull-left">
                                                <i class="material-icons handle notranslate notranslate">reorder</i>
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
                                    <!-- <li>
                                        <a action="{{url('leads/oppurtunity/'.$allLeads->id.'/'.'Oppurtunity')}}" class=" btn-icon" id="modal_fade" style="cursor: pointer;">Move</a>

                                    </li> -->
                                    <li>
                                         <a action="{{url('leads/drop',$allLeads->id)}}" class=" btn-icon" id="modal_fade" style="cursor: pointer;">Drop Lead</a>
                                    </li>
                                </ul>
                                                </span>
                                            </div>
                                            <div class="task">

                                                <div class="leadinfo lead{{$allLeads->id}}">
                                                    <div class="row leadinfoline">
                                                        <div class="key pull-left">Lead Name:</div>
                                                        <a href=' leads/{{$allLeads->id}}'>
                                                            <div class="value pull-left" style="color: white;text-decoration: underline;">{{$allLeads->name}}&nbsp({{$allLeads->lead_number}})</div></a>
                                                    </div>
                                                    <div class="row leadinfoline">
                                                        <div class="key pull-left">Quote Number:</div>
                                                        <a href=' quotations/{{$allLeads->quotation_id}}'>
                                                            <div class="value pull-left" style="color: white;text-decoration: underline;">{{$allLeads->quotation_number}}</div></a>
                                                    </div>

                                                    <div class="row leadinfoline">

                                                        <div class="key pull-left">Amount:</div>
                                                        <div class="value pull-left">
                                                            <?php 
                                                            $text = $allLeads->currency; preg_match('#\((.*?)\)#', $text, $match); ?>
                                                            {{$match[1]}} {{$allLeads->amount}}</div>
                                                        
                                                    </div>
                                                    <div class="row leadinfoline">
                                                        <div class="key pull-left">Status:</div>
                                                        <div class="value pull-left">{{$allLeads->status}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>