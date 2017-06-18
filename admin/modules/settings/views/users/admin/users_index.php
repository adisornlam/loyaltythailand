<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Users Overview</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default borderless">
            <div class="panel-body">
                <div class="pull-left">
                    <a href="javascript:;" class="btn btn-primary btn-sm link_dialog" role="button" rel="settings/users/add" title="Add Users"><li class="fa fa-plus"></li> Add Users</a>
                    <a href="<?php echo base_url() . index_page(); ?>settings/users/group" class="btn btn-primary btn-sm" role="button"><li class="fa fa-group"></li> Group</a>
                </div>  
                <div class="pull-right">
                    <button class="btn btn-default btn-circle" type="button" id="btnRefresh" value="settings/users"><i class="fa fa-refresh"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                            <tr>
                                <th width="2%"></th>
                                <th width="8%">Username</th>
                                <th width="8%">Group</th>
                                <th width="20%">Email</th>
                                <th width="15%">Full Name</th>
                                <th width="12%">Register</th>
                                <th width="12%">Last Login</th>
                                <th width="5%">Active</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.dropdown-toggle').dropdown();
        $('#sample_1').dataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "All"]],
            "ajax": {
                "url": base_url + index_page + "settings/result_users/listall",
                "type": "POST"
            },
            "aoColumns": [
                {"mData": "id", "sClass": "text-center"},
                {"mData": "username"},
                {"mData": "group_name"},
                {"mData": "email"},
                {"mData": "first_name"},
                {"mData": "created_on", "sClass": "text-center"},
                {"mData": "last_login", "sClass": "text-center"},
                {"mData": "active", "sClass": "text-center"}
            ],
            "aoColumnDefs": [
                {'bSortable': false, 'aTargets': [0, 1, 2, 3, 4, 5, 7]}
            ]
        });
    });
</script>