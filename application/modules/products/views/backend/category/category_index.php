<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Category List</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default borderless">
            <div class="panel-body">
                <div class="pull-left">
                    <a href="javascript:;" id="btnAdd" class="btn btn-primary btn-sm" role="button"><li class="fa fa-plus"></li> Add Category</a>
                </div>  
                <div class="pull-right">
                    <button class="btn btn-default btn-circle" type="button" id="btnRefresh" value="products/backend/category"><i class="fa fa-refresh"></i>
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
                                <th width="20%">Title</th>
                                <th width="20%">Title EN</th>
                                <th width="30%">Description</th>
                                <th width="10%">Front</th>
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
                "url": base_url + index_page + "products/backend/result_category/listall/<?php echo $this->uri->segment(5); ?>",
                "type": "POST"
            },
            "aoColumns": [
                {"mData": "cat_id", "sClass": "text-center"},
                {"mData": "cat_title"},
                {"mData": "cat_title_en"},
                {"mData": "cat_description"},
                {"mData": "cat_front", "sClass": "text-center"},
                {"mData": "cat_disabled", "sClass": "text-center"}
            ],
            "aoColumnDefs": [
                {'bSortable': false, 'aTargets': [0, 3, 4, 5]}
            ]
        });
    });
    $('#btnAdd').click(function() {
        var data = {
            url: 'products/backend/category/add/<?php echo $this->uri->segment(5); ?>',
            title: 'Add Category'
        };
        genModal(data);
    });

</script>