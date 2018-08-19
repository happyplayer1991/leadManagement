
    <div id="intrest_lead" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content" style="overflow-y: scroll; max-height: 400px;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title text-center">Eligible pending leads for quote and invoice</h5>
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Lead Number</th>
                        <th>Lead Name</th>
                        <th>Company</th>
                        <th class="">Product</th>
                    </tr>
                    </thead>
                    @foreach($leadDetails as $leadDetail)
                    <tbody>

                    <td><a href=' leads/{{$leadDetail->id}}'>{{$leadDetail->lead_number}}</a></td>
                        <td><a href=' leads/{{$leadDetail->id}}'>{{$leadDetail->name}}
                                <div><span style="color: black;font-size: 10px;font-weight: 500;">&nbsp( <time class="timeago" datetime="{{$leadDetail->created_at}}"></time>)</span></div></a></td>
                        <td>{{$leadDetail->company_name}}</td>
                        <td>{{$leadDetail->product_name}}</td>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
