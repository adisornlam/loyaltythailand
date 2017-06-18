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
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>ข้อมูลร้านค้า</strong>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="first_name" class="col-sm-2 control-label">ประเภทธุรกิจ</label>
                        <div class="col-sm-5">
                            <label class="radio-inline">
                                <input type="radio" name="biz_type" value="1" checked="checked"> ห้างหุ้นส่วน
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="biz_type" value="2"> บริษัท
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="biz_type" value="3"> บุคคลธรรมดา
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="company_name" class="col-sm-2 control-label">ชื่อบริษัท/ร้าน</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control required" id="company" name="company">
                        </div>
                    </div>    
                    <div class="form-group">
                        <label for="tax_number" class="col-sm-2 control-label">หมายเลขประจำตัวผู้เสียภาษีอากร</label>
                        <div class="col-sm-2">
                            <?php echo form_input('tax_number', null, 'class="form-control"'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>ข้อมูลส่วนตัว</strong>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="first_name" class="col-sm-2 control-label">ชื่อ</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control required" id="first_name" name="first_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="last_name" class="col-sm-2 control-label">นามสกุล</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control required" id="last_name" name="last_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_card" class="col-sm-2 control-label">เลขประจำตัวประชาชน</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control required" id="id_card" name="id_card">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-sm-2 control-label">เบอร์ติดต่อ</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control required" id="phone" name="phone">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>ที่อยู่จัดส่งสินค้า</strong>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="address" class="col-sm-2 control-label">ที่อยู่</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control required" id="address" name="address">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="province" class="col-sm-2 control-label">จังหวัด</label>
                        <div class="col-sm-3">
                            <?php
                            echo form_dropdown('province_id', $province, null, 'class="form-control required" id="province_id"');
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="amphur" class="col-sm-2 control-label">อำเภอ/เขต</label>
                        <div class="col-sm-3">
                            <select name="amphur_id" id="sub1" class="form-control required">
                                <option selected="selected" value=""></option>                            
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="district" class="col-sm-2 control-label">ตำบล</label>
                        <div class="col-sm-3">
                            <select name="district_id" id="sub2" class="form-control">
                                <option selected="selected" value=""></option>                            
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="zipcode" class="col-sm-2 control-label">รหัสไปรษณียร์</label>
                        <div class="col-sm-2">
                            <select name="zipcode" id="sub3" class="form-control">
                                <option selected="selected" value=""></option>                            
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>รายละเอียดใบกำกับภาษี</strong>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="copy_address" id="copy_address" value="1" checked="checked"> ใช้ข้อมูลด้านบน
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tax_company" class="col-sm-2 control-label">ชื่อบริษัท</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="tax_company" name="tax_company" disabled="disabled">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tax_address" class="col-sm-2 control-label">ที่อยู่</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control required" id="tax_address" name="tax_address" disabled="disabled">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tax_province" class="col-sm-2 control-label">จังหวัด</label>
                        <div class="col-sm-3">
                            <?php
                            echo form_dropdown('tax_province_id', $province, null, 'class="form-control required" id="tax_province_id" disabled="disabled"');
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tax_amphur" class="col-sm-2 control-label">อำเภอ/เขต</label>
                        <div class="col-sm-3">
                            <select name="tax_amphur_id" id="tax_sub1" class="form-control required" disabled="disabled">
                                <option selected="selected" value=""></option>                            
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tax_district" class="col-sm-2 control-label">ตำบล</label>
                        <div class="col-sm-3">
                            <select name="tax_district_id" id="tax_sub2" class="form-control" disabled="disabled">
                                <option selected="selected" value=""></option>                            
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tax_zipcode" class="col-sm-2 control-label">รหัสไปรษณียร์</label>
                        <div class="col-sm-2">
                            <select name="tax_zipcode" id="tax_sub3" class="form-control" disabled="disabled">
                                <option selected="selected" value=""></option>                            
                            </select>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>ข้อมูลเข้าสู่ระบบ</strong>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">อีเมล์</label>
                        <div class="col-sm-3">
                            <input type="email" class="form-control required" id="email" name="email">
                        </div>
                    </div>                                    
                    <div class="form-group">
                        <label for="password" class="col-sm-2 control-label">รหัสผ่าน</label>
                        <div class="col-sm-2">
                            <input type="password" class="form-control required" id="password" name="password">
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="code_member" class="col-sm-2 control-label">Code Member</label>
                        <div class="col-sm-2">
                            <?php echo form_input('code_member', NULL, 'class="form-control"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-9">
                            <div class="checkbox">
                                <label>
                                    <?php echo form_checkbox('dealer_status', 1, NULL, 'id="dealer_status"'); ?> ตัวแทนจำหน่าย
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-9">
                            <div class="checkbox">
                                <label>
                                    <?php echo form_checkbox('active', 1, NULL, 'id="active"'); ?> เปิดใช้งาน
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>ไฟล์เอกสารประกอบการสมัคร</strong>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="file1" class="col-sm-2 control-label">File 1</label>
                        <div class="col-sm-9">
                            <input type="file" id="file1" name="file1">
                            <p class="help-block">สำเนาบัตรประชาชาชนของกรรมการผู้มีอำนาจลงนามผูกพันบริษัทหรือเจ้าของกิจการ</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="file2" class="col-sm-2 control-label">File 2</label>
                        <div class="col-sm-9">
                            <input type="file" id="file2" name="file2">
                            <p class="help-block">สำเนาทะเบียนบ้านของกรรมการผู้มีอำนาจลงนามผูกพันบริษัทหรือเจ้าของกิจการ</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="file3" class="col-sm-2 control-label">File 3</label>
                        <div class="col-sm-9">
                            <input type="file" id="file3" name="file3">
                            <p class="help-block">ทะเบียนการค้า</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="file4" class="col-sm-2 control-label">File 4</label>
                        <div class="col-sm-9">
                            <input type="file" id="file4" name="file4">
                            <p class="help-block">หนังสือรับรองบริษัทพร้อมวัตถุประสงค์ทุกข้อ หากเป็นร้านค้าสามารถใช้ทะเบียนการค้าแทนได้</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="file5" class="col-sm-2 control-label">File 5</label>
                        <div class="col-sm-9">
                            <input type="file" id="file5" name="file5">
                            <p class="help-block">สำเนาเอกสาร ภพ. 20</p>
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
    <input type="hidden" name="group_id" value="10" />        
</form>
<script src="<?php echo base_url(); ?>assets/backend/js/jquery.form.js"></script>
<script type="text/javascript">
    $(function() {
        $('#form-add').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                company: {
                    validators: {
                        notEmpty: {},
                        stringLength: {min: 6, max: 100}
                    }
                },
                first_name: {
                    validators: {
                        notEmpty: {},
                        stringLength: {min: 6, max: 100}
                    }
                },
                last_name: {
                    validators: {
                        notEmpty: {},
                        stringLength: {min: 6, max: 100}
                    }
                },
                id_card: {
                    validators: {
                        notEmpty: {},
                        stringLength: {max: 13},
                        integer: {}
                    }
                },
                phone: {
                    validators: {
                        notEmpty: {},
                        integer: {}
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'The email is required and cannot be empty'
                        },
                        emailAddress: {
                            message: 'The input is not a valid email address'
                        }
                    }
                }
            }
        });
        $('#copy_address').click(function() {
            if ($(this).is(":checked")) {
                $('#tax_company, #tax_address, #tax_province_id, #tax_sub1, #tax_sub2, #tax_sub3').attr('disabled', 'disabled');
            } else {
                $('#tax_company, #tax_address, #tax_province_id, #tax_sub1, #tax_sub2, #tax_sub3').removeAttr("disabled");
            }
        });
        var options = {
            url: base_url + index_page + 'users/backend/result_user_seller/add',
            success: showResponse
        };
        $('#btnSave').click(function() {
            var data = {
                title: 'ยืนยัน',
                type: 'confirm',
                text: 'ย้นยันการเพิ่มข้อมูล ?'
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
                window.location.href = base_url + index_page + 'users/backend/user';
            });
            $('#myModal').on('hidden.bs.modal', function() {
                window.location.href = base_url + index_page + 'users/backend/user';
            });

        }
    }

    $('#province_id').change(function() {
        $('#sub2').empty();
        $('#sub3').empty();
        $.get(base_url + index_page + 'common/common/amphur/', {id: $(this).val()},
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
    $('#tax_province_id').change(function() {
        $('#tax_sub2').empty();
        $('#tax_sub3').empty();
        $.get(base_url + index_page + 'common/common/amphur/', {id: $(this).val()},
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
        $.get(base_url + index_page + 'common/common/district/', {id: $(this).val()},
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
        $.get(base_url + index_page + 'common/common/zipcode/', {amphur_id: $(this).val()}, function(data) {
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
        $.get(base_url + index_page + 'common/common/district/', {id: $(this).val()},
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
        $.get(base_url + index_page + 'common/common/zipcode/', {amphur_id: $(this).val()}, function(data) {
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
</script>