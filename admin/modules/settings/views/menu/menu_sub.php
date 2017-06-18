<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Menu Overview</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <ul class="breadcrumb">
            <?php foreach ($breadcrumbs as $key => $val) { ?>
                <?php if ($val === reset($breadcrumbs)) { ?>
                    <li><a href="<?php echo base_url().index_page(). $val; ?>"><i class="icon-home"></i> <?php echo $key; ?></a></li>
                <?php } elseif ($val === end($breadcrumbs)) { ?>
                    <li class="active"><?php echo $key; ?></li>
                <?php } else { ?>
                    <li><a href="<?php echo base_url().index_page(). $val; ?>"> <?php echo $key; ?></a></li>
                <?php } ?>
            <?php } ?>
        </ul>
    </div>
    <div class="col-lg-12">
        <div class="panel panel-default borderless">
            <div class="panel-body">
                <div class="pull-left">
                    <a href="javascript:;" id="btnAdd" class="btn btn-primary btn-sm" role="button"><li class="fa fa-plus"></li> Add Sub Menu</a>
                </div>  
                <div class="pull-right">
                    <button class="btn btn-default btn-circle" type="button" id="btnRefresh" value="settings/menu"><i class="fa fa-refresh"></i>
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
            "language": {
                "url": base_url + "assets/backend/js/plugins/dataTables/lang/Thai.json"
            },
            "processing": true,
            "serverSide": true,
            "lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "All"]],
            "ajax": {
                "url": base_url + index_page + "settings/result_menu/listall/<?php echo $this->uri->segment(4); ?>",
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
            url: 'settings/menu/add/<?php echo $this->uri->segment(4); ?>',
            title: 'Add Menu'
        };
        genModal(data);
    });

</script>