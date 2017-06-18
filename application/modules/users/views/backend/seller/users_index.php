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
                    <a href="<?php echo base_url() . index_page(); ?>users/backend/user/add" class="btn btn-primary btn-sm" role="button" title="Add Users"><li class="fa fa-plus"></li> Add Users</a>
                    <a href="javascript:;" class="btn btn-primary btn-sm link_dialog" role="button" rel="users/backend/user/register_generate" title="Generate Link Register"><li class="fa fa-plus"></li> Generate Link Register</a>
                </div>  
                <div class="pull-right">
                    <button class="btn btn-default btn-circle" type="button" id="btnRefresh" value="users/backend/user"><i class="fa fa-refresh"></i>
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
                                <th width="5%">Code</th>
                                <th width="20%">บริษัท/ร้าน</th>
                                <th width="5%">เบอร์ติดต่อ</th>
                                <th width="15%">อีเมล์</th>
                                <th width="12%">สมัคร</th>
                                <th width="12%">เข้าใช้ล่าสุด</th>
                                <th width="7%">Dealer</th>
                                <th width="7%">Active</th>
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
                "url": base_url + index_page + "users/backend/result_user_seller/listall",
                "type": "POST",
                "data": {group_id: 11}
            },
            "aoColumns": [
                {"mData": "id", "sClass": "text-center"},
                {"mData": "code_member", "sClass": "text-center"},
                {"mData": "company"},
                {"mData": "phone"},
                {"mData": "email"},
                {"mData": "created_on", "sClass": "text-center"},
                {"mData": "last_login", "sClass": "text-center"},
                {"mData": "dealer_status", "sClass": "text-center"},
                {"mData": "active", "sClass": "text-center"}
            ],
            "aoColumnDefs": [
                {'bSortable': false, 'aTargets': [0, 1, 2, 3, 4, 5, 6]}
            ]
        });
    });
</script>