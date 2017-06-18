<form class="form-horizontal" role="form" id="form-add" method="post">    
    <div id="showerror"></div>
    <div class="form-group">
        <label for="name" class="col-sm-3 control-label">Name</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="name" name="name">
        </div>
    </div>
    <div class="form-group">
        <label for="title" class="col-sm-3 control-label">Title</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="title" name="title">
        </div>
    </div>
    <div class="form-group">
        <label for="title2" class="col-sm-3 control-label">Title 2</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="title2" name="title2">
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
            <button type="button" id="btnDialogSave" class="btn btn-default">Save</button>
        </div>
    </div>
</form>
<script type="text/javascript">
    $('#btnDialogSave').click(function() {
        $(this).attr('disabled', 'disabled');
        loading_button();
        var data = {
            url: 'products/backend/result_options/group_add',
            v: $('#form-add input:not(#btnDialogSave)').serializeArray(),
            redirect: 'products/backend/options/group'
        };
        saveData(data);
    });
</script>