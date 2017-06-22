<form class="form-horizontal" role="form" id="form-add" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body"> 
                    <div id="showerror"></div>
                    <div class="form-group">
                        <label for="long_desc" class="col-sm-2 control-label">รายละเอียด</label>
                        <div class="col-sm-10">
                            <textarea class="form-control ckeditor" name="long_desc" id="long_desc" rows="6"><?php echo $item->long_desc; ?></textarea>
                        </div>
                    </div>   
                    <div class="form-group">
                        <label for="description" class="col-sm-2 control-label">SEO Description</label>
                        <div class="col-sm-5">
                            <?php echo form_input('description', $item->description, 'class="form-control" id="description"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="keywords" class="col-sm-2 control-label">SEO Keywords</label>
                        <div class="col-sm-5">
                            <?php echo form_input('keywords', $item->keywords, 'class="form-control" id="keywords"'); ?>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
        <div class="col-lg-12">
            <div class="panel-body">
                <div class="text-center">
                    <button type="button" id="btnSave" class="btn btn-primary btn-lg"> บันทึกการเปลี่ยนแปลง </button>                 
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="id" value="<?php echo $item->id; ?>" />
    <input type="hidden" name="redirect" value="aboutus" />
</form>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/plugins/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/dist/js/jquery.form.min.js"></script>
<script type="text/javascript">
    $(function () {
        CKEDITOR.replace('long_desc');
        var options = {
            url: site_url + 'contents/save/edit',
            success: showResponse
        };
        $('#btnSave').click(function () {
            if ($("#form-add").valid()) {
                $(this).addClass('disabled');
                for (instance in CKEDITOR.instances)
                    CKEDITOR.instances.long_desc.updateElement();
                $('#form-add').ajaxSubmit(options);
                return false;
            }
        });
    });

    function showResponse(response, statusText, xhr, $form) {
        var as = JSON.parse(response);
        if (as.error.status === false) {
            alert(as.error.message_info);
            $('#btnSave').removeClass('disabled');
        } else {
            window.location.href = site_url + as.error.redirect;
        }
    }
</script>