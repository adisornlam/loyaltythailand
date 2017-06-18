<link href="<?php echo base_url(); ?>assets/backend/js/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?php echo $title; ?></h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <ul class="breadcrumb">
            <?php foreach ($breadcrumbs as $key => $val) { ?>
                <?php if ($val === reset($breadcrumbs)) { ?>
                    <li><a href="<?php echo base_url() . index_page() . $val; ?>"><i class="icon-home"></i> <?php echo $key; ?></a></li>
                <?php } elseif ($val === end($breadcrumbs)) { ?>
                    <li class="active"><?php echo $key; ?></li>
                <?php } else { ?>
                    <li><a href="<?php echo base_url() . index_page() . $val; ?>"> <?php echo $key; ?></a></li>
                <?php } ?>
            <?php } ?>
        </ul>
    </div>
</div>
<form class="form-horizontal" role="form" id="form-add" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body"> 
                    <div class="form-group">
                        <label for="prod_code" class="col-sm-2 control-label">รหัสสินค้า</label>
                        <div class="col-sm-3">
                            <?php echo form_input('prod_code', null, 'class="form-control" id="prod_code"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">ชื่อสินค้า</label>
                        <div class="col-sm-5">
                            <?php echo form_input('title', null, 'class="form-control" id="title"'); ?>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label for="cat_id" class="col-sm-2 control-label">หมวดหมู่</label>
                        <div class="col-sm-4">
                            <?php echo form_dropdown('cat_id', $category, NULL, 'class="form-control" id="cat_id"'); ?>
                        </div>
                    </div>
                    <div class="form-group" style="display: none;">
                        <label for="sub1" class="col-sm-2 control-label">&nbsp;</label>
                        <div class="col-sm-4">
                            <select name="cat_sub_1" id="cat_sub_1" class="form-control">
                                <option selected="selected" value=""></option>                            
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="short_desc" class="col-sm-2 control-label">คำอธิบายย่อ</label>
                        <div class="col-sm-5">
                            <?php echo form_textarea(array('name' => 'short_desc', 'row' => 5, 'class' => 'form-control', 'id' => 'short_desc')); ?>
                        </div>
                    </div>     
                    <div class="form-group last">
                        <label class="control-label col-md-2">รูปปก</label>
                        <div class="col-md-10">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                <div>
                                    <span class="btn btn-default btn-file">
                                        <span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
                                        <input type="file" name="photo0"></span>
                                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stock" class="col-sm-2 control-label">รูปสินค้า</label>
                        <div class="col-sm-2">
                            <?php echo form_upload('photo1', null, ' id="photo1"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stock" class="col-sm-2 control-label">&nbsp;</label>
                        <div class="col-sm-2">
                            <?php echo form_upload('photo2', null, ' id="photo2"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stock" class="col-sm-2 control-label">&nbsp;</label>
                        <div class="col-sm-2">
                            <?php echo form_upload('photo3', null, ' id="photo3"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stock" class="col-sm-2 control-label">&nbsp;</label>
                        <div class="col-sm-2">
                            <?php echo form_upload('photo4', null, ' id="photo4"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stock" class="col-sm-2 control-label">&nbsp;</label>
                        <div class="col-sm-2">
                            <?php echo form_upload('photo5', null, ' id="photo5"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stock" class="col-sm-2 control-label">จำนวนสินค้า</label>
                        <div class="col-sm-2">
                            <?php echo form_input('stock', null, 'class="form-control" id="stock"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-sm-2 control-label">ราคา</label>
                        <div class="col-sm-2">
                            <?php echo form_input('price', null, 'class="form-control" id="price"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <?php echo form_checkbox('disabled', 'active'); ?> เปิดใช้งาน
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="long_desc" class="col-sm-2 control-label">รายละเอียด</label>
                        <div class="col-sm-10">
                            <textarea class="form-control ckeditor" name="long_desc" id="long_desc" rows="6"></textarea>
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/plugins/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/js/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/js/jquery.form.js"></script>
<script type="text/javascript">
    $(function () {
        CKEDITOR.replace('long_desc');
        var options = {
            url: base_url + index_page + 'products/backend/result_product/add',
            success: showResponse
        };
        $('#btnSave').click(function () {
            $(this).attr('disabled', 'disabled');
            $(this).after('&nbsp;<span id="spinner_loading"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Loading...</span>');
            for (instance in CKEDITOR.instances)
                CKEDITOR.instances.long_desc.updateElement();
            $('#form-add').ajaxSubmit(options);
            return false;
        });
    });
    function showResponse(response, statusText, xhr, $form) {
        var as = JSON.parse(response);
        if (as.error.status === false) {
            $('#spinner_loading').hide();
            $('form .form-group').removeClass('has-error');
            $('form .form-group .help-block').remove();
            $.each(as.error.message, function (key, value) {
                if (key === 'img_cover') {
                    $('#' + key).parent().parent().parent().parent().parent().addClass('has-error');
                    $('#' + key).parent().parent().after(value);
                } else {
                    $('#' + key).parent().parent().addClass('has-error');
                    $('#' + key).after('<span class="help-block text-danger">' + value + '</span>');
                }
            });
            $('#btnSave').removeAttr('disabled');
        } else {
            window.location.href = base_url + index_page + as.error.redirect;
        }
    }
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