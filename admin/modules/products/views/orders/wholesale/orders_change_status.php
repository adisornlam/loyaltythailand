<form class="form-horizontal" role="form" id="form-add" method="post">    
    <div id="showerror"></div>    
    <div class="form-group">
        <label for="cat_code" class="col-sm-3 control-label">สถานะ</label>
        <div class="col-sm-6">
            <?php
            echo form_dropdown('status_id', $order_status, null, 'class="form-control"');
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="remark" class="col-sm-3 control-label">หมายเหตุ</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="remark" name="remark">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="notice" value="1" checked="checked"> แจ้งเตือนไปยังลูกค้า
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <button type="button" id="btnDialogSave" class="btn btn-primary">บันทึก</button>
        </div>
    </div>
    <input type="hidden" value="<?php echo $this->uri->segment(5); ?>" name="order_id" />
</form>
<script type="text/javascript">
    $('#btnDialogSave').click(function() {
        $(this).attr('disabled', 'disabled');
        loading_button();
        var data = {
            url: 'products/backend/result_order/change_status',
            v: $('#form-add, select input:not(#btnDialogSave)').serializeArray(),
            form: 'form-add'
        };
        saveData(data);
    });
</script>