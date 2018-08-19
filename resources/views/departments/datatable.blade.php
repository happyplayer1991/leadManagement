    <div class="card">
        <div class="card-content">
            <div class="material-datatables table-responsive">
                <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" id="dep-table">
                    <thead>
                    <tr>
                        <th >{{ __('Department Name') }}</th>
                        <th >{{ __('Department Description') }}</th>
                        <th class="disabled-sorting text-right">{{__('Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($departmentsDetails as $index => $department)
                        <tr>
                            <td style="width: 20%">{{$department->name}}</td>
                            <td style="width: 40%;word-wrap: break-word;">{{$department->description}}</td>
                            <td class="pull-right">
                                @if(Entrust::hasRole('administrator'))

                                    <a action="{{url('departments/'.$department->id.'/edit')}}" class="glyphicon glyphicon-edit" style="float: left;"  id="modal_fade1"> </a>


                                    {!! Form::open(['method' => 'DELETE','route' => ['departments.destroy', $department->id],'style'=>'float:inherit;']); !!}


                                    <button type="submit" onClick="return confirm('Are you sure?')" style="border:none; background:none"><i class="glyphicon glyphicon-trash"></i></button>



                                    {!! Form::close(); !!}

                                @endif
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>