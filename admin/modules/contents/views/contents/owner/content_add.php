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
                    <div id="showerror"></div>
                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">หัวข้อ</label>
                        <div class="col-sm-5">
                            <?php echo form_input('title', null, 'class="form-control" id="title"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tax_number" class="col-sm-2 control-label">หมวดหมู่</label>
                        <div class="col-sm-2">
                            <?php echo form_dropdown('group_id', $group, NULL, 'class="form-control" id="group_id"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sort_desc" class="col-sm-2 control-label">คำอธิบายย่อ</label>
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
                    <div class="form-group last">
                        <label class="control-label col-md-2">รูปใหญ่</label>
                        <div class="col-md-10">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                <div>
                                    <span class="btn btn-default btn-file">
                                        <span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
                                        <input type="file" name="photo1"></span>
                                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">ลิงค์</label>
                        <div class="col-sm-5">
                            <?php echo form_input('links', null, 'class="form-control" id="links" placeholder="http://"'); ?>
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
            url: base_url + index_page + 'contents/backend/result_content/add',
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
    });
</script>