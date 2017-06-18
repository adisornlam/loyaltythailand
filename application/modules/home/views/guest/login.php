<div class="blog-header">
    <h1 class="blog-title"><?php echo $title_page; ?></h1>
    <p class="lead blog-description">The official example template of creating a blog with Bootstrap.</p>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <form name="form-login" id="form-login" class="form-horizontal">
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">อีเมล์</label>
                        <div class="col-sm-4">
                            <?php echo form_input("email", NULL, 'id="email" class="form-control required email"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mobile" class="col-sm-2 control-label">รหัสผ่าน</label>
                        <div class="col-sm-2">
                            <?php echo form_password("password", NULL, 'id="password" class="form-control required"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-key" aria-hidden="true"></i> เข้าสู่ระบบ</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <a href="<?php echo site_url(); ?>home/forgotpassword">ลืมรหัสผ่าน</a>
                        </div>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $("#form-login").validate({
            lang: 'th',
            rules: {
                email: {
                    required: true,
                    email: true
                }
            }
        });
    });
</script>