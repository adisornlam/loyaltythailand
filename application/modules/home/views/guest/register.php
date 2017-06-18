<div class="blog-header">
    <h1 class="blog-title"><?php echo $title_page; ?></h1>
    <p class="lead blog-description">สมัครเป็นสมาชิกระบบสะสมแต้มออนไลน์</p>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <form name="form-register" id="form-register" class="form-horizontal" method="post" action="<?php echo site_url(); ?>home/register">
                    <div class="form-group">
                        <label for="fullname" class="col-md-2 control-label">ชื่อ - นามสกุล</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-md-4">
                                    <?php echo form_input("first_name", NULL, 'id="first_name" class="form-control required" placeholder="ชื่อ"'); ?>
                                </div>
                                <div class="col-md-4">
                                    <?php echo form_input("last_name", NULL, 'id="last_name" class="form-control required" placeholder="นามสกุล"'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">อีเมล์</label>
                        <div class="col-sm-4">
                            <?php echo form_input("email", NULL, 'id="email" class="form-control required"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mobile" class="col-sm-2 control-label">เบอร์โทรศัพท์</label>
                        <div class="col-sm-3">
                            <?php echo form_input("mobile", NULL, 'id="mobile" class="form-control required"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mobile" class="col-sm-2 control-label">รหัสผ่าน</label>
                        <div class="col-sm-3">
                            <?php echo form_password("password", NULL, 'id="password" class="form-control required"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" name="btnSave" id="btnSave" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i> สมัครสมาชิก</button>
                        </div>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        var options = {
            url: site_url + 'home/register_save',
            success: showResponse
        };
        $('#btnSave').click(function () {
            if ($("#form-register").valid()) {
                $(this).addClass('disabled');
                $('#form-register').ajaxSubmit(options);
                return false;
            }
        });
    });

    function showResponse(response, statusText, xhr, $form) {
        var as = JSON.parse(response);
        if (as.error.status === false) {
            $('#btnSave').removeClass('disabled');
        } else {
            window.location.href = as.error.redirect;
        }
    }
</script>