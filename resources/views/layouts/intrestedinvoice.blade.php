
    <div id="intrest_invoice" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content" style="width: 140%; overflow-y: scroll;max-height: 400px;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title text-center" >Invoices</h3>
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr>

                        <th class="">Quotation Number</th>
                        <th class="">Invoice Number</th>
                        <th>Lead Name</th>
                        <th>Company</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    @foreach($invoices as $invoice)
                    @foreach($invoiceDetails as $invoiceDetail)
                    @if($invoice->id == $invoiceDetail->iid)
                    <tbody>

                        <td class="text-center">QU{{$invoiceDetail->quotation_number}}</td>
                        <td class="text-center"><a href="invoices/{{$invoice->id}}" >IN{{$invoiceDetail->invoice_number}}<div><span style="color: black;font-size: 10px;font-weight: 500;">&nbsp;( <time class="timeago" datetime="{{$invoiceDetail->created_at}}"></time>)</span></div></a></td>
                        @foreach($leads as $lead)
                        @if($lead->id == $invoiceDetail->lid)
                        <td><a href=' leads/{{$lead->id}}'>{{$invoiceDetail->name}}&nbsp;({{$invoiceDetail->lead_number}})</a></td>
                        @endif
                        @endforeach
                        @foreach($currency as $curr)
                        @if($curr->currency_code == substr($invoice->currency,0,3))
                        <td>{{$invoiceDetail->company_name}}</td>
                        <td class="text-center">{{$curr->symbol}}{{$invoiceDetail->amount}}</td>
                        @endif 
                        @endforeach
                        <td>{{$invoiceDetail->public_notes}}</td>
                    </tbody>
                    @endif
                    @endforeach
                    @endforeach 
                </table>
            </div>
        </div>
    </div>

