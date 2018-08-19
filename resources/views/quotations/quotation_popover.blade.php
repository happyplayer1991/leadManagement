{{--<div id="create_modal" class="modal fade" role="dialog">--}}
    {{--<div class="modal-dialog">--}}
        {{--<div class="modal-content " style=" width: 155%; margin-left: -22%;">--}}
            {{--<div class="modal-header">--}}
                {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                {{--<legend class="modal-title text-center">Add Quotation</legend>--}}
            {{--</div>--}}
            {{--<div class="modal-body">--}}
{{--{!! Form::open([--}}
            {{--'url' => 'quotations/popover',--}}
            {{--'class' => 'quote-form',--}}
            {{--'id'    =>  'submit_form'--}}
            {{--]) !!}--}}
    {{--<div class="card">--}}
    {{--<div class="card">--}}
        {{--<div class="card-content">--}}
            {{--<div class="row">--}}
                {{--<div class="col-md-12">--}}
                    {{--<div class="col-md-4">--}}
                        {{--<div class="form-group label-floating">--}}
                            {{--<label class="label-control">Quote Number<font color="red">*</font></label>--}}
                            {{--<input type="text" class="form-control" value="{{$quotation_number}}" name="quote_number">--}}
                        {{--</div>--}}

                    {{--</div>--}}
                    {{--<div class="col-md-4">--}}
                        {{--<div class="form-group label-floating">--}}
                            {{--<label class="label-control">Quotation Date<font color="red">*</font></label>--}}
                            {{--<input id="date" type="date" class="form-control" name="quote_date" value="{{carbon::now()->format('Y-m-d')}}" style="cursor: pointer;">--}}
                        {{--</div>--}}

                    {{--</div>--}}

                    {{--<div class="col-md-4">--}}
                        {{--<div class="form-group label-floating">--}}
                            {{--<label class="label-control">Lead Name<font color="red">*</font></label>--}}
                            {{--<div>--}}
                                {{--<input type="text" class="form-control" value="{{$leads->name}}">--}}
                                {{--<input type="hidden" value="{{$leads->id}}" name="leads" />--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="col-md-4">--}}
                        {{--<div class="form-group label-floating">--}}
                            {{--<label class="label-control"> Address<font color="red">*</font></label>--}}
                            {{--<input type="address" class="form-control" value="{{$leads->address}}" id="lead_address" name="quote_address">--}}

                        {{--</div>--}}

                    {{--</div>--}}


                    {{--<div class="col-md-4">--}}
                        {{--<div class="form-group label-floating">--}}
                            {{--<label class="label-control"> Discount(%)</label>--}}
                            {{--<input type="number" class="form-control" id="quote_discount" name="quote_discount">--}}
                        {{--</div>--}}

                    {{--</div>--}}
                    {{--<div class="col-md-4">--}}
                            {{--<div class="form-group label-floating">--}}
                                {{--<label class="label-control">Currency <font color="red">*</font></label>--}}
                                {{--<div >--}}
                                   {{--<!--  <input type="text" class="form-control" value="" name="currency" id="currency"> -->--}}
                                {{--<select  name="currency" id="currency"   style="width: 100%; margin-top: 5%; border-right: none;  border-top: none;  border-left: none; background-color: white;">--}}
                                    {{--<option ></option>--}}
                                {{--@foreach($currency as $curr)--}}
                                    {{--<option value="{{$curr->currency_code}}({{$curr->symbol}})" data-symbol="{{$curr->symbol}}" >{{$curr->currency_code}}({{$curr->symbol}})</option>--}}
                                {{--@endforeach--}}

                                {{--</select>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                    {{--</div>--}}

                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
        {{--<div class="card">--}}
            {{--<div class="card-content">--}}
            {{--<h4 class="card-title">Item Details</h4>--}}
            {{--<div class="table-responsive">--}}
                {{--<table class="table table-striped" id="quotation_items_table">--}}
                    {{--<thead>--}}
                    {{--<tr>--}}

                        {{--<th>Product Name</th>--}}
                        {{--<th>Description</th>--}}
                        {{--<th>Price</th>--}}
                        {{--<th>Quantity</th>--}}
                        {{--<th class="">Total--}}
                        {{--<th></th>--}}


                    {{--</tr>--}}
                    {{--</thead>--}}
                    {{--<tbody>--}}

                    {{--<tr class="tr_clone">--}}
                        {{--<td class="">--}}
                           {{--<select class=" quote_products select2" name="products[]" id="product">--}}
                                {{--<option></option>                                    --}}
                                {{--@foreach($products as $product)--}}
                                    {{--<option  value="{{$product->id}}" data-price="{{$product->price}}" data-description="{{$product->description}}" data-product="{{$product->product_name}}">{{$product->product_name}}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                            {{--<input type="hidden" name="product_name[]" class="product_name">--}}
                        {{--</td>--}}

                        {{--<td >--}}
                            {{--<textarea rows="1" cols="40" class="description" name="description[]">--}}
                            {{--</textarea>--}}
                        {{--</td>--}}
                        {{--<td> <input type="number" class="form-control price" name="price[]"></td>--}}
                        {{--<td> <input type="number" class="form-control quantity" name="quantity[]"></td>--}}


                        {{--<td class="text-center"><span class="symbol"></span><span class="line_total"></span><input type="hidden" name="line_total[]" class="line_total"></td>--}}
                        {{--<td style="cursor: pointer; font-size: large;"><a style="color: indianred" class="tr_clone_minus"><i class="fa fa-minus-circle redlink"></i></a></td>--}}

                    {{--</tr>--}}

                    {{--</tbody>--}}
                {{--</table>--}}
            {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

    {{--<div class="card">--}}
        {{--<div class="card-content">--}}
            {{--<div class="row">--}}
                {{--<div class="col-md-12">--}}
                    {{--<div class="col-md-6">--}}
                        {{--<p>Final Amount:</p>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-6">--}}
                        {{--<p>Total Price:<span class="symbol"></span><span id="total_price"></span><input type="hidden" name="total_price" class="total_price"/></p>--}}
                        {{--<p>--}}
                            {{--Discount(%):&nbsp<span id="discount_rate">--}}

                            {{--</span>--}}
                        {{--</p>--}}
                        {{--@if(count($taxs)>0)--}}
                        {{--<p>--}}
                            {{--Tax: <span  id="quote_tax"></span><input type="hidden" class="quote_tax" name="quote_tax"/>--}}
                            {{--<select class="selectpicker" data-live-search="true" data-style="select-with-transition" id="tax" name="tax">--}}
                                {{--<option></option>--}}
                                {{--@foreach($taxs as $tax)--}}
                                    {{--<option value="{{$tax->id}}" data-rate="{{$tax->rate}}">{{$tax->name}}({{$tax->rate}})%</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                           {{----}}
                        {{--</p>--}}
                        {{--@else--}}
                            {{--<input type ="hidden" name="quote_tax" />--}}
                        {{--@endif--}}
                        {{--<p>--}}
                            {{--Gross Price:--}}
                            {{--<span class="symbol"></span><span id="gross_price">--}}

                            {{--</span><input type="hidden" name="gross_price" class="gross_price"/>--}}
                        {{--</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

        {{--</div>--}}
    {{--</div>--}}


    {{--<div class="card">--}}
        {{--<div class="card-content">--}}
            {{--<h4 class="card-title">Terms and Conditions</h4>--}}
            {{--<p>--}}
                {{--30 days, Shipped to Location--}}
                {{--Unless otherwise agreed in writing by the supplier all invoices are payable within thirty(30) days of the date of invoice,--}}
                {{--in the currency of the invoice, drawn on a bank based in india or by such other method as id agrred in advance by supplier.--}}
            {{--</p>--}}
            {{--<p>--}}
                {{--All prices are not inclusive of VAT which shall be payable in addition by the Customer at the applicable rate.--}}
            {{--</p>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="pull-right" >--}}

        {{--<input type="submit" class="btn btn-primary" name="submit" value="Submit">--}}

        {{--<input type="button" class="btn btn-primary " onclick="goBack()" id="cancel" value="Cancel">--}}


    {{--</div>--}}
   {{----}}
    {{--</div>--}}
{{--{!! Form::close() !!}--}}
{{--</div>--}}
                    {{----}}


        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}