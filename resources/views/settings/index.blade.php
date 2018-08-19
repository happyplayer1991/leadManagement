
    <div class="row">
        <div class="col-lg-12">

        </div>
        @foreach($roles as $role)

            {!! Form::model($permission, [
                'method' => 'PATCH',
                'url'    => 'settings/permissionsUpdate',
            ]) !!}
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-content">
                        <div class="material-datatables table-responsive">
                            <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" id="permissions-table">
                                <thead>
                                <tr>
                                    <th></th>
                                    @foreach($permission as $perm)
                                        <th>{{$perm->display_name}}</th>

                                    @endforeach
                                    <th>Save</th>
                                </tr>

                                </thead>
                                <tbody>
                                <input type="hidden" name="role_id" value="{{ $role->id }}"/>
                                <tr>
                                    <td><strong>
                                            @if($role->display_name== "Administrator")
                                                Admin
                                            @else

                                            {{$role->display_name}}
                                        @endif</strong></td>
                                    @foreach($permission as $perm)
                                        <?php $isEnabled = !current(
                                                array_filter(
                                                        $role->permissions->toArray(),
                                                        function ($element) use ($perm) {
                                                            return $element['id'] === $perm->id;
                                                        }
                                                )
                                        );  ?>

                                        <td><input type="checkbox"
                                                   <?php if (!$isEnabled) echo 'checked' ?> name="permissions[ {{ $perm->id }} ]"
                                                   value="1" data-role="{{ $role->id }}">
                                            <span class="perm-name"></span><br/></td>


                                    @endforeach
                                    <td>

                                        <button type="submit" value="Save Role" class="btn btn-primary ">Save </button>

                                    </td>

                                </tr>
                                </tbody>
                            </table>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>



    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-content">
                    <h2 >{{ __('Overall Settings') }}</h2>


                    {!! Form::model($settings, [
                       'method' => 'PATCH',
                       'url' => 'settings/overall'
                       ]) !!}

                            <!-- *********************************************************************
     *                     Task complete       
     *********************************************************************-->
                    <div class="panel panel-default movedown">
                        <div class="panel-heading">{{ __('Task completion') }}</div>
                        <div class="panel-body">

                            {{ __('If Allowed only user who are assigned the task & the admin can complete the task.') }} <br/>
                            {{ __('If Not allowed anyone, can complete all tasks.')}}
                        </div>
                    </div>
                    {!! Form::select('task_complete_allowed',
                    [
                        1 => __('Allowed'),
                        2 => __('Not allowed')
                    ],
                    $settings->task_complete_allowed, ['class' => 'form-control']) !!}
                            <!-- *********************************************************************
     *                     Task assign       
     *********************************************************************-->
                    <div class="panel panel-default movedown">
                        <div class="panel-heading">{{ __('Task assigning') }}</div>
                        <div class="panel-body">

                            {{ __('If Allowed only user who are assigned the task &amp; the admin can assign another user.') }} <br/>
                            {{ __('If Not allowed anyone, can assign another user.') }}
                        </div>
                    </div>
                    {!! Form::select('task_assign_allowed',
                    [
                        1 => __('Allowed'),
                        2 => __('Not allowed')
                    ],
                    $settings->task_assign_allowed, ['class' => 'form-control']) !!}
                            <!-- *********************************************************************
     *                     Lead complete       
     *********************************************************************-->

                    <div class="panel panel-default movedown">
                        <div class="panel-heading">{{ __('Lead completion') }}</div>
                        <div class="panel-body">

                            {{ __('If Allowed only user who are assigned the lead & the admin can complete the lead.') }} <br/>
                            {{ __('If Not allowed anyone, can complete all leads.')}}
                        </div>
                    </div>
                    {!! Form::select('lead_complete_allowed', [
                        1 => __('Allowed'),
                        2 => __('Not allowed')
                    ],
                    $settings->lead_complete_allowed, ['class' => 'form-control']) !!}
                            <!-- *********************************************************************
     *                     Lead assign       
     *********************************************************************-->
                    <div class="panel panel-default movedown">
                        <div class="panel-heading">{{ __('Lead assigning') }}</div>
                        <div class="panel-body">

                            {{ __('If Allowed only user who are assigned the lead & the admin can complete the lead.') }} <br/>
                            {{ __('If Not allowed anyone, can complete all leads.')}}
                        </div>
                    </div>
                    {!! Form::select('lead_assign_allowed',
                    [
                        1 => __('Allowed'),
                        2 => __('Not allowed')
                    ],
                    $settings->lead_assign_allowed, ['class' => 'form-control']) !!}
                    <br/>
                    {!! Form::submit( __('Save overall settings'), ['class' => 'btn btn5 btn-primary']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
 


