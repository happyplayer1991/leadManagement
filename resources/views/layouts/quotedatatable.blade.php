    <div class="card">
        <div class="card-content">
            <h4 class="card-title">Quotation Table</h4>
            <div class="material-datatables table-responsive">
                <table id="quotation-table" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width: 100%">
                    <thead>
                    <tr>
                        <th style="text-align:center">Quote Number</th>
                        <th>Lead Name</th>
                        <th>Company</th>
                        <th style="text-align:center" >Amount</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($quotations as $quotation)
                    <tr>
                        <?php preg_match('#\((.*?)\)#', $quotation->currency, $match); ?>
                        <td class="text-center"><a href="quotations/{{$quotation->id}}">QU{{$quotation->quotation_number}}
                                <div><span style="color: black;font-size: 10px;font-weight: 500;">&nbsp;( <time class="timeago" datetime="{{$quotation->created_at}}"></time>)</span></div></a></td>
                        <td><a href=' leads/{{$quotation->lead_id}}'>{{$quotation->name}}&nbsp;({{$quotation->lead_number}})</a></td>
                        <td>{{$quotation->company_name}}</td>
                        <td class="text-center quotestatus">{{$match[1]}}&nbsp;{{$quotation->amount}}</td>
                        <td class="">{{$quotation->status}}</td>
                    </tr>
                    @endforeach
                        
                    </tbody>
                </table>
                <div class="pull-right" id="quota">
                    {{$quotations->links()}}
                </div>
            </div>
        </div>
    </div>