<form class="form-horizontal" role="form" id="form-add" method="post">    
    <div id="showerror"></div>      
    <div class="form-group">
        <label for="remark" class="col-sm-3 control-label">เหตุผล</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="remark" name="remark">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="notice" value="1" checked="checked"> แจ้งเตือนไปยังผู้ขาย
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="remark" class="col-sm-3 control-label">&nbsp;</label>
        <div class="col-sm-9">
            <label class="label label-warning">เมื่อยกเลิกรายการสั่งซื้อแล้วจะไม่สามารถนำกลับมาใช้ได้อีก.</label>
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
        $(this).after('&nbsp;<i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Loading...');
        var data = {
            url: 'products/backend/result_order/order_cancel',
            v: $('#form-add input:not(#btnDialogSave)').serializeArray(),
            form: 'form-add'
        };
        saveData(data);
    });
</script>