<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">เปลี่ยนรหัส่ผานใหม่</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-12">
        <form class="form-horizontal" role="form" id="form-add" method="post">   
            <div id="showerror"><?php echo $error; ?></div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="password" class="col-lg-4 control-label">รหัสผ่านใหม่</label>
                                <div class="col-lg-4">
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password_conf" class="col-lg-4 control-label">กรอกรหัสผ่านใหม่อีกครั้ง</label>
                                <div class="col-lg-4">
                                    <input type="password" class="form-control" id="passconf" name="passconf">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="panel-body">
                        <div class="text-center">
                            <button type="button" id="btnSave" class="btn btn-success btn-lg"> เปลี่ยนรหัสผ่าน </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
    <div class="col-lg-4">
        <div class="row"></div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/backend/js/jquery.form.js"></script>
<script type="text/javascript">
    $(function() {
        var options = {
            url: base_url + index_page + 'authentication/result_auth/changepassword',
            success: showResponse
        };
        $('#btnSave').click(function() {
            var data = {
                title: 'ยืนยันการเปลี่ยนรหัสผ่าน',
                type: 'confirm',
                text: 'ยืนยันการเปลี่ยนรหัสผ่านใหม่ ?'
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
                $('#myModal').modal('hide');
                window.location.href = base_url + index_page + as.error.redirect;
            });
            $('#myModal').on('hidden.bs.modal', function() {
                $('#myModal').modal('hide');
                window.location.href = base_url + index_page + as.error.redirect;
            });
        }
    }

</script>