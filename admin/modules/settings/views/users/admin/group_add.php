<form class="form-horizontal" role="form" id="form-add" method="post">    
    <div id="showerror"></div>
    <div class="form-group">
        <label for="name" class="col-sm-3 control-label">Title</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="name" name="name">
        </div>
    </div>
    <div class="form-group">
        <label for="description" class="col-sm-3 control-label">Description</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="description" name="description">
        </div>
    </div>
    <div class="form-group">
        <label for="description" class="col-sm-3 control-label">Permission</label>
        <div class="col-sm-offset-3 col-sm-9">
            <?php foreach ($this->Menu_model->get_menu_root() as $item) { ?>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="menu[]" value="<?php echo $item->id; ?>"> <?php echo $item->title; ?>
                    </label>
                </div>
                <?php if ($this->Menu_model->get_menu_root($item->id)) { ?>
                    <?php foreach ($this->Menu_model->get_menu_root($item->id) as $item2) { ?>
                        <div class="checkbox">
                            <label>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="menu[]" value="<?php echo $item2->id; ?>"> <?php echo $item2->title; ?>
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
</form>
<script type="text/javascript">
    $('#btnDialogSave').click(function() {
        $(this).attr('disabled', 'disabled');
        loading_button();
        var data = {
            url: 'settings/result_users/group_add',
            v: $('#form-add input:not(#btnDialogSave)').serializeArray()
        };
        saveData(data);
    });
</script>