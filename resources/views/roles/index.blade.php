
    <div class="col-lg-12 ">
        <div class="card">
            <div class="card-content">
                <div class="material-datatables">
                    <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" >


                        <thead>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Description') }}</th>
                            <!--  <th>{{ __('Action') }}</th> -->
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($roles as $role)
                            <tr>
                                <td>{{$role->display_name}}</td>
                                <td>{{Str_limit($role->description, 50)}}</td>

                                <!-- <td>   {!! Form::open([
            'method' => 'DELETE',
            'route' => ['roles.destroy', $role->id]
        ]); !!}
                                @if($role->id !== 1)
                                {!! Form::submit(Lang::get('Delete'), ['class' => 'btn btn-danger', 'onclick' => 'return confirm("Are you sure?")']); !!}
                                @endif
                                {!! Form::close(); !!}</td>
                    </td> -->
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!--  <a href="{{ route('roles.create')}}">
            <button class="btn btn-success">{{ __('Add new Role') }}</button>
        </a> -->
    </div>

