<form class="form-horizontal" role="form" id="form-add" method="post" enctype="multipart/form-data">    
    <div id="showerror"></div>    
    <div class="form-group">
        <label for="name" class="col-lg-3 control-label">ชื่อผู้แจ้งชำระ</label>
        <div class="col-lg-5">
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $this->ion_auth->user()->row()->first_name . " " . $this->ion_auth->user()->row()->last_name; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="total" class="col-lg-3 control-label">จำนวนเงิน</label>
        <div class="col-lg-3">
            <?php
            if ($credit_store['balance'] > 0) {
                $sp = ($credit_store['mn'] ? $credit_store['dif'] : 0);
                ?>
                <input type="text" class="form-control" id="total" name="total" value="<?php echo number_format($sp, 0, '.', ''); ?>">
            <?php } else { ?>
                <input type="text" class="form-control" id="total" name="total" value="<?php echo number_format($item->sum_price, 0, '.', ''); ?>">
            <?php } ?>
        </div>
    </div>
    <div class="form-group">
        <label for="fdate" class="col-lg-3 control-label">วันเวลา</label>
        <div class="col-lg-4">
            <input type="text" class="form-control" id="fdate" name="fdate" value="<?php echo date('Y-m-d'); ?>">
        </div>
        <div class="col-lg-3">
            <input type="text" class="form-control" id="ftime" name="ftime" value="<?php echo date('H:i:s'); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="from_bank" class="col-lg-3 control-label">ธนาคารที่โอน</label>
        <div class="col-lg-5">
            <input type="text" class="form-control" id="from_bank" name="from_bank" value="<?php echo $item->payment_title; ?>" />
        </div>
        <div class="col-lg-4">
            <input type="text" class="form-control" id="branch_bank" name="branch_bank" placeholder="สาขาที่โอน">
        </div>
    </div>
    <div class="form-group">
        <label for="to_bank" class="col-lg-3 control-label">โอนเข้าธนาคาร</label>
        <div class="col-lg-8">
            <input type="text" class="form-control" id="to_bank" name="to_bank" value="<?php echo $item->payment_title; ?>" />
        </div>
    </div> 
    <div class="form-group">
        <label for="to_bank" class="col-lg-3 control-label">หลักฐานการโอนเงิน</label>
        <div class="col-lg-8">
            <input type="file" id="slip" name="slip" />
        </div>
    </div>
    <div class="form-group">
        <label for="remark" class="col-lg-3 control-label">หมายเหตุ</label>
        <div class="col-lg-9">
            <input type="text" class="form-control" id="remark" name="remark">
        </div>
    </div>    
    <div class="form-group">
        <div class="col-lg-offset-3 col-lg-9">
            <button type="button" id="btnDialogSave" class="btn btn-primary"> บันทึก </button>
        </div>
    </div>
    <input type="hidden" name="order_id" value="<?php echo $this->uri->segment(4); ?>" />
</form>
<script src="<?php echo base_url(); ?>assets/backend/js/jquery.form.js"></script>
<script type="text/javascript">
    $(function() {
        var options = {
            url: base_url + index_page + 'products/result_order/transfer_add',
            success: showResponse
        };
        $('#btnDialogSave').click(function() {
            $(this).attr('disabled', 'disabled');
            $(this).after('&nbsp;<span id="spinner_loading"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Loading...</span>');
            $('#form-add').ajaxSubmit(options);
            return false;
        });
    });

    function showResponse(response, statusText, xhr, $form) {
        var as = JSON.parse(response);
        if (as.error.status === false) {
            $('#myModal #button-confirm').removeAttr('disabled');
            $('#spinner_loading').hide();
            $('form #showerror').html(as.error.message);
            $('#btnSave').removeAttr('disabled');
        } else {
            window.location.href = base_url + index_page + 'products/order';
        }
    }
</script>