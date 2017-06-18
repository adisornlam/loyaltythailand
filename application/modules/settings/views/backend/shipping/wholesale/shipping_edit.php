<form class="form-horizontal" role="form" id="form-add" method="post">    
    <div id="showerror"></div>
    <div class="form-group">
        <label for="title" class="col-sm-3 control-label">Title</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="title" name="title" value="<?php echo $item->title; ?>">
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
            <button type="button" id="btnDialogSave" class="btn btn-primary">Save</button>
        </div>
    </div>
    <input type="hidden" name="id" value="<?php echo $item->id ?>" />
</form>
<script type="text/javascript">
    $('#btnDialogSave').click(function() {
        $(this).attr('disabled', 'disabled');
        loading_button();
        var data = {
            url: 'settings/backend/result_shipping/edit',
            v: $('#form-add input:not(#btnDialogSave)').serializeArray()
        };
        saveData(data);
    });
</script>