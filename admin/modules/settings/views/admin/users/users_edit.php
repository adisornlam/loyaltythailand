<form class="form-horizontal" role="form" id="form-dialog" method="post">    
    <div id="showerror"></div>
    <div class="form-group">
        <label for="first_name" class="col-sm-3 control-label">First Name</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $item->first_name; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="last_name" class="col-sm-3 control-label">Last Name</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $item->last_name; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="email" class="col-sm-3 control-label">Email</label>
        <div class="col-sm-5">
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $item->email; ?>" disabled="disabled">
        </div>
    </div>
    <div class="form-group">
        <label for="group_id" class="col-sm-3 control-label">Group</label>
        <div class="col-sm-4">
            <?php
            echo form_dropdown('group_id', $ddl_group, $item->group_id, 'class="form-control"');
            ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <div class="checkbox">
                <label>
                    <?php echo form_checkbox('active', 1, ($item->active == 1 ? true : false)); ?> Active
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <button type="button" id="btnDialogSave" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
        </div>
    </div>
    <input type="hidden" name="id" value="<?php echo $item->id; ?>" />
</form>
<script type="text/javascript">
    $(function(){
        var options = {
            url: site_url + 'settings/users/users_edit_save',
            success: showResponse
        };
        $('#btnDialogSave').click(function () {
            if ($("#form-dialog").valid()) {
                $(this).addClass('disabled', 'disabled');
                $(this).after('&nbsp;<span id="spinner_loading"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Loading...</span>');
                $('#form-dialog').ajaxSubmit(options);
                return false;
            }
        });
    });
</script>