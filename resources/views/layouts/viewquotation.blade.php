@extends('layouts.master')
@section('heading')
    View Quotation
@stop

@section('content')

    {{--{!! Form::textarea('comment',null, ['class' => 'form-control' , 'rows' => '1' , 'id' => 'comment','placeholder'=>'Comment...']) !!}--}}
    <div class="card">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="" >
                @if($quotation->status=="Approved")
                    <button class="btn btn-success">{{$quotation->status}}</button>
                @elseif($quotation->status=="Rejected")
                    <button class="btn btn-danger">{{$quotation->status}}</button>&nbsp;&nbsp;<font style="color: red">{{$quotation->reason}}</font>
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="pull-right" >
                        <a href="{{route('quotations.create')}}" class="btn btn-primary">Add Quotation</a>
                    </div>
                </div>


                @elseif($quotation->status=="Pending")
                    <button class="btn btn-warning">{{$quotation->status}}</button>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="pull-right" >
                    <a href="{{route('layouts.edit', $quotation->id)}}" class="btn btn-primary" >Modify</a>
                    </div>
                    </div>
                @else($quotation->status=="Submitted")
                    <button class="btn btn-primary">{{$quotation->status}}</button>
                @endif
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group label-floating">
                                <label class="label-control">Quote Number<font color="red">*</font></label>
                                <input type="number" class="form-control" value = "{{$quotation->quotation_number}}" readonly>

                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group label-floating">
                                <label class="label-control">Quotation Date<font color="red">*</font></label>
                                <input id="date" type="date" class="form-control datepicker" value="{{$quotation->quotation_date}}" readonly>
                            </div>

                        </div>

                        <div class="col-md-4">
                            <div class="form-group label-floating">
                                <label class="label-control">Lead Name<font color="red">*</font></label>
                                <input type="name" class="form-control" value="{{$lead_name->name}}" readonly>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group label-floating">
                                <label class="label-control"> Address<font color="red">*</font></label>

                                <input type="address" class="form-control" value ="{{$quotation->address}}" readonly>
                            </div>

                        </div>

                        <div class="col-md-4">
                            <div class="form-group label-floating">
                                <label class="label-control"> Discount(%)</label>

                                <input type="number" class="form-control" value="{{$quotation->discount}}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                <h4 class="card-title">Item Details</h4>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>

                            <th>Product Name</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th class="">Total Price</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php preg_match('#\((.*?)\)#', $quotation->currency, $match); ?>
                        @foreach($quotation_items as $items)
                            <tr>
                                <td class="">{{$items->product_key}}</td>
                                <td style="width:35%">{{$items->description}}</td>
                                <td>{{$items->qty}}</td>
                                <td>{{$match[1]}}&nbsp;{{$items->price}}</td>
                                <td class="">{{$match[1]}}&nbsp;{{$items->total}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <p>Final Amount:</p>
                        </div>
                        <div class="col-md-6">
                            <p>Total Price: <span>{{$match[1]}}&nbsp;{{$quotation->total_price}}</span></p>
                            <p>Discount: <span style="color: green">{{$match[1]}} {{$quotation->discount}}%</span></p>
                            <p>Tax: <span style="color: red">{{$match[1]}}&nbsp;{{$quotation->tax_amount}}</span></p>
                            <p>Gross Price:<span style="color: blue">{{$match[1]}}&nbsp;{{$quotation->amount}}</span></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <h4 class="card-title">Terms and Conditions</h4>
                <p>
                    30 days, Shipped to Location
                    {{--Unless otherwise agreed in writing by the supplier all invoices are payable within thirty(30) days of the date of invoice,--}}
                    {{--in the currency of the invoice, drawn on a bank based in india or by such other method as id agrred in advance by supplier.--}}
                </p>
                {{--<p>--}}
                {{--All prices are not inclusive of VAT which shall be payable in addition by the Customer at the applicable rate.--}}
                {{--</p>--}}
            </div>
        </div>
        @if($lead_name->drop_status == "")


        {!! Form::open([
                'url' => array('/quotations/updateStatus',$quotation->id ),
                'class' => 'ui-form',
                'id'    =>  'lead_form'
                ]) !!}
        <div class="card">
            <div class="card-content">
                <div class="form-group label-floating">

                    {!! Form::textarea('comment',null, ['class' => 'form-control' , 'rows' => '1' , 'id' => 'comment1','placeholder'=>'Comment...','name'=>'reason']) !!}


                </div>
            </div>
        </div>
        <div class="pull-right" >

            @if($quotation->status == "Approved")
                @if($invoices != 0)
                @foreach($inv as $invoice)
                <div class="pull-right" >
                    <a href="{{ url('invoices',$invoice->id) }}" class="btn btn-primary" >Go To Invoice</a>
                </div>
                @endforeach
                @else
                <div class="pull-right" >
                    <a href="{{route('invoice.create', $quotation->id)}}" class="btn btn-primary" >Convert To Invoice</a>
                </div>
                @endif
            @else


                @if($quotation->status == "Pending")
                    <button type="submit" class="btn btn-primary" value="submit" name="status">Submit</button>
                    <button type="button" class="btn btn-primary" onclick="goBack()">Back</button>
                @endif
                @if(Entrust::hasRole('administrator'))
                    @if($quotation->status == "Submitted")
                        <div class="pull-right"  >
                            <button type="submit" class="btn btn-primary" value="Approved" name="status">Approved</button>
                            <button type="submit" id="reject" class="btn btn-primary" value="Rejected" name="status">Rejected</button>
                        </div>

                    @endif
                @endif
                @if($quotation->status == "rejected")
                <div class="pull-right" >
                <button type="button" class="btn btn-primary" onclick="goBack()">Back</button>
                </div>
                @endif
                {!! Form::close() !!}

            @endif

        </div>
            @else
            <p class="text-center"><strong style="color: red; font-size: 17px;">Lead has dropped</strong></p>
            @endif
    </div>
        <div id="modal_window">
        </div>

<script>
function goBack() {
    window.location.href="/quotations";
}
</script>
@stop