<form class="form-horizontal" role="form" id="form-add" method="post">    
    <div id="showerror"></div>
    <div class="form-group">
        <label for="name" class="col-sm-3 control-label">Title</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $item->name; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="description" class="col-sm-3 control-label">Description</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="description" name="description" value="<?php echo $item->description; ?>">
        </div>
    </div>    
    <div class="form-group">
        <label for="description" class="col-sm-3 control-label">Permission</label>
        <div class="col-sm-offset-3 col-sm-9">
            <?php foreach ($this->Menu_model->get_menu_root() as $val) { ?>
                <div class="checkbox">
                    <label>
                        <?php echo form_checkbox('menu[]', $val->id, (in_array($val->id, $menu_val) ? true : false)); ?> <?php echo $val->title; ?>
                    </label>
                </div>
                <?php if ($this->Menu_model->get_menu_root($val->id)) { ?>
                    <?php foreach ($this->Menu_model->get_menu_root($val->id) as $item2) { ?>
                        <div class="checkbox">
                            <label>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo form_checkbox('menu[]', $item2->id, (in_array($item2->id, $menu_val) ? true : false)); ?> <?php echo $item2->title; ?>
                            </label>
                        </div>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <button type="button" id="btnDialogSave" class="btn btn-primary">Save</button>
        </div>
    </div>
    <input type="hidden" name="id" value="<?php echo $item->id; ?>" />
</form>
<script type="text/javascript">
    $('#btnDialogSave').click(function() {
        $(this).attr('disabled', 'disabled');
        loading_button();
        var data = {
            url: 'settings/result_users/group_edit',
            v: $('#form-add input:not(#btnDialogSave)').serializeArray()
        };
        saveData(data);
    });
</script>