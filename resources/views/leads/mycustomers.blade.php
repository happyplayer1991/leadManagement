<div class="card">
    <div class="card-content">
        <h4 class="card-title">Contact Table</h4>

        <div class="table-responsive">
            <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width: 100%" id="clients-table">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Lead</th>
                        <th>Company</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        let tbl_clients = $('#clients-table').dataTable({
            serverSide: true,
            iDisplayLength : 10,
            ajax: {
                "url": "{{URL::to('/leads/getCustomers')}}",
                "type": "POST",
                "data": {
                    _token: "{{csrf_token()}}",
                    search: function ( d ) {
                        return [
                            $('#filterForm-customers input[name="lead_name"]').val(),
                            $('#filterForm-customers input[name="company"]').val(),
                        ]
                    }
                },
                "beforeSend": function() {
                    $('#filterForm-customers .btn').attr('disabled', 'true');
                    $('#clients-table tbody').empty().html('<tr role="row" class="odd loading"><td colspan="4"><i class="fa fa-spin fa-refresh"></i></td></tr>');
                },
                "complete": function() {
                    $('#filterForm-customers .btn').removeAttr('disabled');
                }
            },
            language: {
                paginate: {
                    next: "»",
                    previous: "«",
                }
            },
            searching: false,
            info: false,
            length: false,
            bLengthChange: false
        });

        $('#filterForm-customers .reset').on('click', function () {
            $('#filterForm-customers input').val('');
            tbl_clients.fnDraw();
        });

        $('#filterForm-customers .apply').on('click', function () {
            tbl_clients.fnDraw();
        });
    });
</script>