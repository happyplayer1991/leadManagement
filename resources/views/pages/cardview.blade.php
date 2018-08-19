
    <div class="card">
        <div class="card-title"><h4 class="text-center">Track your Leads here! Know your open leads and their current stage.</h4></div>
        <div class="card-content ">
            <div id="handle-example" class="col-lg-12 col-md-12 example">
                <div class="col-md-3 handle-grid leads">
                    <div class="card z-depth-2 ">
                        <div class="card-title text-center">Lead Stage</div>
                    </div>
                    @if(count($getAllLeads['getAllLeads'])>0)
                        @foreach($getAllLeads['getAllLeads'] as $allLeads)
                            @if($allLeads->drop_status == '' && $allLeads->session_id == '')
                                @if($allLeads->lead_stage == "Lead")
                                    @include('pages.lead')
                                @endif
                            @else
                            @endif
                        @endforeach
                    @else
                        <div class="z-depth-3"><div class="content lmdd-block">No Leads</div></div>
                    @endif
                </div>
                <div class="col-md-3 handle-grid  opportunity">
                    <div class="card z-depth-2 ">
                        <div class="card-title text-center">Opportunity Stage</div>
                    </div>
                    @if(count($getAllLeads['getAllLeads'])>0)
                        @foreach($getAllLeads['getAllLeads'] as $allLeads)
                            @if($allLeads->drop_status == '' && $allLeads->session_id == '')
                                @if($allLeads->lead_stage == "Opportunity")
                                    @include('pages.opportunity')
                                @endif
                            @else
                            @endif
                        @endforeach
                    @else
                        <div class="z-depth-3"><div class="content lmdd-block">No Leads</div></div>
                    @endif
                </div>

                <div class="col-md-3 handle-grid  quote">
                    <div class="card  z-depth-2">
                        <div class="card-title text-center">Quote Stage</div>

                    </div>
                    @if(count($getAllLeads['getQuotationLeads'])>0)
                        @foreach($getAllLeads['getQuotationLeads'] as $allLeads)
                            @if($allLeads->drop_status == '' && $allLeads->session_id == '')
                                @if($allLeads->lead_stage == "Quote")
                                    @include('pages.quotations')
                                @endif
                            @else

                            @endif
                        @endforeach
                    @else
                        <div class="z-depth-3"><div class="content lmdd-block">No Leads</div></div>
                    @endif
                </div>
               
                <div class="col-md-3 handle-grid  won">
                    <div class="card z-depth-2">
                        <div class="card-title text-center">Won Leads</div>
                    </div>
                    @if(count($getAllLeads['getInvoiceLeads'])>0)
                        @foreach($getAllLeads['getInvoiceLeads'] as $allLeads)
                            @if($allLeads->drop_status == '' && $allLeads->session_id == '')
                                @if($allLeads->lead_stage == "Won")
                                    @include('pages.won')
                                @endif
                            @else

                            @endif
                        @endforeach
                    @else
                        <div class="z-depth-3"><div class="content lmdd-block">No Leads</div></div>
                    @endif
                </div>
            </div>

        </div>
    </div>