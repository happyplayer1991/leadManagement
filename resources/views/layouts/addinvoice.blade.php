@extends('layouts.master')
@section('heading')
    Add Invoice
@stop

@section('content')
{!! Form::open([
            'route' => 'invoices.store',
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
                                <input type="number" class="form-control" value ="{{$invoice_number}}" name="invoice_number" readonly>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group label-floating">
                                <label class="label-control">Invoice Date<font color="red">*</font></label>
                                <input id="date1" type="date" class="form-control datepicker" name="invoice_date" value="{{carbon::now()->format('Y-m-d')}}" style="cursor: pointer;" >
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group label-floating">
                                <label class="label-control">Quotation Number<font color="red">*</font></label>
                                <input type="number" class="form-control" value ="{{$quotation->quotation_number}}" name = "quotation_number" readonly>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group label-floating">
                                <label class="label-control">Quotation Date<font color="red">*</font></label>
                                <input id="date" type="date" class="form-control datepicker" value ="{{$quotation->quotation_date}}" readonly>
                            </div>

                        </div>
                        {{--<div class="card-content">--}}
                        {{--<h4 class="card-title">Datetime Picker</h4>--}}
                        {{--<div class="form-group">--}}
                        {{--<label class="label-control">Date Picker</label>--}}
                        {{--<input type="text" class="form-control datepicker" value="10/10/2016" />--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        <div class="col-md-4">
                            <div class="form-group label-floating">
                                <label class="label-control">Lead Name<font color="red">*</font></label>
                                <input type="text" class="form-control" value="{{$lead_name->name}}" readonly>
                                <input type="hidden" class="form-control" value="{{$quotation->lead_id}}" name="lead_id"\>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group label-floating">
                                <label class="label-control"> Address<font color="red">*</font></label>
                                <input type="address" class="form-control" value ="{{$quotation->address}}" readonly>
                            </div>

                        </div>
                        {{--<div class="col-md-4">--}}
                        {{--<select class="selectpicker" data-style="select-with-transition" multiple title="Tax" data-size="5">--}}
                        {{--<option disabled> Tax</option>--}}
                        {{--<option value="2">0% </option>--}}
                        {{--<option value="3">5%</option>--}}
                        {{--<option value="4">12%</option>--}}
                        {{--<option value="5">18%</option>--}}
                        {{--<option value="6">28% </option>--}}
                        {{--</select>--}}
                        {{--</div>--}}

                        <div class="col-md-4">
                            <div class="form-group label-floating">
                                <label class="label-control"> Discount</label>
                                <input type="number" class="form-control" value="{{$quotation->discount}}" readonly>
                            </div>
                            {{--<select class="selectpicker" data-style="select-with-transition" multiple title="Discount" data-size="7">--}}
                            {{--<option disabled> Discount</option>--}}
                            {{--<option value="2">0% </option>--}}
                            {{--<option value="3">5%</option>--}}
                            {{--<option value="4">10%</option>--}}
                            {{--<option value="5">15%</option>--}}
                            {{--<option value="6">20% </option>--}}
                            {{--<option value="7">25% </option>--}}
                            {{--<option value="8">30%</option>--}}
                            {{--<option value="9">35%</option>--}}
                            {{--<option value="10">40%</option>--}}
                            {{--<option value="11">45% </option>--}}
                            {{--<option value="12">50% </option>--}}
                            {{--<option value="13">55%</option>--}}
                            {{--<option value="14">60%</option>--}}
                            {{--<option value="15">65%</option>--}}
                            {{--<option value="16">70% </option>--}}
                            {{--<option value="17">75% </option>--}}
                            {{--<option value="18">80%</option>--}}
                            {{--<option value="19">85%</option>--}}
                            {{--<option value="20">90%</option>--}}
                            {{--<option value="21">95% </option>--}}
                            {{--<option value="22">100% </option>--}}
                            {{--</select>--}}
                        </div>
                        <div class="col-md-4">
                            <div class="form-group label-floating">
                                <label class="label-control">Currency<font color="red">*</font> </label>
                                <input type="text" class="form-control" value="{{$quotation->currency}}" readonly>
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
                                <td style="width:35%">{{$items->description}}</td>
                                <td>{{$items->qty}}</td>
                                <?php preg_match('#\((.*?)\)#', $quotation->currency, $match); ?>
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
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <p>Final Amount:</p>
                        </div>
                        <div class="col-md-6">
                             <p>Total Price:<span>{{$match[1]}}&nbsp;{{$quotation->total_price}}</span><input type="hidden" value="{{$quotation->total_price}}" name="total_price"/></p>
                            <p>Discount:<span>{{$quotation->discount}}%</span></p>
                            <p>Tax:<span>{{$match[1]}}&nbsp;{{$quotation->tax_amount}}</span></p>
                            <p>Gross Price with Taxes:{{$match[1]}}&nbsp;<span id="gross_price">{{$quotation->amount}}</span><input type="hidden" value="{{$quotation->amount}}" name="amount"/></p>
                            <p>Paid:<span>{{$match[1]}} <input type="text" name="payed" id="payed"/></span></p>
                            <p>Due:<span>{{$match[1]}} <input type="text" name="due" id="due"  value="{{$quotation->due_amount}}"/></span></p>
                            <input type="hidden" value="{{$quotation->id}}" name="quotation_id"/>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="pull-right" style="margin-bottom: 10%;" >
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
            <button type="button" class="btn btn-primary" onclick="goBack()">Cancel</button>
        </div>
    </div>
    <div id="modal_window">
    </div>
{!! Form::close() !!}
<script>
function goBack() {
    window.location.href="/quotations";
}
</script>
@stop