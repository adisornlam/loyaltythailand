<form class="form-horizontal" role="form" id="form-add" method="post">    
    <div id="showerror"></div>
    <div class="form-group">
        <label for="cat_code" class="col-sm-3 control-label">Group</label>
        <div class="col-sm-6">
            <?php
            echo form_dropdown('group_id', $group, $item->group_id, 'class="form-control"');
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="title" class="col-sm-3 control-label">Title</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="title" name="title" value='<?php echo $item->title; ?>'>
        </div>
    </div>    
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <div class="checkbox">
                <label>
                    <?php echo form_checkbox('disabled', 'active', ($item->disabled == 0 ? true : false)); ?> Active
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <button type="button" id="btnDialogSave" class="btn btn-default">Save</button>
        </div>
    </div>
    <input type="hidden" name="id" value="<?php echo $item->id; ?>" />
</form>
<script type="text/javascript">
    $('#btnDialogSave').click(function() {
        $(this).attr('disabled', 'disabled');
        loading_button();
        var data = {
            url: 'products/backend/result_options/edit',
            v: $('#form-add, select input:not(#btnDialogSave)').serializeArray(),
            redirect: 'products/backend/options'
        };
        saveData(data);
    });
</script>