<link href="<?php echo base_url(); ?>assets/backend/js/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/backend/js/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">เพิ่มโปรโมชั่น</h1>
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

        </div>
        <div class="col-lg-12">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#info" role="tab" data-toggle="tab">Info</a></li>
                <li><a href="#photo" role="tab" data-toggle="tab">Photo</a></li>
                <li><a href="#promotion" role="tab" data-toggle="tab">Promotion</a></li>
                <li><a href="#description" role="tab" data-toggle="tab">Description</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="info">
                    <div class="panel-body">      
                        <div id="showerror"></div>
                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">หัวข้อ</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control required" id="title" name="title">
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
                                <div class="input-group"> 
                                    <span class="input-group-addon"><?php echo form_checkbox('chk_links', 1, TRUE, 'id="chk_links"'); ?></span>
                                    <input type="text" class="form-control" id="links" name="links" placeholder="http://" disabled="disabled">
                                </div>
                            </div>
                        </div>                           
                        <div class="form-group">
                            <label for="product_id" class="col-sm-2 control-label">ตำแหน่งแสดง</label>
                            <div class="col-sm-5">
                                <label class="radio-inline">
                                    <input type="radio" name="position" value="1"> Slide
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="position" value="2"> Banner Right
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="position" value="3" checked="checked"> Promotion
                                </label>
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
                    </div>
                </div>
                <div class="tab-pane" id="photo">
                    <div class="panel-body">
                        <div class="form-group last">
                            <label class="control-label col-md-2">รูปโปรโมชั่น</label>
                            <div class="col-md-10">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                    <div>
                                        <span class="btn btn-default btn-file">
                                            <span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
                                            <input type="file" name="thumbs"></span>
                                        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="promotion">
                    <div class="col-lg-6">
                        <br />
                        <div class="panel panel-default">
                            <div class="panel-heading">รายละเอียดโปรโมชั่น</div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="product_id" class="col-sm-4 control-label">สินค้าเข้าร่วมโปรโมชั่น</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><?php echo form_radio('chk_promotion', 1, TRUE, 'class="chk_promotion"'); ?></span>
                                            <input type="text" class="form-control" id="product_id" name="product_id" disabled="disabled">
                                        </div>
                                        <p class="help-block">ใช้ Product ID ในการกรอกช่องนี้</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="links" class="col-sm-4 control-label">หมวดหมู่เข้าร่วมโปรโมชั่น</label>
                                    <div class="col-sm-8">
                                        <div class="input-group"> 
                                            <span class="input-group-addon"><?php echo form_radio('chk_promotion', 2, NULL, 'class="chk_promotion"'); ?></span>
                                            <input type="text" class="form-control" id="cat_id" name="cat_id" disabled="disabled" />
                                        </div>
                                        <p class="help-block">กรณีมีหลายหมวดหมู่ให้ขั้นด้วย คอมม่า(,) เช่น 111, 222, 333 เป็นต้น</p>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label for="sale" class="col-sm-4 control-label">ส่วนลด</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="sale" name="sale" placeholder="จำนวนที่ลดจากราคาจริง">
                                        <label class="radio-inline">
                                            <input type="radio" name="sale_opt" value="1" checked="checked"> บาท
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="sale_opt" value="2"> เปอร์เซนต์
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="panel-body">
                            <a href="javascript:;" rel="contents/backend/promotion/add_coupon" title="สร้างคูปอง" class="btn btn-primary link_dialog" role="button">สร้างคูปอง</a>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <td>รหัส</td>
                                        <td>สถานะ</td>
                                        <td>ใช้เมื่อ</td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="description">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="long_desc" class="col-sm-2 control-label">รายละเอียด</label>
                            <div class="col-sm-10">
                                <textarea class="form-control ckeditor" name="long_desc" id="long_desc" rows="6"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="panel-body">
                <div class="text-center">
                    <button type="button" id="btnSave" class="btn btn-success btn-lg">Create Finish</button> 
                    <a href="javascript:;" id="btnTmpDelete" class="btn btn-danger btn-lg hidden link_dialog delete" role="button" title="ลบรายการฉบับร่างของโปรโมชั่นนี้"><i class="fa fa-trash-o"></i></a>                   
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/plugins/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/js/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/js/jquery.form.js"></script>
<script type="text/javascript">
    $('#long_time').click(function() {
        if ($(this).is(":checked")) {
            $('#product_id').attr('disabled', 'disabled');
            $('#finish').attr('disabled', 'disabled');
        } else {
            $('#start').removeAttr('disabled');
            $('#finish').removeAttr('disabled');
        }
    });
    $('#chk_links').click(function() {
        if ($(this).is(":checked")) {
            $('#links').attr('disabled', 'disabled');
        } else {
            $('#links').removeAttr('disabled');
        }
    });
    $('.chk_promotion').click(function() {
        if ($(this).val() == 1) {
            $('#product_id').removeAttr('disabled').focus();
            $('#cat_id').attr('disabled', 'disabled');
        } else if ($(this).val() == 2) {
            $('#cat_id').removeAttr('disabled').focus();
            $('#product_id').attr('disabled', 'disabled');

        } else {
            $('#product_id').removeAttr('disabled');
            $('#cat_id').attr('disabled', 'disabled');
        }
    });
    $(function() {
        $('#title').focus();
        var chk = $('.chk_promotion');
        if (chk.val() === 1) {
            $('#product_id').removeAttr('disabled').focus();
        } else if (chk.val() === 1) {
            $('#cat_id').removeAttr('disabled').focus();
        } else {
            $('#product_id').removeAttr('disabled').focus();
        }

        $('.datepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        });
        CKEDITOR.replace('long_desc');
        var options = {
            url: base_url + index_page + 'contents/backend/result_promotion/add',
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
        delay(function() {
            var options_temp = {
                url: base_url + index_page + 'contents/backend/result_promotion/add_temp'
            };
            for (instance in CKEDITOR.instances)
                CKEDITOR.instances.long_desc.updateElement();
            $('#form-add').ajaxSubmit(options_temp);
            $('#btnTmpDelete').removeClass('hidden').attr('rel', 'contents/backend/result_promotion/delete/' + $.cookie('temp_promotion_id'));
            $.gritter.add({
                title: 'แจ้งเดือน',
                text: 'บันทึกข้อมูลฉบับร่างเรียบร้อยแล้ว',
                sticky: false,
                time: '5000'
            });
        }, 30000);

        function showResponse(response, statusText, xhr, $form) {
            var as = JSON.parse(response);
            if (as.error.status === false) {
                $('#myModal #button-confirm').removeAttr('disabled');
                $('#spinner_loading').hide();
                $('form #showerror').html(as.error.message);
                $('#btnSave').removeAttr('disabled');
            } else {
                window.location.href = base_url + index_page + 'contents/backend/promotion';
            }
        }
    });
</script>