<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Options List</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default borderless">
            <div class="panel-body">
                <div class="pull-left">
                    <a href="javascript:;" id="btnAdd" class="btn btn-primary btn-sm" role="button"><li class="fa fa-plus"></li> Add Option</a>                    
                    <a href="<?php echo base_url() . index_page(); ?>products/backend/options/group" class="btn btn-primary btn-sm" role="button">Group Option</a>
                </div>  
                <div class="pull-right">
                    <button class="btn btn-default btn-circle" type="button" id="btnRefresh" value="products/backend/options"><i class="fa fa-refresh"></i>
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
                                <th width="40%">Title</th>
                                <th width="30%">Group</th>
                                <th width="10%">Active</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.dropdown-toggle').dropdown();
        $('#sample_1').dataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
            "ajax": {
                "url": base_url + index_page + "products/backend/result_options/listall",
                "type": "POST"
            },
            "aoColumns": [
                {"mData": "option_id", "sClass": "text-center"},
                {"mData": "option_title"},
                {"mData": "group_title"},
                {"mData": "option_disabled", "sClass": "text-center"}
            ],
            "aoColumnDefs": [
                {'bSortable': false, 'aTargets': [0, 3]}
            ]
        });
    });
    $('#btnAdd').click(function() {
        var data = {
            url: 'products/backend/options/add',
            title: 'Add Option'
        };
        genModal(data);
    });

    $('#btnGroup').click(function() {
        window.location.href = base_url + index_page + 'products/backend/options/group';
    });

    $('#btnDelete').click(function() {
        if ($(".checkboxes:checked").val())
        {
            var data = {
                url: 'products/backend/result_options/delete',
                title: 'Delete Option',
                redirect: 'products/backend/options',
                table_id: '#sample_1'
            };
            deleteData(data);
        } else {
            alert('Please select option.');
        }
    });
</script>