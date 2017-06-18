<form class="form-horizontal" role="form" id="form-add" method="post">    
    <div id="showerror"></div>
    <div class="form-group">
        <label for="gen_url" class="col-sm-2 control-label">URL</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="gen_url" name="gen_url" value="<?php echo base_url() . index_page() . "backend/register/" . $key; ?>">
            <p class="help-block">Copy URL ส่งให้ลูกค้าสมัคร</p>
        </div>
    </div>       
</form>
<script type="text/javascript">
    $("input[type='text']").click(function() {
        $(this).select();
    });
    $('#btnDialogSave').click(function() {
        var data = {
            url: 'users/backend/result_user_seller/generate',
            v: $('#form-add, select input:not(#btnDialogSave)').serializeArray()
        };
        saveData(data);
    });
</script>