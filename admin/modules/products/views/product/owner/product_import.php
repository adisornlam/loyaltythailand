<form class="form-horizontal" role="form" id="form-add" method="post">    
    <div id="showerror"></div>
    <div class="form-group">
        <label for="title" class="col-sm-3 control-label">ไฟล์ CSV</label>
        <div class="col-sm-9">
            <input type="file" id="file_imp" name="file_imp">
        </div>
    </div>
    <div class="form-group">
        <label for="cat_id" class="col-sm-3 control-label">หมวดหมู่</label>
        <div class="col-sm-6">
            <?php echo form_dropdown('cat_id', $category, NULL, 'class="form-control" id="cat_id"'); ?>
        </div>
    </div>
    <div class="form-group" style="display: none;">
        <label for="sub1" class="col-sm-3 control-label">&nbsp;</label>
        <div class="col-sm-6">
            <select name="cat_sub_1" id="cat_sub_1" class="form-control">
                <option selected="selected" value=""></option>                            
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <button type="button" id="btnDialogSave" class="btn btn-primary">นำเข้าไฟล์</button>
        </div>
    </div>
</form>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.form/3.50/jquery.form.min.js"></script>
<script type="text/javascript">
    $(function () {
        var options = {
            type: 'POST',
            url: base_url + index_page + 'products/backend/result_product/import',
            success: showResponse_dialog
        };
        $('#btnDialogSave').click(function () {
            $(this).attr('disabled', 'disabled');
            $(this).after('&nbsp;<span id="spinner_loading"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Loading...</span>');
            $('#form-add').ajaxSubmit(options);
            return false;
        });
    });
    $('#cat_id').change(function () {
        $('#cat_sub_1').parent().parent().hide();
        $('#cat_sub_1').empty();
        $.get(base_url + index_page + 'products/backend/category/get_sub/' + $(this).val(),
                function (data) {
                    var as = JSON.parse(data);
                    if (as) {
                        var sub1 = $('#cat_sub_1');
                        sub1.parent().parent().show();
                        sub1.empty();
                        sub1.append("<option value=''>เลือกรายการย่อย</option>");
                        $.each(as, function (index, element) {
                            sub1.append("<option value='" + index + "'>" + element + "</option>");
                        });
                    }
                });
    });
</script>