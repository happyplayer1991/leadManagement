
    {!! Form::model($department, [
            'method' => 'PATCH',
            'route' => ['departments.update', $department->id],
            'id' => 'submit_form'
            ]) !!}
    @include('departments.form', ['submitButtonText' => __('Update Department'), 'submitButton' => ' Cancel'])

    {!! Form::close() !!}

