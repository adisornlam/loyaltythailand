<form class="form-horizontal" role="form" id="form-add" method="post">    
    <div id="showerror"></div>      
    <div class="form-group">
        <label for="cnum" class="col-sm-3 control-label">จำนวนคูปอง</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" id="cnum" name="cnum">
        </div>
    </div>    
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <button type="button" id="btnDialogSave" class="btn btn-primary">บันทึก</button>
        </div>
    </div>
</form>
<script type="text/javascript">
    $('#btnDialogSave').click(function () {
        $(this).attr('disabled', 'disabled');
        $(this).after('&nbsp;<i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Loading...');
        var data = {
            url: 'contents/backend/result_promotion/add_coupon',
            v: $('#form-add input:not(#btnDialogSave)').serializeArray(),
            form: 'form-add'
        };
        saveData(data);
    });
</script>