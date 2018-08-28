<div class="card">
    <div class="card-content">
        <h4 class="card-title">Contact Table</h4>

        <div class="table-responsive">
            <table id="contacts-table" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width: 100%">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Lead </th>
                        <th>Company</th>
                        <th class="">Status</th>
                        <th>Action</th>
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
        let tbl_contacts = $('#contacts-table').dataTable({
            serverSide: true,
            iDisplayLength : 10,
            ajax: {
                "url": "{{URL::to('/leads/getContacts')}}",
                "type": "POST",
                "data": {
                    _token: "{{csrf_token()}}",
                    search: function ( d ) {
                        return [
                            $('#filterForm-contact input[name="lead_name"]').val(),
                            $('#filterForm-contact input[name="company"]').val(),
                            $('#filterForm-contact select[name="status"]').val()
                        ]
                    }
                },
                "beforeSend": function() {
                    $('#filterForm-contact .btn').attr('disabled', 'true');
                    $('#contacts-table tbody').empty().html('<tr role="row" class="odd loading"><td colspan="5"><i class="fa fa-spin fa-refresh"></i></td></tr>');
                },
                "complete": function() {
                    $('#filterForm-contact .btn').removeAttr('disabled');
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

        $('#filterForm-contact .reset').on('click', function () {
            $('#filterForm-contact input').val('');
            tbl_contacts.fnDraw();
        });

        $('#filterForm-contact .apply').on('click', function () {
            tbl_contacts.fnDraw();
        });
    });
</script>