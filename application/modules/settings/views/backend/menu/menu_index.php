<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Menu Overview</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default borderless">
            <div class="panel-body">
                <div class="pull-left">
                    <a href="javascript:;" id="btnAdd" class="btn btn-primary btn-sm" role="button"><li class="fa fa-plus"></li> Add Menu</a>
                </div>  
                <div class="pull-right">
                    <button class="btn btn-default btn-circle" type="button" id="btnRefresh" value="settings/backend/menu"><i class="fa fa-refresh"></i>
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
                                <th width="10%">Title</th>
                                <th width="10%">Type</th>
                                <th width="20%">Description</th>
                                <th width="20%">URL</th>
                                <th width="15%">Icon</th>
                                <th width="15%">Modules</th>
                                <th width="15%">Weight</th>
                                <th width="10%">Active</th>
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
                "url": base_url + index_page + "settings/backend/result_menu/listall/<?php echo $this->uri->segment(5); ?>",
                "type": "POST"
            },
            "aoColumns": [
                {"mData": "id", "sClass": "text-center"},
                {"mData": "title"},
                {"mData": "type"},
                {"mData": "description"},
                {"mData": "url"},
                {"mData": "icon"},
                {"mData": "modules"},
                {"mData": "weight", "sClass": "text-center"},
                {"mData": "disabled", "sClass": "text-center"}
            ],
            "aoColumnDefs": [
                {'bSortable': false, 'aTargets': [0, 3, 4, 5, 8]}
            ]
        });
    });
    $('#btnAdd').click(function() {
        var data = {
            url: 'settings/backend/menu/add/<?php echo $this->uri->segment(5); ?>',
            title: 'Add Menu'
        };
        genModal(data);
    });

</script>