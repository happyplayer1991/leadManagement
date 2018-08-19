
    <div class="col-md-12">
        <div class="pull-right">
             <form action="{{url('products/create')}}" method="get" id="modal_fade" >
                <input type="submit" class="btn btn-primary" value="Create Product">
            </form>
        </div>
    </div>
    <div class="col-lg-12">
        <div id="ajaxContent">
            @include('product.datatable')
        </div>
    </div>
@push('scripts')
<script>
    $(function () {
        $('#clients-table').DataTable();
        // $('#clients-table').DataTable({
        //     processing: true,
        //     serverSide: true,

        //     ajax: '{!! route('clients.data') !!}',
        //     columns: [

        //         {data: 'namelink', name: 'name'},
        //         // {data: 'company_name', name: 'company_name'},
        //         {data: 'email', name: 'email'},
        //         {data: 'primary_number', name: 'primary_number'},
        //         @if(Entrust::can('client-update'))   
        //         { data: 'edit', name: 'edit', orderable: false, searchable: false},
        //         @endif
        //         @if(Entrust::can('client-delete'))   
        //         { data: 'delete', name: 'delete', orderable: false, searchable: false},
        //         @endif

        //     ]
        // });
    });


   

</script>

@endpush
