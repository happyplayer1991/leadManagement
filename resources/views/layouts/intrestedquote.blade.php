
    <div id="intrest_quote" class="modal fade" role="dialog" >
        <div class="modal-dialog">

            <div class="modal-content" style="width: 120%; overflow-y: scroll; max-height: 400px;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title text-center">Quotations</h3>
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="">Quotation Number</th>
                        <th>Lead Name</th>
                        <th>Company</th>
                        <th>Amount</th>
                        <th>status</th>
                    </tr>
                    </thead>
                    @foreach($quotations as $quotation)
                    @foreach($quotationDetails as $quotationDetail)
                    @if($quotation->id == $quotationDetail->qid)
                    <tbody>
                        <td class="text-center"><a href="quotations/{{$quotation->id}}">QU{{$quotationDetail->quotation_number}}<div><span style="color: black;font-size: 10px;font-weight: 500;">&nbsp( <time class="timeago" datetime="{{$quotationDetail->created_at}}"></time>)</span></div></a></td>
                        @foreach($leads as $lead)
                        @if($lead->id == $quotationDetail->lid)
                        <td><a href=' leads/{{$lead->id}}'>{{$quotationDetail->name}}&nbsp;({{$quotationDetail->lead_number}})</a></td>
                        @endif
                        @endforeach
                        <td>{{$quotationDetail->company_name}}</td>
                        @foreach($currency as $curr)
                        @if($curr->currency_code == substr($quotation->currency,0,3))
                        <td class="text-center">{{$curr->symbol}}{{$quotationDetail->amount}}</td>
                        @endif 
                        @endforeach
                        <td>{{$quotationDetail->status}}</td>
                    </tbody>
                    @endif
                    @endforeach
                    @endforeach
                </table>
            </div>
        </div>
    </div>

