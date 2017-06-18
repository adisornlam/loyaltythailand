<form class="form-horizontal" role="form" id="form-add" method="post">    
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
            <div class="checkbox">
                <label>
                    <?php echo form_checkbox('disabled', 'active'); ?> เปิดใช้งาน
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <button type="button" id="btnSave" class="btn btn-primary">  บันทึกการเปลี่ยนแปลง </button>
        </div>
    </div>
    <input type="hidden" value="contents" name="type" />
</form>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.form/3.50/jquery.form.min.js"></script>
<script type="text/javascript">
    $(function() {
        var options = {
            type: 'POST',
            url: base_url + index_page + 'contents/backend/result_group/add',
            success: showResponse_dialog
        };
        $('#btnSave').click(function() {
            $(this).attr('disabled', 'disabled');
            $(this).after('&nbsp;<span id="spinner_loading"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Loading...</span>');
            $('#form-add').ajaxSubmit(options);
            return false;
        });
    });
</script>