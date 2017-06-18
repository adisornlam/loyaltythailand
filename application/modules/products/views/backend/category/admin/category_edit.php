<form class="form-horizontal" role="form" id="form-add" method="post">    
    <div id="showerror"></div>
    <div class="form-group">
        <label for="cat_code" class="col-sm-3 control-label">Code</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" id="cat_code" name="cat_code" value="<?php echo $item->cat_code; ?>" />
        </div>
    </div>
    <div class="form-group">
        <label for="cat_title" class="col-sm-3 control-label">Title</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="cat_title" name="cat_title" value="<?php echo $item->cat_title; ?>" />
        </div>
    </div>
    <div class="form-group">
        <label for="cat_title_en" class="col-sm-3 control-label">Title EN</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="cat_title_en" name="cat_title_en" value="<?php echo $item->cat_title_en; ?>" />
        </div>
    </div>
    <div class="form-group">
        <label for="cat_description" class="col-sm-3 control-label">Description</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="cat_description" name="cat_description" value="<?php echo $item->cat_description; ?>" />
        </div>
    </div>
    <div class="form-group">
        <label for="cat_code" class="col-sm-3 control-label">Option Group</label>
        <div class="col-sm-6">

            <?php
            foreach ($group as $item2) {
                ?>
                <div class="checkbox">
                    <label>
                        <?php echo form_checkbox('group_id[]', $item2->id, in_array($item2->id, $group_option)); ?>
                        <?php echo $item2->title . ($item2->title2 != '' ? " (" . $item2->title2 . ")" : ''); ?>
                    </label>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <div class="checkbox">
                <label>
                    <?php echo form_checkbox('cat_front', 'front', ($item->cat_front == 0 ? true : false)); ?> Show Front
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <div class="checkbox">
                <label>
                    <?php echo form_checkbox('cat_disabled', 'active', ($item->cat_disabled == 0 ? true : false)); ?> Active
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <button type="button" id="btnDialogSave" class="btn btn-primary">Save</button>
        </div>
    </div>
    <input type="hidden" value="<?php echo $item->cat_id; ?>" name="cat_id" />
    <input type="hidden" value="<?php echo $cat_parent_id; ?>" name="cat_parent_id" />
</form>
<script type="text/javascript">
    $('#btnDialogSave').click(function() {
        $(this).attr('disabled', 'disabled');
        loading_button();
        var data = {
            url: 'products/backend/result_category/edit',
            v: $('#form-add, select input:not(#btnDialogSave)').serializeArray()
        };
        saveData(data);
    });
</script>