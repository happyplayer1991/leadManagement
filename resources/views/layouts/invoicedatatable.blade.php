    <div class="card">
        <div class="card-content">
            <h4 class="card-title">Invoice Table</h4>
            <div class="material-datatables table-responsive">
                <table id="invoices-table" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width: 100%">
                    <thead>
                    <tr>
                        <th style="text-align:center">Invoice Number</th>
                        <th style="text-align:center">Quotation Number</th>
                        <th>Lead Name</th>
                        <th>Company</th>
                        <th class="" style="text-align:center">Total Amount</th>
                        <th class="" style="text-align:center">Paid Amount</th>
                        <th class="" style="text-align:center">Due Amount</th>

                        <th class="">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                       @foreach($invoices as $invoice)
                        <tr>
                            <td class="text-center"><a href="invoices/{{$invoice->id}}" >INV{{$invoice->invoice_number}}
                                    <div><span style="color: black;font-size: 10px;font-weight: 500;">&nbsp( <time class="timeago" datetime="{{$invoice->created_at}}"></time>)</span></div></a></td>
                            <td class="text-center"><a href="quotations/{{$invoice->quote_id}}">QU{{$invoice->quotation_number}}
                            </a></td>
                            <td> <a href=' leads/{{$invoice->lead_id}}'>{{$invoice->name}}&nbsp;({{$invoice->lead_number}})</a></td>
                            <td>{{$invoice->company_name}}</td>
                            <?php preg_match('#\((.*?)\)#', $invoice->currency, $match); ?>
                            <td class="text-center">{{$match[1]}}{{$invoice->amount}}</td>
                            <td class="text-center">{{$match[1]}}{{$invoice->paid_amount}}</td>
                            <td class="text-center">{{$match[1]}}{{$invoice->due_amount}}</td>
                            <td class="">{{$invoice->public_notes}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pull-right" id="inv">
                    {{$invoices->links()}}
                </div>
            </div>
        </div>
    </div>