<div class="row" style="margin-top: 7%;">
    <div class="col-lg-8">
        <div class="panel panel-default borderless">
            <div class="panel-body">
                <h1>สิทธิประโยชน์ตัวแทนจำหน่าย</h1>
                <p>ลูกค้าที่สมัครเป็นสมาชิกตัวแทนจำหน่าย จะได้รับสิทธิพิเศาต่างๆในการซื้อสินค้าและอื่นๆอีกมากมาย ดังนี้</p>
                <ol>
                    <li>ได้รับสิทธิในการตรวจสอบราคาสินค้าจากทาง Website ของบริษัทฯ โดยบริษัทฯ จะส่งหรือยืนยัน Username และ Password ทาง Email ที่ให้ไว้เท่านั้น</li>
                    <li>ได้รับการบริการก่อนขายและหลังขายตามเงื่อนไขข้อตกลงที่จัดทำขึ้นเป็นพิเศษ สำหรับผู้แทนจำหน่ายเท่านั้น</li>
                    <li>ได้รับรายการส่งเสริมการขายจากบริษัทฯ ตามวาระที่บริษัทฯ จะจัดให้มีอย่างต่อเนื่องและอยู่ภายใต้ข้อกำหนดการบริการของบริษัทฯ</li>
                    <li>ได้รับข้อมูลข่าวสารความเคลื่อนไหวของสินค้าและสินค้าใหม่อย่างต่อเนื่องและรวดเร็ว</li>
                </ol>
            </div>
        </div>
        <div class="panel panel-default borderless">
            <div class="panel-body">
                <form class="form-horizontal" role="form" id="form-add" method="post" enctype="multipart/form-data">   
                    <div id="showerror"></div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <strong>ข้อมูลร้านค้า</strong>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="first_name" class="col-sm-3 control-label">ประเภทธุรกิจ</label>
                                        <div class="col-sm-9">
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
                                        <label for="company_name" class="col-sm-3 control-label">ชื่อบริษัท/ร้าน</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control required" id="company" name="company">
                                        </div>
                                    </div>    
                                    <div class="form-group">
                                        <label for="tax_number" class="col-sm-3 control-label">หมายเลขประจำตัวผู้เสียภาษีอากร</label>
                                        <div class="col-sm-5">
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
                                        <label for="first_name" class="col-sm-3 control-label">ชื่อ</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control required" id="first_name" name="first_name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name" class="col-sm-3 control-label">นามสกุล</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control required" id="last_name" name="last_name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="id_card" class="col-sm-3 control-label">เลขประจำตัวประชาชน</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control required" id="id_card" name="id_card">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone" class="col-sm-3 control-label">เบอร์ติดต่อ</label>
                                        <div class="col-sm-3">
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
                                        <label for="address" class="col-sm-3 control-label">ที่อยู่</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control required" id="address" name="address">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="province" class="col-sm-3 control-label">จังหวัด</label>
                                        <div class="col-sm-5">
                                            <?php
                                            echo form_dropdown('province_id', $province, null, 'class="form-control required" id="province_id"');
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="amphur" class="col-sm-3 control-label">อำเภอ/เขต</label>
                                        <div class="col-sm-5">
                                            <select name="amphur_id" id="sub1" class="form-control required">
                                                <option selected="selected" value=""></option>                            
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="district" class="col-sm-3 control-label">ตำบล</label>
                                        <div class="col-sm-5">
                                            <select name="district_id" id="sub2" class="form-control">
                                                <option selected="selected" value=""></option>                            
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="zipcode" class="col-sm-3 control-label">รหัสไปรษณียร์</label>
                                        <div class="col-sm-3">
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
                                        <div class="col-sm-offset-3 col-sm-9">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="copy_address" id="copy_address" value="1" checked="checked"> ใช้ข้อมูลด้านบน
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tax_company" class="col-sm-3 control-label">ชื่อบริษัท</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="tax_company" name="tax_company" disabled="disabled">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tax_address" class="col-sm-3 control-label">ที่อยู่</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control required" id="tax_address" name="tax_address" disabled="disabled">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tax_province" class="col-sm-3 control-label">จังหวัด</label>
                                        <div class="col-sm-5">
                                            <?php
                                            echo form_dropdown('tax_province_id', $province, null, 'class="form-control required" id="tax_province_id" disabled="disabled"');
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tax_amphur" class="col-sm-3 control-label">อำเภอ/เขต</label>
                                        <div class="col-sm-5">
                                            <select name="tax_amphur_id" id="tax_sub1" class="form-control required" disabled="disabled">
                                                <option selected="selected" value=""></option>                            
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tax_district" class="col-sm-3 control-label">ตำบล</label>
                                        <div class="col-sm-5">
                                            <select name="tax_district_id" id="tax_sub2" class="form-control" disabled="disabled">
                                                <option selected="selected" value=""></option>                            
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tax_zipcode" class="col-sm-3 control-label">รหัสไปรษณียร์</label>
                                        <div class="col-sm-3">
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
                                        <label for="email" class="col-sm-3 control-label">อีเมล์</label>
                                        <div class="col-sm-5">
                                            <input type="email" class="form-control required" id="email" name="email">
                                        </div>
                                    </div>                                    
                                    <div class="form-group">
                                        <label for="password" class="col-sm-3 control-label">รหัสผ่าน</label>
                                        <div class="col-sm-3">
                                            <input type="password" class="form-control required" id="password" name="password">
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
                                        <label for="file1" class="col-sm-3 control-label">File 1</label>
                                        <div class="col-sm-9">
                                            <input type="file" id="file1" name="file1">
                                            <p class="help-block">สำเนาบัตรประชาชาชนของกรรมการผู้มีอำนาจลงนามผูกพันบริษัทหรือเจ้าของกิจการ</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="file2" class="col-sm-3 control-label">File 2</label>
                                        <div class="col-sm-9">
                                            <input type="file" id="file2" name="file2">
                                            <p class="help-block">สำเนาทะเบียนบ้านของกรรมการผู้มีอำนาจลงนามผูกพันบริษัทหรือเจ้าของกิจการ</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="file3" class="col-sm-3 control-label">File 3</label>
                                        <div class="col-sm-9">
                                            <input type="file" id="file3" name="file3">
                                            <p class="help-block">ทะเบียนการค้า</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="file4" class="col-sm-3 control-label">File 4</label>
                                        <div class="col-sm-9">
                                            <input type="file" id="file4" name="file4">
                                            <p class="help-block">หนังสือรับรองบริษัทพร้อมวัตถุประสงค์ทุกข้อ หากเป็นร้านค้าสามารถใช้ทะเบียนการค้าแทนได้</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="file5" class="col-sm-3 control-label">File 5</label>
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
                                    <button type="button" id="btnSave" class="btn btn-success btn-lg"> สมัครตัวแทนจำหน่าย </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="user_keys" id="user_keys" value="<?php echo $this->uri->segment(3); ?>" />
                </form>
            </div>
        </div>                                
    </div>
    <div class="col-lg-4">
        <div class="row"></div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/backend/js/jquery.form.js"></script>
