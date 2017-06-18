<div class="alert alert-warning" role="alert">
    หากต้องการรีเซ็ตรหัสผ่านของคุณ ให้ป้อนที่อยู่อีเมลที่คุณใช้ในการลงชื่อเข้าใช้ JIB WS ซึ่งอาจเป็นที่อยู่ Gmail, ที่อยู่อีเมลแอป Google หรือที่อยู่อีเมลอื่นที่คุณเชื่อมโยงกับบัญชีของคุณ
</div>
<form class="form-horizontal" role="form" id="form-add" method="post">    
    <div id="showerror"></div>    
    <div class="form-group">
        <label for="name" class="col-lg-3 control-label">กรอกอีเมล์ที่ใช้สมัคร</label>
        <div class="col-lg-8">
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
    </div>        
    <div class="form-group">
        <div class="col-lg-offset-5 col-lg-7">
            <button type="button" id="btnDialogSave" class="btn btn-primary"> ส่งข้อมูล </button>
        </div>
    </div>
</form>
<script src="<?php echo base_url(); ?>assets/backend/js/jquery.form.js"></script>
<script type="text/javascript">
    $(function() {
        $('#email').focus();
        var options = {
            url: base_url + index_page + 'authentication/result_auth/forgotpassword',
            success: showResponse
        };
        $('#btnDialogSave').click(function() {
            $(this).attr('disabled', 'disabled');
            $(this).after('&nbsp;<span id="spinner_loading"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Loading...</span>');
            $('#form-add').ajaxSubmit(options);
        });
    });

    function showResponse(response, statusText, xhr, $form) {
        $('form .form-group').removeClass('has-error');
        $('form .help-block').remove();
        var as = JSON.parse(response);
        if (as.error.status === false) {
            $('form #showerror').html(as.error.message);
            $('#email').focus();
            $('#spinner_loading').remove();
            $('#btnDialogSave').removeAttr('disabled');
        } else {
            var data = {
                title: 'แจ้งเตือน',
                type: 'alert',
                text: '<div class="text-center">' + as.error.message + '</div>'
            };
            genModal(data);
            $('#myModal').on('hidden.bs.modal', function() {
                window.location.href = base_url + index_page;
            });

        }
    }
</script>