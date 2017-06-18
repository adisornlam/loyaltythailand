<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Shipping Overview</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default borderless">
            <div class="panel-body">
                <div class="pull-left">
                    <a href="javascript:;" class="btn btn-primary btn-sm link_dialog" role="button" rel="settings/backend/shipping/add" title="Add Shipping"><li class="fa fa-plus"></li> Add Shipping</a>
                </div>  
                <div class="pull-right">
                    <button class="btn btn-default btn-circle" type="button" id="btnRefresh" value="settings/backend/shipping"><i class="fa fa-refresh"></i>
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
                                <th width="90%">title</th>
                                <th width="5%">active</th>                                
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
                "url": base_url + index_page + "settings/backend/result_shipping/listall",
                "type": "POST"
            },
            "aoColumns": [
                {"mData": "id", "sClass": "text-center"},
                {"mData": "title"},
                {"mData": "active", "sClass": "text-center"}
            ],
            "aoColumnDefs": [
                {'bSortable': false, 'aTargets': [0, 2]}
            ]
        });
    });
</script>