
    {!! Form::open([
            'route' => 'departments.store',
            'files'=>true,
            'enctype' => 'multipart/form-data',
            'id' => 'submit_form'
            ]) !!}

    @include('departments.form', ['submitButtonText' => __('Create Department'),'submitButton' => 'Cancel'])

    {!! Form::close() !!}



@push('scripts')
    <script>
        $(function () {
            $('#departments').collapse("show");
        });


    </script>
@endpush