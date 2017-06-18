<form class="form-horizontal" role="form" id="form-add" method="post">    
    <div id="showerror"></div>
    <div class="form-group">
        <label for="title" class="col-sm-3 control-label">หัวข้อ</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="title" name="title" value="<?php echo $item->title; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="description" class="col-sm-3 control-label">คำอธิบาย</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="description" name="description" value="<?php echo $item->description; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="weight" class="col-sm-3 control-label">ลำดับ</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" id="weight" name="weight" value="<?php echo $item->weight; ?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <div class="checkbox">
                <label>
                    <?php echo form_checkbox('disabled', 'active', ($item->disabled == 0 ? true : false)); ?> เปิดใช้งาน
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <button type="button" id="btnDialogSave" class="btn btn-primary">บันทึกการเปลี่ยนแปลง</button>
        </div>
    </div>
    <input type="hidden" value="<?php echo $this->uri->segment(5); ?>" name="parent_id" />
    <input type="hidden" value="<?php echo $item->id; ?>" name="id" />
</form>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.form/3.50/jquery.form.min.js"></script>
<script type="text/javascript">
    $(function () {
        var options = {
            type: 'POST',
            url: base_url + index_page + 'products/backend/result_category/edit',
            success: showResponse_dialog
        };
        $('#btnDialogSave').click(function () {
            $(this).attr('disabled', 'disabled');
            $(this).after('&nbsp;<span id="spinner_loading"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Loading...</span>');
            $('#form-add').ajaxSubmit(options);
            return false;
        });
    });
</script>