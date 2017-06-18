<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Category List</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <ul class="breadcrumb">
            <?php foreach ($breadcrumbs as $key => $val) { ?>
                <?php if ($val === reset($breadcrumbs)) { ?>
                    <li><a href="<?php echo base_url() . index_page() . $val; ?>"><i class="icon-home"></i> <?php echo $key; ?></a></li>
                <?php } elseif ($val === end($breadcrumbs)) { ?>
                    <li class="active"><?php echo $key; ?></li>
                <?php } else { ?>
                    <li><a href="<?php echo base_url() . index_page() . $val; ?>"> <?php echo $key; ?></a></li>
                <?php } ?>
            <?php } ?>
        </ul>
    </div>
    <div class="col-lg-12">
        <div class="panel panel-default borderless">
            <div class="panel-body">
                <div class="pull-left">
                    <a href="javascript:;" id="btnAdd" class="btn btn-primary btn-sm" role="button"><li class="fa fa-plus"></li> Add Sub Category</a>
                </div>  
                <div class="pull-right">
                    <button class="btn btn-default btn-circle" type="button" id="btnBack" value="products/backend/category">
                        <i class="fa fa-reply"></i>
                    </button>
                    <button class="btn btn-default btn-circle" type="button" id="btnRefresh" value="products/backend/category">
                        <i class="fa fa-refresh"></i>
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
                                <th width="2%">&nbsp;</th>
                                <th width="80%">Title</th>       
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
            "language": {
                "url": base_url + "assets/backend/js/plugins/dataTables/lang/Thai.json"
            },
            "processing": true,
            "serverSide": true,
            "lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "All"]],
            "ajax": {
                "url": base_url + index_page + "products/backend/result_category/listall/<?php echo $this->uri->segment(5); ?>",
                "type": "POST"
            },
            "aoColumns": [
                {"mData": "cat_id", "sClass": "text-center"},
                {"mData": "cat_name"},
                {"mData": "cat_active", "sClass": "text-center"}
            ]
        });
    });

</script>