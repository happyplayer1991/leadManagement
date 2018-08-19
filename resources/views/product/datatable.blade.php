<div class="card">
    <div class="card-content">
        <div class="material-datatables table-responsive">
            <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" id="clients-table">
                <thead>
                <tr>
                    <th style="width: 20%">{{ __('Product Name') }}</th>
                    <th>{{__('Price')}}</th>
                    <th>{{__('Description')}}</th>
                    <th>{{__('Actions')}}</th>
                    
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{$product->product_name}}</td>
                    <td>
                        @if(count($c)>0)
                        <?php foreach($c as $curr){} $text = $curr->value; preg_match('#\((.*?)\)#', $text, $match);  ?>
                        {{$match[1]}} {{$product->price}}
                        @else
                        {{$product->price}}
                        @endif
                    </td>
                    <td>{{$product->description}}</td>
                    <td>
                     <a action="{{url('products/'.$product->id.'/edit')}}" class="glyphicon glyphicon-edit" style="float: left;"  id="modal_fade1"> </a>
                     <a action="" class="glyphicon glyphicon-trash" id="productdelete" style="color: black;margin-left: 4%;" href="{{route('product.delete',$product->id)}}" type="submit" onClick="return confirm('Are you sure?')" > </a>
                    </td>
                 </tr>   
                @endforeach
                   
                </tbody>
            </table>
        </div>
    </div>
</div>