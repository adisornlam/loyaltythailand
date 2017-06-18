<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Options Group List</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . index_page(); ?>products/backend/options">Options</a></li>
            <li class="active">Options Group</li>
        </ol>
    </div>
    <div class="col-lg-12">
        <div class="panel panel-default borderless">
            <div class="panel-body">
                <div class="pull-left">
                    <a href="javascript:;" id="btnAdd" class="btn btn-primary btn-sm" role="button">Add Group</a>
                    <a href="javascript:;" id="btnEdit" class="btn btn-success btn-sm" role="button">Edit Group</a>
                    <a href="javascript:;" id="btnDelete" class="btn btn-danger btn-sm" role="button">Delete Group</a>
                </div>  
                <div class="pull-right">
                    <button class="btn btn-default btn-circle" type="button" onclick="goBack()"><i class="fa fa-reply"></i>
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
                                <th width="2%">#</th>
                                <th width="5%">ID</th>
                                <th width="20%">Name</th>
                                <th width="40%">Title</th>
                                <th width="30%">Title 2</th>
                                <th width="10%">Active</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result) {
                                foreach ($result as $item) {
                                    ?>
                                    <tr>
                                        <td><input type="radio" name="id" class="checkboxes" value="<?php echo $item->id; ?>" /></td>
                                        <td><?php echo $item->id; ?></td>
                                        <td><?php echo $item->name; ?></td>
                                        <td><?php echo $item->title; ?></td>
                                        <td><?php echo $item->title2; ?></td>
                                        <td align="center">
                                            <?php echo ($item->disabled == 0 ? '<span class="label label-success label-mini">Yes</span>' : '<span class="label label-danger label-mini">No</span>'); ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="5" align="center">No data.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#btnAdd').click(function() {
        var data = {
            url: 'products/backend/options/group_add',
            title: 'Add Group'
        };
        genModal(data);
    });

    $('#btnEdit').click(function() {
        if ($(".checkboxes:checked").val())
        {
            var data = {
                url: 'products/backend/options/group_edit',
                title: 'Edit Group',
                v: {id: $(".checkboxes:checked").val()}
            };
            genModal(data);
        } else {
            alert('Please select Group.');
        }
    });

    $('#btnDelete').click(function() {
        if ($(".checkboxes:checked").val())
        {
            var data = {
                url: 'products/backend/result_options/group_delete',
                title: 'Delete Group',
                redirect: 'products/backend/options/group',
                table_id: '#sample_1'
            };
            deleteData(data);
        } else {
            alert('Please select Group.');
        }
    });
</script>