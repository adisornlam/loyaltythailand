<form class="form-horizontal" role="form" id="form-add" method="post">    
    <div id="showerror"></div>
    <div class="form-group">
        <label for="cat_code" class="col-sm-3 control-label">Code</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" id="cat_code" name="cat_code">
        </div>
    </div>
    <div class="form-group">
        <label for="cat_title" class="col-sm-3 control-label">Title</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="cat_title" name="cat_title">
        </div>
    </div>
    <div class="form-group">
        <label for="cat_title_en" class="col-sm-3 control-label">Title EN</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="cat_title_en" name="cat_title_en">
        </div>
    </div>
    <div class="form-group">
        <label for="cat_description" class="col-sm-3 control-label">Description</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="cat_description" name="cat_description">
        </div>
    </div>
    <div class="form-group">
        <label for="cat_code" class="col-sm-3 control-label">Option Group</label>
        <div class="col-sm-6">

            <?php foreach ($group as $item) { ?>
                <div class="checkbox">
                    <label>
                        <?php echo form_checkbox('group_id[]', $item->id); ?>
                        <?php echo $item->title . ($item->title2 != '' ? " (" . $item->title2 . ")" : ''); ?>
                    </label>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="cat_disabled" value="active"> Active
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <button type="button" id="btnDialogSave" class="btn btn-primary">Save</button>
        </div>
    </div>
    <input type="hidden" value="<?php echo $this->uri->segment(5); ?>" name="cat_id" />
</form>
<script type="text/javascript">
    $('#btnDialogSave').click(function() {
        $(this).attr('disabled', 'disabled');
        loading_button();
        var data = {
            url: 'products/backend/result_category/add',
            v: $('#form-add, select input:not(#btnDialogSave)').serializeArray()
        };
        saveData(data);
    });
</script>