<script type="text/javascript">
    $(function() {
        $('#copy_address').click(function() {
            if ($(this).is(":checked")) {
                $('#tax_company, #tax_address, #tax_province_id, #tax_sub1, #tax_sub2, #tax_sub3').attr('disabled', 'disabled');
            } else {
                $('#tax_company, #tax_address, #tax_province_id, #tax_sub1, #tax_sub2, #tax_sub3').removeAttr("disabled");
            }
        });
        if ($('#user_keys').val().length !== 32) {
            alert('URL สมัครไม่ถูกต้อง กรุณาตรวจสอบหรือติดต่อเจ้าหน้าที่');
        }
        var options = {
            url: base_url + index_page + 'authentication/backend/result_authentication/register',
            success: showResponse
        };
        $('#btnSave').click(function() {
            var data = {
                title: 'ยืนยันการสม้คร',
                type: 'confirm',
                text: 'ยืนยันข้อมูลการสมัครตัวแทนจำหน่าย'
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
        var as = JSON.parse(response);
        if (as.error.status === false) {
            $('#myModal #button-confirm').removeAttr('disabled');
            $('#spinner_loading').hide();
            $('#myModal').modal('hide');
            $('form #showerror').html(as.error.message);
        } else {
            var data = {
                title: 'สมัครตัวแทนสำเร็จ',
                type: 'info',
                text: as.error.message
            };
            genModal(data);
            $('#spinner_loading').remove();
            $('body').on('click', '#myModal #button-ok', function() {
                window.location.href = base_url + index_page + 'backend/login';
            });
            $('#myModal').on('hidden.bs.modal', function() {
                window.location.href = base_url + index_page + 'backend/login';
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