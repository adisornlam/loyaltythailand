<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/backend/js/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
<style type="text/css">
    textarea#description, textarea#desc_invoice 
    { 
        height: 100px 
    }
</style>
<form class="form-horizontal" role="form" id="form-add" method="post">    
    <div id="showerror"></div>
    <div class="form-group">
        <div class="col-sm-6">
            <input type="text" class="form-control" id="title" name="title" placeholder="Title">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-5">
            <?php
            echo form_dropdown('payment_id', $type, null, 'class="form-control"');
            ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-12">
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-12">
            <textarea name="desc_invoice" id="desc_invoice" class="form-control"></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-0 col-sm-9">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="active" value="1"> Active
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-5 col-sm-7">
            <button type="button" id="btnDialogSave" class="btn btn-primary">Save</button>
        </div>
    </div>
</form>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script type="text/javascript">
    $(function() {
        $('#description, #desc_invoice').wysihtml5({
            "link": false,
            "image": false,
            "outdent": false,
            "indent": false
        });
    });
    $('#btnDialogSave').click(function() {
        $(this).attr('disabled', 'disabled');
        loading_button();
        var data = {
            url: 'settings/backend/result_payment/add',
            v: $('#form-add, select input:not(#btnDialogSave)').serializeArray()
        };
        saveData(data);
    });
</script>