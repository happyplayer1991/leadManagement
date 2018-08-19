
    <div class="col-md-12">
        <div class="pull-right">

            @if(count($usersDetails)< env('USER_NUMBER'))
                <a href="{{route('users.create')}}" >
                    <input type="submit" value="Create User" class="btn btn-primary btn2" >
                </a>
            @else
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-content">
                <div class="material-datatables table-responsive">
                    <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width: 100%" id="dep-table">
                        <thead>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Mail') }}</th>
                            <th>{{ __('Mobile Number') }}</th>
                             <th>{{__('Role')}}</th> 
                            <th>{{__('Action')}}</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($usersDetails as $index => $user)
                            <tr>
                                <td><a href='users/{{$user->id}}' style="color:#000000 !important;">{{$user->name}}</a></td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->personal_number}}</td>
                                @foreach($role as $r)
                                    @if($r->id == $user->id)
                                     <td>{{$r->display_name}}</td> 
                                    @endif
                                    @endforeach                                
                                <td><a style= "color:black!important; float: left;" href="{{route('users.edit',$user->id)}}" class="glyphicon glyphicon-edit">&nbsp;</a>
                                    <a action="" class="glyphicon glyphicon-trash" style="color: black;" href="{{route('users.delete',$user->id)}}" type="submit" onClick="return confirm('Are you sure?')"> </a>
                                </td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
        <!-- <div class="card">
            <div class="card-content">
                <div class="material-datatables table-responsive">
                    <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" id="permissions-table">
                        <thead>
                        <td>Month</td>
                        <td>Jan</td>
                        <td>Feb</td>
                        <td>Mar</td>
                        <td>Apr</td>
                        <td>May</td>
                        <td>Jun</td>
                        <td>July</td>
                        <td>Aug</td>
                        <td>Sept</td>
                        <td>Oct</td>
                        <td>Nov</td>
                        <td>Dec</td>
                        </thead>
                        <tbody>
                        <td>Cash</td>
                        <td>$10000</td>
                        <td>$11000</td>
                        <td>$12000</td>
                        <td>$13000</td>
                        <td>$14000</td>
                        <td>$150000</td>
                        <td>$1600</td>
                        <td>$17000</td>
                        <td>$1289</td>
                        <td>$1390009</td>
                        <td>$14990</td>
                        <td>$15909</td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> -->



@push('scripts')
<script>
    $(function () {
        $('#dep-table').DataTable();
        
    });
</script>
@endpush
