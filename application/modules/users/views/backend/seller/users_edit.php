<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">ผู้สมัคร Dealer</h1>
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
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#info1" role="tab" data-toggle="tab">ข้อมูลร้านค้า</a></li>
                <li><a href="#info2" role="tab" data-toggle="tab">ข้อมูลส่วนตัว</a></li>
                <li><a href="#shipping" role="tab" data-toggle="tab">ที่อยู่จัดส่งสินค้า</a></li>
                <li><a href="#tax" role="tab" data-toggle="tab">รายละเอียดใบกำกับภาษี</a></li>
                <li><a href="#login" role="tab" data-toggle="tab">ข้อมูลเข้าสู่ระบบ</a></li>
                <li><a href="#file" role="tab" data-toggle="tab">ไฟล์เอกสารประกอบการสมัคร</a></li>
                <li><a href="#groupprice" role="tab" data-toggle="tab">กลุ่มราคา</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="info1">
                    <div class="panel-body">
                        <div id="showerror"></div>
                        <div class="form-group">
                            <label for="first_name" class="col-sm-2 control-label">ประเภทธุรกิจ</label>
                            <div class="col-sm-5">
                                <label class="radio-inline">
                                    <?php echo form_radio('biz_type', 1, ($item->biz_type == 1 ? TRUE : FALSE)); ?> ห้างหุ้นส่วน                                
                                </label>
                                <label class="radio-inline">
                                    <?php echo form_radio('biz_type', 2, ($item->biz_type == 2 ? TRUE : FALSE)); ?> บริษัท
                                </label>
                                <label class="radio-inline">
                                    <?php echo form_radio('biz_type', 3, ($item->biz_type == 3 ? TRUE : FALSE)); ?> บุคคลธรรมดา
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="company_name" class="col-sm-2 control-label">ชื่อบริษัท/ร้าน</label>
                            <div class="col-sm-3">
                                <?php echo form_input('company', $item->company, 'class="form-control"'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tax_number" class="col-sm-2 control-label">หมายเลขประจำตัวผู้เสียภาษีอากร</label>
                            <div class="col-sm-2">
                                <?php echo form_input('tax_number', $item->tax_number, 'class="form-control"'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="code_member" class="col-sm-2 control-label">Code Member</label>
                            <div class="col-sm-2">
                                <?php echo form_input('code_member', $item->code_member, 'class="form-control"'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-9">
                                <div class="checkbox">
                                    <label>
                                        <?php echo form_checkbox('dealer_status', 1, ($item->dealer_status == 1 ? TRUE : FALSE), 'id="dealer_status"'); ?> ตัวแทนจำหน่าย
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-9">
                                <div class="checkbox">
                                    <label>
                                        <?php echo form_checkbox('active', 1, ($item->active == 1 ? TRUE : FALSE), 'id="active"'); ?> เปิดใช้งาน
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="info2">
                    <div class="panel-body">
                        <div id="showerror"></div>
                        <div class="form-group">
                            <label for="first_name" class="col-sm-2 control-label">ชื่อ</label>
                            <div class="col-sm-3">
                                <?php echo form_input('first_name', $item->first_name, 'class="form-control"'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="last_name" class="col-sm-2 control-label">นามสกุล</label>
                            <div class="col-sm-3">
                                <?php echo form_input('last_name', $item->last_name, 'class="form-control"'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="id_card" class="col-sm-2 control-label">เลขประจำตัวประชาชน</label>
                            <div class="col-sm-2">
                                <?php echo form_input('id_card', $item->id_card, 'class="form-control"'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-sm-2 control-label">เบอร์ติดต่อ</label>
                            <div class="col-sm-2">
                                <?php echo form_input('phone', $item->phone, 'class="form-control"'); ?>
                            </div>
                        </div>                    
                    </div>
                </div>
                <div class="tab-pane" id="shipping">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="address" class="col-sm-2 control-label">ที่อยู่</label>
                            <div class="col-sm-4">
                                <?php echo form_input('address', $item->address, 'class="form-control"'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="province" class="col-sm-2 control-label">จังหวัด</label>
                            <div class="col-sm-3">
                                <?php
                                echo form_dropdown('province_id', $province, $item->province, 'class="form-control" id="province_id"');
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="amphur" class="col-sm-2 control-label">อำเภอ/เขต</label>
                            <div class="col-sm-3">
                                <select name="amphur_id" id="sub1" class="form-control">
                                    <option selected="selected" value=""></option>                            
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="district" class="col-sm-2 control-label">ตำบล/แขวง</label>
                            <div class="col-sm-3">
                                <select name="district_id" id="sub2" class="form-control">
                                    <option selected="selected" value=""></option>                            
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="zipcode" class="col-sm-2 control-label">รหัสไปรษณ๊ยร์</label>
                            <div class="col-sm-2">
                                <select name="zipcode" id="sub3" class="form-control">
                                    <option selected="selected" value=""></option>                            
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tax">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="tax_company" class="col-sm-2 control-label">ชื่อบริษัท</label>
                            <div class="col-sm-3">
                                <?php echo form_input('tax_company', $item->tax_company, 'class="form-control"'); ?>
                            </div>
                        </div>                    
                        <div class="form-group">
                            <label for="tax_address" class="col-sm-2 control-label">ที่อยู่</label>
                            <div class="col-sm-4">
                                <?php echo form_input('tax_address', $item->tax_address, 'class="form-control"'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tax_province" class="col-sm-2 control-label">จังหวัด</label>
                            <div class="col-sm-3">
                                <?php
                                echo form_dropdown('tax_province', $province, $item->tax_province, 'class="form-control" id="tax_province"');
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tax_amphur" class="col-sm-2 control-label">อำเภอ/เขต</label>
                            <div class="col-sm-3">
                                <select name="tax_amphur" id="tax_sub1" class="form-control">
                                    <option selected="selected" value=""></option>                            
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tax_district" class="col-sm-2 control-label">ตำบล/แขวง</label>
                            <div class="col-sm-3">
                                <select name="tax_district" id="tax_sub2" class="form-control">
                                    <option selected="selected" value=""></option>                            
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tax_zipcode" class="col-sm-2 control-label">รหัสไปรษณียร์</label>
                            <div class="col-sm-2">
                                <select name="tax_zipcode" id="tax_sub3" class="form-control">
                                    <option selected="selected" value=""></option>                            
                                </select>
                            </div>
                        </div>                                        
                    </div>
                </div>
                <div class="tab-pane" id="login">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">อีเมล์</label>
                            <div class="col-sm-3">
                                <?php echo form_input('email', $item->email, 'class="form-control" disabled="disabled"'); ?>
                            </div>
                        </div>                    
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">รหัสผ่าน</label>
                            <div class="col-sm-2">
                                <?php echo form_password('password', null, 'class="form-control"'); ?>
                            </div>
                        </div>                        
                    </div>
                </div>
                <div class="tab-pane" id="file">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="file1" class="col-sm-2 control-label">File 1</label>
                            <div class="col-sm-5">
                                <?php if ($item->file1 == NULL) { ?>
                                    <input type="file" id="file1" name="file1">
                                <?php } else { ?>
                                    <a href="<?php echo base_url() . index_page(); ?>users/backend/result_user_wholesale/get_file_download/<?php echo $item->id; ?>/file1" class="btn btn-success" role="button"><i class="fa fa-cloud-download"></i> Download</a> 
                                    <a class="btn btn-danger" role="button"><i class="fa fa-trash"></i>
                                        Delete</a>
                                <?php } ?>
                                <p class="help-block">สำเนาบัตรประชาชาชนของกรรมการผู้มีอำนาจลงนามผูกพันบริษัทหรือเจ้าของกิจการ</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="file2" class="col-sm-2 control-label">File 2</label>
                            <div class="col-sm-5">
                                <?php if ($item->file2 == NULL) { ?>
                                    <input type="file" id="file2" name="file2">
                                <?php } else { ?>
                                    <a href="<?php echo base_url() . index_page(); ?>users/backend/result_user_wholesale/get_file_download/<?php echo $item->id; ?>/file2" class="btn btn-success" role="button"><i class="fa fa-cloud-download"></i> Download</a> 
                                    <a class="btn btn-danger" role="button"><i class="fa fa-trash"></i>
                                        Delete</a>
                                <?php } ?>
                                <p class="help-block">สำเนาทะเบียนบ้านของกรรมการผู้มีอำนาจลงนามผูกพันบริษัทหรือเจ้าของกิจการ</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="file3" class="col-sm-2 control-label">File 3</label>
                            <div class="col-sm-5">
                                <?php if ($item->file3 == NULL) { ?>
                                    <input type="file" id="file3" name="file3">
                                <?php } else { ?>
                                    <a href="<?php echo base_url() . index_page(); ?>users/backend/result_user_wholesale/get_file_download/<?php echo $item->id; ?>/file3" class="btn btn-success" role="button"><i class="fa fa-cloud-download"></i> Download</a> 
                                    <a class="btn btn-danger" role="button"><i class="fa fa-trash"></i>
                                        Delete</a>
                                <?php } ?>
                                <p class="help-block">ทะเบียนการค้า</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="file4" class="col-sm-2 control-label">File 4</label>
                            <div class="col-sm-5">
                                <?php if ($item->file4 == NULL) { ?>
                                    <input type="file" id="file4" name="file4">
                                <?php } else { ?>
                                    <a href="<?php echo base_url() . index_page(); ?>users/backend/result_user_wholesale/get_file_download/<?php echo $item->id; ?>/file4" class="btn btn-success" role="button"><i class="fa fa-cloud-download"></i> Download</a> 
                                    <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i>
                                        Delete</button>
                                <?php } ?>
                                <p class="help-block">หนังสือรับรองบริษัทพร้อมวัตถุประสงค์ทุกข้อ หากเป็นร้านค้าสามารถใช้ทะเบียนการค้าแทนได้</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="file5" class="col-sm-2 control-label">File 5</label>
                            <div class="col-sm-5">
                                <?php if ($item->file5 == NULL) { ?>
                                    <input type="file" id="file5" name="file5">
                                <?php } else { ?>
                                    <a href="<?php echo base_url() . index_page(); ?>users/backend/result_user_wholesale/get_file_download/<?php echo $item->id; ?>/file5" class="btn btn-success" role="button"><i class="fa fa-cloud-download"></i> Download</a>
                                    <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i>
                                        Delete</button>
                                <?php } ?>
                                <p class="help-block">สำเนาเอกสาร ภพ. 20</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="groupprice">
                    <div class="panel-body">
                        <div class="bs-callout bs-callout-warning">
                            <h4>กำหนดราคาให้กับ Dealer</h4>
                            <p>กำหนดราคาให้กับ Dealer โดยเลือกที่กลุ่มของราคา</p>
                        </div>
                        <div class="radio">
                            <label>
                                <?php echo form_radio('group_price', 4, ($item->group_price == 4 ? TRUE : FALSE)); ?>
                                ราคาขายปลีก
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <?php echo form_radio('group_price', 5, ($item->group_price == 5 ? TRUE : FALSE)); ?>
                                ราขาขายส่ง (Price 5)
                            </label>
                        </div>
                        <div class="radio disabled">
                            <label>
                                <?php echo form_radio('group_price', 6, ($item->group_price == 6 ? TRUE : FALSE)); ?>
                                ราขาขายส่ง (Price 6)
                            </label>
                        </div>
                        <div class="radio disabled">
                            <label>
                                <?php echo form_radio('group_price', 7, ($item->group_price == 7 ? TRUE : FALSE)); ?>
                                ราขาขายส่ง (Price 7)
                            </label>
                        </div>
                        <div class="radio disabled">
                            <label>
                                <?php echo form_radio('group_price', 8, ($item->group_price == 8 ? TRUE : FALSE)); ?>
                                ราขาขายส่ง (Price 8)
                            </label>
                        </div>
                        <div class="radio disabled">
                            <label>
                                <?php echo form_radio('group_price', 9, ($item->group_price == 9 ? TRUE : FALSE)); ?>
                                ราขาขายส่ง (Price 9)
                            </label>
                        </div>
                        <div class="radio disabled">
                            <label>
                                <?php echo form_radio('group_price', 10, ($item->group_price == 10 ? TRUE : FALSE)); ?>
                                ราขาขายส่ง (Price 10)
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
        <div class="col-lg-12">
            <div class="panel-body">
                <div class="text-center">
                    <button type="button" id="btnSave" class="btn btn-success btn-lg"> บันทึก </button>                 
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="user_id" value="<?php echo $this->uri->segment(5); ?>" />
</form>
<script src="<?php echo base_url(); ?>assets/backend/js/jquery.form.js"></script>
<script type="text/javascript">
    $(function() {
        var options = {
            url: base_url + index_page + 'users/backend/result_user_wholesale/edit',
            success: showResponse
        };
        $('#btnSave').click(function() {
            var data = {
                title: 'ยืนยัน',
                type: 'confirm',
                text: 'ย้นยันการแก้ไขข้อมูล ?'
            };
            genModal(data);
            $('#myModal #button-confirm').removeAttr('disabled');
            $('body').on('click', '#myModal #button-confirm', function() {
                $(this).attr('disabled', 'disabled');
                $(this).after('&nbsp;<span id="spinner_loading"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Loading...</span>');
                $('#form-add').ajaxSubmit(options);
            });
            return false;
        });

        var province_id = <?php echo isset($item->province) ? $item->province : 0; ?>;
        var edit_sub1 = <?php echo isset($item->amphur) ? $item->amphur : 0; ?>;
        var edit_sub2 = <?php echo isset($item->district) ? $item->district : 0; ?>;
        var edit_sub3 = <?php echo isset($item->zipcode) ? $item->zipcode : 0; ?>;
        var tax_province = <?php echo isset($item->tax_province) ? $item->tax_province : 0; ?>;
        var tax_edit_sub1 = <?php echo isset($item->tax_amphur) ? $item->tax_amphur : 0; ?>;
        var tax_edit_sub2 = <?php echo isset($item->tax_district) ? $item->tax_district : 0; ?>;
        var tax_edit_sub3 = <?php echo isset($item->tax_zipcode) ? $item->tax_zipcode : 0; ?>;

        if ($('#province_id').val()) {
            if (edit_sub1 > 0) {
                $('#sub1').parent().parent().show();
                $.get(base_url + index_page + 'common/amphur/', {id: province_id},
                function(data) {
                    var as = JSON.parse(data);
                    if (as) {
                        var sub1 = $('#sub1');
                        sub1.empty();
                        $.each(as, function(index, element) {
                            var sub1_select = (index === '' + edit_sub1 + '' ? "selected" : "");
                            sub1.append("<option value='" + index + "' " + sub1_select + ">" + element + "</option>");
                        });


                        $.get(base_url + index_page + 'common/zipcode/', {amphur_id: edit_sub1}, function(data) {
                            var zp = JSON.parse(data);
                            if (zp) {
                                var sub3 = $('#sub3');
                                sub3.empty();
                                $.each(zp, function(index, element) {
                                    var sub3_select = (index === '' + edit_sub3 + '' ? "selected" : "");
                                    sub3.append("<option value='" + index + "' " + sub3_select + ">" + element + "</option>");
                                });
                            }
                        });
                    }
                });
                if (edit_sub2 > 0) {
                    $('#sub2').parent().parent().show();
                    $.get(base_url + index_page + 'common/district/', {id: edit_sub1},
                    function(data) {
                        var as = JSON.parse(data);
                        if (as) {
                            var sub2 = $('#sub2');
                            sub2.empty();
                            $.each(as, function(index, element) {
                                var sub2_select = (index === '' + edit_sub2 + '' ? "selected" : "");
                                sub2.append("<option value='" + index + "' " + sub2_select + ">" + element + "</option>");
                            });
                        }
                    });
                }
            }
        }

        if ($('#tax_province').val()) {
            if (tax_edit_sub1 > 0) {
                $('#tax_sub1').parent().parent().show();
                $.get(base_url + index_page + 'common/amphur/', {id: tax_province},
                function(data) {
                    var as = JSON.parse(data);
                    if (as) {
                        var tax_sub1 = $('#tax_sub1');
                        tax_sub1.empty();
                        $.each(as, function(index, element) {
                            var tax_sub1_select = (index === '' + tax_edit_sub1 + '' ? "selected" : "");
                            tax_sub1.append("<option value='" + index + "' " + tax_sub1_select + ">" + element + "</option>");
                        });


                        $.get(base_url + index_page + 'common/zipcode/', {amphur_id: tax_edit_sub1}, function(data) {
                            var zp = JSON.parse(data);
                            if (zp) {
                                var tax_sub3 = $('#tax_sub3');
                                tax_sub3.empty();
                                $.each(zp, function(index, element) {
                                    var tax_sub3_select = (index === '' + tax_edit_sub3 + '' ? "selected" : "");
                                    tax_sub3.append("<option value='" + index + "' " + tax_sub3_select + ">" + element + "</option>");
                                });
                            }
                        });
                    }
                });
                if (tax_edit_sub2 > 0) {
                    $('#tax_sub2').parent().parent().show();
                    $.get(base_url + index_page + 'common/district/', {id: tax_edit_sub1},
                    function(data) {
                        var as = JSON.parse(data);
                        if (as) {
                            var tax_sub2 = $('#tax_sub2');
                            tax_sub2.empty();
                            $.each(as, function(index, element) {
                                var tax_sub2_select = (index === '' + tax_edit_sub2 + '' ? "selected" : "");
                                tax_sub2.append("<option value='" + index + "' " + tax_sub2_select + ">" + element + "</option>");
                            });
                        }
                    });
                }
            }
        }
    });

    function showResponse(response, statusText, xhr, $form) {
        $('form .form-group').removeClass('has-error');
        $('form .help-block').remove();
        var as = JSON.parse(response);
        if (as.error.status === false) {
            $('form #showerror').html(as.error.message);
        } else {
            var data = {
                title: 'แจ้งเตือน',
                type: 'info',
                text: '<div class="text-center">' + as.error.message + '</div>'
            };
            genModal(data);
            $('#spinner_loading').remove();
            $('body').on('click', '#myModal #button-ok', function() {
                window.location.href = base_url + index_page + 'users/backend/user/edit/<?php echo $this->uri->segment(5); ?>';
            });
            $('#myModal').on('hidden.bs.modal', function() {
                window.location.href = base_url + index_page + 'users/backend/user/edit/<?php echo $this->uri->segment(5); ?>';
            });

        }
    }

    $('#province_id').change(function() {
        $('#sub2').empty();
        $('#sub3').empty();
        $.get(base_url + index_page + 'common/amphur/', {id: $(this).val()},
        function(data) {
            var as = JSON.parse(data);
            if (as) {
                var sub1 = $('#sub1');
                sub1.empty();
                sub1.append("<option value=''>Please select.</option>");
                $.each(as, function(index, element) {
                    sub1.append("<option value='" + index + "'>" + element + "</option>");
                });
            }
        });
    });
    $('#tax_province').change(function() {
        $('#tax_sub2').empty();
        $('#tax_sub3').empty();
        $.get(base_url + index_page + 'common/amphur/', {id: $(this).val()},
        function(data) {
            var as = JSON.parse(data);
            if (as) {
                var tax_sub1 = $('#tax_sub1');
                tax_sub1.empty();
                tax_sub1.append("<option value=''>Please select.</option>");
                $.each(as, function(index, element) {
                    tax_sub1.append("<option value='" + index + "'>" + element + "</option>");
                });
            }
        });
    });
    $('#sub1').change(function() {
        $('#sub2').empty();
        $.get(base_url + index_page + 'common/district/', {id: $(this).val()},
        function(data) {
            var as = JSON.parse(data);
            if (as) {
                var sub2 = $('#sub2');
                sub2.empty();
                sub2.append("<option value=''>Please select.</option>");
                $.each(as, function(index, element) {
                    sub2.append("<option value='" + index + "'>" + element + "</option>");
                });
            }
        });
        $.get(base_url + index_page + 'common/zipcode/', {amphur_id: $(this).val()}, function(data) {
            var zp = JSON.parse(data);
            if (zp) {
                var sub3 = $('#sub3');
                sub3.empty();
                $.each(zp, function(index, element) {
                    sub3.append("<option value='" + index + "'>" + element + "</option>");
                });
            }
        });
    });

    $('#tax_sub1').change(function() {
        $('#tax_sub2').empty();
        $.get(base_url + index_page + 'common/district/', {id: $(this).val()},
        function(data) {
            var as = JSON.parse(data);
            if (as) {
                var tax_sub2 = $('#tax_sub2');
                tax_sub2.empty();
                tax_sub2.append("<option value=''>Please select.</option>");
                $.each(as, function(index, element) {
                    tax_sub2.append("<option value='" + index + "'>" + element + "</option>");
                });
            }
        });
        $.get(base_url + index_page + 'common/zipcode/', {amphur_id: $(this).val()}, function(data) {
            var zp = JSON.parse(data);
            if (zp) {
                var tax_sub3 = $('#tax_sub3');
                tax_sub3.empty();
                $.each(zp, function(index, element) {
                    tax_sub3.append("<option value='" + index + "'>" + element + "</option>");
                });
            }
        });
    });

    $('#dealer_status').click(function() {
        if ($(this).is(":checked")) {
            $.get(base_url + index_page + 'users/backend/result_user/update_dealer_status', {user_id: <?php echo $this->uri->segment(5); ?>, status: 1});
        } else {
            $.get(base_url + index_page + 'users/backend/result_user/update_dealer_status', {user_id: <?php echo $this->uri->segment(5); ?>, status: 0});
        }
    });

    $('#active').click(function() {
        if ($(this).is(":checked")) {
            $.get(base_url + index_page + 'users/backend/result_user/update_active', {user_id: <?php echo $this->uri->segment(5); ?>, status: 1});
        } else {
            $.get(base_url + index_page + 'users/backend/result_user/update_active', {user_id: <?php echo $this->uri->segment(5); ?>, status: 0});
        }
    });
</script>