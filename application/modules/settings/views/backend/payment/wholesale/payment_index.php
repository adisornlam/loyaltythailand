<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Payment Overview</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default borderless">
            <div class="panel-body">
                <div class="pull-left">
                    <a href="javascript:;" class="btn btn-primary btn-sm link_dialog" role="button" rel="settings/backend/payment/add" title="Add Payment"><li class="fa fa-plus"></li> Add Payment</a>
                </div>  
                <div class="pull-right">
                    <button class="btn btn-default btn-circle" type="button" id="btnRefresh" value="settings/backend/payment"><i class="fa fa-refresh"></i>
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
                                <th width="70%">Title</th>
                                <th width="20%">Type</th>
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
                "url": base_url + index_page + "settings/backend/result_payment/listall",
                "type": "POST"
            },
            "aoColumns": [
                {"mData": "id", "sClass": "text-center"},
                {"mData": "item_title"},
                {"mData": "type_title"},
                {"mData": "active", "sClass": "text-center"}
            ],
            "aoColumnDefs": [
                {'bSortable': false, 'aTargets': [0, 3]}
            ]
        });
    });
</script>