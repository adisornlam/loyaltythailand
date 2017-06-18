<form class="form-horizontal" role="form" id="form-add" method="post" enctype="multipart/form-data">    
    <div id="showerror"></div>    
    <div class="form-group">
        <label for="name" class="col-sm-3 control-label">ชื่อผู้แจ้งชำระ</label>
        <div class="col-sm-5">
            <input type="text" class="form-control required" id="name" name="name" value="<?php echo $this->ion_auth->user()->row()->first_name . " " . $this->ion_auth->user()->row()->last_name; ?>">
        </div>
    </div>  
    <div class="form-group">
        <label for="total" class="col-sm-3 control-label">จำนวนเงิน</label>
        <div class="col-sm-3">
            <input type="text" class="form-control required" id="total" name="total" value="<?php echo number_format($item->sum_price, 0, '.', ''); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="fdate" class="col-sm-3 control-label">วันเวลา</label>
        <div class="col-sm-4">
            <input type="text" class="form-control required" id="fdate" name="fdate" value="<?php echo date('Y-m-d'); ?>">
        </div>
        <div class="col-sm-3">
            <input type="text" class="form-control required" id="ftime" name="ftime" value="<?php echo date('H:i:s'); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="from_bank" class="col-sm-3 control-label">ธนาคารที่โอน</label>
        <div class="col-sm-5">
            <input type="text" class="form-control required" id="from_bank" name="from_bank" value="<?php echo $item->payment_title; ?>" />
        </div>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="branch_bank" name="branch_bank" placeholder="สาขาที่โอน">
        </div>
    </div>
    <div class="form-group">
        <label for="to_bank" class="col-sm-3 control-label">โอนเข้าธนาคาร</label>
        <div class="col-sm-8">
            <input type="text" class="form-control required" id="to_bank" name="to_bank" value="<?php echo $item->payment_title; ?>" />
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
            <button type="button" id="btnDialogSave" class="btn btn-primary"> บันทึก </button>
        </div>
    </div>
    <input type="hidden" name="order_id" value="<?php echo $this->uri->segment(5); ?>" />
</form>
<script type="text/javascript">
    $('#btnDialogSave').click(function() {
        $(this).attr('disabled', 'disabled');
        loading_button();
        var data = {
            url: 'products/backend/result_order/transfer_add',
            v: $('#form-add input:not(#btnDialogSave)').serializeArray(),
            redirect: 'products/backend/order'
        };
        saveData(data);
    });
</script>