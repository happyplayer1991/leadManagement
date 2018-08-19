

<div class="col-lg-12 ">
    <div class="pull-right">
        <form action="{{url('departments/create')}}" method="get" id="modal_fade" >
                <input type="submit" class="btn btn-primary" value="New Departments">
        </form>
    </div>
</div>
<div class="col-md-12">
     <div id="ajaxContent" >
            @include('departments.datatable')
        </div>
</div>


@push('scripts')
    <script>
        $(function () {
            $('#dep-table').DataTable();
            $('#departments').collapse("show");
        });


    </script>
@endpush
