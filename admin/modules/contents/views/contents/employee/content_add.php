<link href="<?php echo base_url(); ?>assets/backend/js/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/backend/js/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">เพิ่มเนื้อหา</h1>
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
                <div class="panel-heading">รายละเอียดเนื้อหา</div>
                <div class="panel-body"> 
                    <div id="showerror"></div>
                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">หัวข้อ</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control required" id="title" name="title">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tax_number" class="col-sm-2 control-label">หมวดหมู่</label>
                        <div class="col-sm-2">
                            <?php echo form_dropdown('group_id', $group, NULL, 'class="form-control required"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tax_number" class="col-sm-2 control-label">วันเริ่ม-วันสิ้นสุด</label>
                        <div class="col-sm-4">

                            <div class="input-group"> 
                                <span class="input-group-addon"><?php echo form_checkbox('long_time', 1, TRUE, 'id="long_time"'); ?></span>
                                <input type="text" name="start" id="start" disabled="disabled" class="form-control datepicker text-center" value="<?php echo date('Y-m-d'); ?>">
                                <span class="input-group-addon">To</span>
                                <input type="text" name="finish" id="finish" disabled="disabled" class="form-control datepicker text-center" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sort_desc" class="col-sm-2 control-label">รายละเอียดแบบย่อ</label>
                        <div class="col-sm-5">
                            <?php echo form_textarea(array('name' => 'short_desc', 'row' => 5, 'class' => 'form-control')); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="links" class="col-sm-2 control-label">ลิ้งข้างนอก</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="links" name="links" placeholder="http://">
                        </div>
                    </div>                                                
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="disabled" value="1" checked="checked"> เปิดใช้งาน
                                </label>
                            </div>
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
                                        <input type="file" name="img_cover"></span>
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
                                        <input type="file" name="img_slide"></span>
                                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>        
                    <div class="form-group">
                        <label for="long_desc" class="col-sm-2 control-label">รายละเอียด</label>
                        <div class="col-sm-10">
                            <textarea class="form-control ckeditor" name="long_desc" id="long_desc" rows="6"></textarea>
                        </div>
                    </div>      
                </div>    
            </div>
        </div>
        <div class="col-lg-12">
            <div class="panel-body">
                <div class="text-center">
                    <button type="button" id="btnSave" class="btn btn-success btn-lg">Finish Create</button>                 
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/plugins/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/js/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/js/jquery.form.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/js/jquery.tagsinput.js"></script>
<script type="text/javascript">
    $('#long_time').click(function() {
        if ($(this).is(":checked")) {
            $('#start').attr('disabled', 'disabled');
            $('#finish').attr('disabled', 'disabled');
        } else {
            $('#start').removeAttr('disabled');
            $('#finish').removeAttr('disabled');
        }
    });
    $(function() {
        // Tags Input
        $(".tagsinput").tagsInput();
        $('.datepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        });
        CKEDITOR.replace('long_desc');
        var options = {
            url: base_url + index_page + 'contents/backend/result_contents/add',
            success: showResponse
        };
        $('#btnSave').click(function() {
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
                $('#myModal #button-confirm').removeAttr('disabled');
                $('#spinner_loading').hide();
                $('form #showerror').html(as.error.message);
                $('#btnSave').removeAttr('disabled');
            } else {
                window.location.href = base_url + index_page + 'contents/backend/contents';
            }
        }
    });
</script>