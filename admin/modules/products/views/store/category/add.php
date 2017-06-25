<form class="form-horizontal" role="form" id="form-add" method="post">    
    <div id="showerror"></div>
    <div class="form-group">
        <label for="title" class="col-sm-3 control-label">หัวข้อ</label>
        <div class="col-sm-5">
            <?php echo form_input('title', null, 'class="form-control" id="title"'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="description" class="col-sm-3 control-label">คำอธิบาย</label>
        <div class="col-sm-8">
            <?php echo form_input('description', null, 'class="form-control" id="description"'); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <button type="button" id="btnDialogSave" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
        </div>
    </div>
</form>
<script type="text/javascript">
    $(function () {
        var options = {
            url: site_url + 'products/category/save/add',
            success: showResponse
        };
        $('#btnDialogSave').click(function () {
            if ($("#form-add").valid()) {
                $(this).addClass('disabled');
                $('#form-add').ajaxSubmit(options);
                return false;
            }
        });
    });

    function showResponse(response, statusText, xhr, $form) {
        var as = JSON.parse(response);
        if (as.error.status === false) {
            $('#btnDialogSave').removeClass('disabled');
        } else {
            window.location.href = site_url + as.error.redirect;
        }
    }
</script>