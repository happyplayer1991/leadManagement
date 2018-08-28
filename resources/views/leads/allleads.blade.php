<div class="card">
    <div class="card-content">
        <h4 class="card-title">AllLeads Table</h4>

        <div class="table-responsive">
            <table id="allleads-table" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width: 100%">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Lead</th>
                        <th>Company</th>
                        <th class="">Status</th>
                        <th>Action</th>
                        @if(Entrust::hasRole('administrator'))
                        <th>Assign User</th>
                        @endif
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
        let tbl_leads = $('#allleads-table').dataTable({
            serverSide: true,
            iDisplayLength : 10,
            ajax: {
                "url": "{{URL::to('/leads/getAllLeads')}}",
                "type": "POST",
                "data": {
                    _token: "{{csrf_token()}}",
                    search: function ( d ) {
                        return [
                            $('#filterForm-allleads input[name="lead_name"]').val(),
                            $('#filterForm-allleads input[name="company"]').val(),
                            $('#filterForm-allleads select[name="status"]').val()
                        ]
                    }
                },
                "beforeSend": function() {
                    $('#filterForm-allleads .btn').attr('disabled', 'true');
                    $('#allleads-table tbody').empty().html('<tr role="row" class="odd loading"><td colspan="6"><i class="fa fa-spin fa-refresh"></i></td></tr>');
                },
                "complete": function() {
                    $('#filterForm-allleads .btn').removeAttr('disabled');
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

        $('#filterForm-allleads .reset').on('click', function () {
            $('#filterForm-allleads input').val('');
            tbl_leads.fnDraw();
        });

        $('#filterForm-allleads .apply').on('click', function () {
            tbl_leads.fnDraw();
        });
    });
</script>