<form class="form-horizontal" role="form" id="form-add" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body"> 
                    <div id="showerror"></div>
                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">ชื่อสินค้า</label>
                        <div class="col-sm-5">
                            <?php echo form_input('title', null, 'class="form-control required" id="title"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="code_no" class="col-sm-2 control-label">รหัสสินค้า</label>
                        <div class="col-sm-3">
                            <?php echo form_input('code_no', null, 'class="form-control required" id="code_no"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cat_id" class="col-sm-2 control-label">หมวดหมู่</label>
                        <div class="col-sm-4">
                            <?php echo form_dropdown('cat_id', $ddl_cat, null, 'class="form-control required" id="cat_id"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="desc_short" class="col-sm-2 control-label">คำอธิบายย่อ</label>
                        <div class="col-sm-5">
                            <?php echo form_textarea(array('name' => 'desc_short', 'row' => 5, 'class' => 'form-control required', 'id' => 'desc_short')); ?>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label for="unit_price" class="col-sm-2 control-label">ราคาต่อหน่วย</label>
                        <div class="col-sm-2">
                            <?php echo form_input('unit_price', null, 'class="form-control required" id="unit_price"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="point" class="col-sm-2 control-label">แต้มสินค้า</label>
                        <div class="col-sm-2">
                            <?php echo form_input('point', null, 'class="form-control required" id="point"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stock" class="col-sm-2 control-label">จำนวนสินค้า</label>
                        <div class="col-sm-2">
                            <?php echo form_input('stock', null, 'class="form-control required" id="stock"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cover_img" class="col-sm-2 control-label">รูปปกสินค้า</label>
                        <div class="col-sm-4">
                            <?php echo form_upload('cover_img', null, 'class="form-control required" id="cover_img"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="desc_long" class="col-sm-2 control-label">รายละเอียด</label>
                        <div class="col-sm-10">
                            <textarea class="form-control ckeditor required" name="desc_long" id="desc_long" rows="6"></textarea>
                        </div>
                    </div>   
                    <div class="form-group">
                        <label for="description" class="col-sm-2 control-label">SEO Description</label>
                        <div class="col-sm-5">
                            <?php echo form_input('description', null, 'class="form-control" id="description"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="keywords" class="col-sm-2 control-label">SEO Keywords</label>
                        <div class="col-sm-5">
                            <?php echo form_input('keywords', null, 'class="form-control" id="keywords"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="disabled" value="active"> Active
                                </label>
                            </div>
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
</form>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/plugins/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    $(function () {
        CKEDITOR.replace('desc_long');
        var options = {
            url: site_url + 'products/add_save',
            success: showResponse
        };
        $('#btnSave').click(function () {
            if ($("#form-add").valid()) {
                $(this).addClass('disabled');
                for (instance in CKEDITOR.instances)
                    CKEDITOR.instances.desc_long.updateElement();
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