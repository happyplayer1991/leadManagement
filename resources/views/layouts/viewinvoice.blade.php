@extends('layouts.master')
@section('heading')
    View Invoice
@stop

@section('content')
{!! Form::open([
            'route' => ['invoice.update',$invoices->id],
            'class' => 'ui-form',
            'id'    =>  'invoice_form'
            ]) !!}
    <div class="card">
        <div class="card">
            <div class="card-content">
                <div class="row">
               
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group label-floating">
                                <label class="label-control">Invoice Number<font color="red">*</font></label>
                                <input type="number" class="form-control" value="{{$invoices->invoice_number}}" readonly>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group label-floating">
                                <label class="label-control">Invoice Date<font color="red">*</font></label>
                                <input id="date" type="text" class="form-control datepicker" value="{{$invoices->invoice_date}}" readonly>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group label-floating">
                                <label class="label-control">Quotation Number<font color="red">*</font></label>
                                <input type="number" class="form-control" value="{{$invoices->quotation_number}}" readonly>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group label-floating">
                                <label class="label-control">Quotation Date<font color="red">*</font></label>
                                <input id="date" type="date" class="form-control datepicker" value="{{$quotations->quotation_date}}" readonly>
                            </div>

                        </div>

                        <div class="col-md-4">
                            <div class="form-group label-floating">
                                <label class="label-control">Lead Name<font color="red">*</font></label>

                                <input type="address" class="form-control" value="{{$lead_name->name}}" readonly>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group label-floating">
                                <label class="label-control"> Address<font color="red">*</font></label>
                                <input type="address" class="form-control" value="{{$quotations->address}}" readonly>
                            </div>

                        </div>


                        <div class="col-md-4">
                            <div class="form-group label-floating">

                                <label class="label-control"> Discount(%):</label>
                                <input type="number" class="form-control" value="{{$quotations->discount}}" readonly>

                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group label-floating">
                                <label class="label-control">Currency<font color="red">*</font> </label>
                                <input type="text" class="form-control" value="{{$quotations->currency}}" readonly>
                            </div>
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
                        @foreach($quotation_items as $items)
                        <tr>
                             <td class="">{{$items->product_key}}</td>
                            <td>{{$items->description}}</td>
                            <td>{{$items->qty}}</td>
                            <?php preg_match('#\((.*?)\)#', $invoices->currency, $match); ?>
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
                              <p>Total Price:<span>{{$match[1]}}&nbsp;{{$quotations->total_price}}</span></p>
                            <p>Discount:<span>{{$invoices->discount}}%</span></p>
                            <p>Tax:<span>{{$match[1]}}&nbsp;{{$invoices->tax_amount}}</span></p>
                            <p>Gross Price:<span id="">{{$match[1]}} <span id="gross_price">{{$invoices->amount}}</span></span></p>

                        @if($invoices->due_amount != 0)
                            <p>Paid:<span>{{$match[1]}} <input type="number" name="payed" id="payed" value=""/></span></p>
                             <p>Due: {{$invoices->due_amount}}</p>
                            <!-- <p>Due:<span>{{$match[1]}} <input type="number" name="due" id="due"  value="{{$invoices->due_amount}}"/></span></p>
                             -->
                            @endif
                            
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
        
        <div class="pull-right"  >
            <button type="button" class="btn btn-primary" onclick="goBack()">Cancel</button>
            
            <button type="button" class="btn btn-primary" onclick="emailAddress({{$invoices->id}},this)">Send Email</button>
            @if($invoices->due_amount != 0)
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
            @endif
        </div>  
    </div>
    <div id="modal_window">
    </div>
{!! Form::close() !!}
<script>
function goBack() {
   window.location.href="/invoices";
}
</script>
@stop