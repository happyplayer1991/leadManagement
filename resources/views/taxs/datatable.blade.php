<div class="card">
    <div class="card-content">
        <h4 class="card-title">Item Details</h4>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>                                           
                    <th>Name</th>
                    <th>Rate</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($taxs as $tax) 
                <tr>
                
                    <td>{{$tax->name}}</td>
                    <td>{{$tax->rate}}</td>
                    <td>{{$tax->description}}</td>

                    <td class="">
                     <a action="{{url('taxs/'.$tax->id.'/edit')}}" class="glyphicon glyphicon-edit" style="float: left;" id="modal_fade1">&nbsp;</a>
                        <a action="" class="glyphicon glyphicon-trash" id="taxdelete" style="color: black;" href="{{route('taxs.delete',$tax->id)}}" type="submit" onClick="return confirm('Are you sure?')" > </a>
                        {{--<button  type="submit" onClick="return confirm('Are you sure?')" style="border:none; background:none"><i class="glyphicon glyphicon-trash"></i></button>--}}
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
