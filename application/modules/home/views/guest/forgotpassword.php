<div class="blog-header">
    <h1 class="blog-title"><?php echo $title_page; ?></h1>
    <p class="lead blog-description">ระบบจะส่งข้อมูลยืนยันรหัสผ่านไปยังอีเมล์ของคุณ</p>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <form name="form-forgotpassword" id="form-forgotpassword" class="form-horizontal">
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">อีเมล์</label>
                        <div class="col-sm-4">
                            <?php echo form_input("email", NULL, 'id="email" class="form-control"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-send" aria-hidden="true"></i> ส่งข้อมูล</button>
                        </div>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $("#form-forgotpassword").validate({
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