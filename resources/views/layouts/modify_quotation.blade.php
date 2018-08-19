@extends('layouts.master')
@section('heading')
    Modify Quotation
@stop

@section('content')
        {!! Form::open([
        'url' => array('/quotations/update',$quotation->id ),
        'class' => 'ui-form',
        'id'    =>  'lead_form'
        ]) !!}
    <div class="card">
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-4">
                        <div class="form-group label-floating">
                            <label class="label-control">Quote Number<font color="red">*</font></label>
                            <input type="text" class="form-control" value="{{$quotation_number}}" name="quote_number">
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="form-group label-floating">
                            <label class="label-control">Quotation Date<font color="red">*</font></label>
                            <input id="date" type="date" class="form-control" name="quote_date" value="{{carbon::now()->format('Y-m-d')}}" style="cursor: pointer;">
                        </div>

                    </div>
                    @foreach($leads as $lead)
                    <div class="col-md-4">
                        <div class="form-group label-floating">
                            <label class="label-control">Lead Name<font color="red">*</font></label>
                            <!-- <div>@foreach($leads as $lead)
                                <input type="text" class="form-control" value="{{$lead->name}}" name="lead_name">                                
                                @endforeach -->
                           <select class="selectpicker"  data-style="select-with-transition" name="leads" data-size="5" id="lead_id" placeholder="Assign Lead ..">
                                
                                    <option value="{{$lead->id}}" data-address="{{$lead->address}}">{{$lead->name}}</option>
                                
                           </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group label-floating">
                            <label class="label-control"> Address<font color="red">*</font></label>
                            <input type="address" class="form-control" id="lead_address" name="quote_address" value="{{$lead->address}}">
                        </div>

                    </div>

                    @endforeach
                    <div class="col-md-4">
                        <div class="form-group label-floating">
                            <label class="label-control"> Discount(%)</label>
                            <input type="number" class="form-control" id="quote_discount" name="quote_discount">
                        </div>

                    </div>
                    <div class="col-md-4">
                            <div class="form-group label-floating">
                                <label class="label-control">Currency <font color="red">*</font></label>
                                <div >
                                <!-- <select class="selectpicker" data-live-search="true" data-style="select-with-transition" data-size="7" name="currency" id="currency">
                                    <option ></option>
                                @foreach($currency as $curr)
                                    <option value="{{$curr->currency_code}}({{$curr->symbol}})" data-symbol="{{$curr->symbol}}">{{$curr->currency_code}}({{$curr->symbol}})</option>
                                @endforeach

                                </select> -->
                                <?php foreach($currency as $curr){} $text = $curr->value; preg_match('#\((.*?)\)#', $text, $match); ?>
                                <input type="text" class="form-control" value="{{$curr->value}}" id="currency" name="currency" readonly="true">
                                </div>
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
                <table class="table table-striped" id="quotation_items_table">
                    <thead>
                    <tr>

                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th class="">Line Total
                        <th></th>


                    </tr>
                    </thead>
                    <tbody>

                    <tr class="tr_clone">
                        <td class="">
                           <select class=" quote_products select2" name="products[]" id="product">
                                <option></option>                                    
                                @foreach($products as $product)
                                    <option  value="{{$product->id}}" data-price="{{$product->price}}" data-description="{{$product->description}}" data-product="{{$product->product_name}}">{{$product->product_name}}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="product_name[]" class="product_name">
                        </td>

                        <td >
                            <textarea rows="1" cols="40" class="description" name="description[]">
                            </textarea>
                        </td>
                        <td> <input type="number" class="form-control price" name="price[]"></td>
                        <td> <input type="number" class="form-control quantity" name="quantity[]"></td>


                        <td class="text-center"><span>{{$match[1]}} </span><span class="line_total"></span><input type="hidden" name="line_total[]" class="line_total"></td>
                        <td style="cursor: pointer; font-size: large;"><a style="color: indianred" class="tr_clone_minus"><i class="fa fa-minus-circle redlink"></i></a></td>

                    </tr>

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
                        <p>Total Price: <span>{{$match[1]}} </span><span id="total_price"></span><input type="hidden" name="total_price" class="total_price"/></p>
                        <p>
                            Discount: <span>{{$match[1]}} </span><span id="discount_rate"></span>

                            
                        </p>
                        @if(count($taxs)>0)
                        <p>
                            Tax: <span>{{$match[1]}} </span><span  id="quote_tax"></span><input type="hidden" class="quote_tax" name="quote_tax"/>
                            <select class="selectpicker" data-live-search="true" data-style="select-with-transition" id="tax" name="tax">
                                <option value="">Select Tax ...</option>
                                @foreach($taxs as $tax)
                                    <option value="{{$tax->id}}" data-rate="{{$tax->rate}}">{{$tax->name}}({{$tax->rate}})%</option>
                                @endforeach
                            </select>
                           
                        </p>
                        @else
                            <input type ="hidden" name="quote_tax" />
                        @endif
                        <p>
                            Gross Price:
                            <span>{{$match[1]}} </span><span id="gross_price">

                            </span><input type="hidden" name="gross_price" class="gross_price"/>
                        </p>
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
    <div class="pull-right" >

        <button type="submit" class="btn btn-primary"  name="save" value="save">Save</button>
        <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
        <button type="button" class="btn btn-primary" onclick="goBack()">Cancel</button>


    </div>
    <div id="modal_window">
    </div>
    </div>
{!! Form::close() !!}
<script>
function goBack() {
    window.location.href="/quotations";
}
</script>
@stop
