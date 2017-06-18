<form class="form-horizontal" role="form" id="form-add" method="post">    
    <div id="showerror"></div>
    <div class="form-group">
        <label for="title" class="col-sm-3 control-label">Title</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="title" name="title" autofocus>
        </div>
    </div>
    <div class="form-group">
        <label for="description" class="col-sm-3 control-label">Description</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="description" name="description">
        </div>
    </div>
    <div class="form-group">
        <label for="url" class="col-sm-3 control-label">Url</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="url" name="url">
        </div>
    </div>
    <div class="form-group">
        <label for="icon" class="col-sm-3 control-label">Icon</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" id="icon" name="icon">
        </div>
    </div>
    <div class="form-group">
        <label for="modules" class="col-sm-3 control-label">Modules</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" id="modules" name="modules">
        </div>
    </div>
    <div class="form-group">
        <label for="weight" class="col-sm-3 control-label">Weight</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="weight" name="weight">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="disabled" value="active"> Active
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <button type="button" id="btnDialogSave" class="btn btn-primary">Save</button>
        </div>
    </div>
    <input type="hidden" value="<?php echo $this->uri->segment(4); ?>" name="parent_id" />
</form>
<script type="text/javascript">
    $('#btnDialogSave').click(function() {
        $(this).attr('disabled', 'disabled');
        loading_button();
        var data = {
            url: 'settings/result_menu/add',
            v: $('#form-add input:not(#btnDialogSave)').serializeArray()
        };
        saveData(data);
    });
</script>