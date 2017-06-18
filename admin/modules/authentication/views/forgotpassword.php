    <div class="login-box">
      <div class="login-logo">
        <a href="javascript:;"><b>KDC</b>Tutor</a>
      </div>
      <!-- /.login-logo -->
      <div class="login-box-body">
      <p class="login-box-msg" id="show_msg"></p>

        <form action="" id="form-forgotpassword" name="form-forgotpassword" method="post">
          <div class="form-group has-feedback">
            <input type="email" name="username" id="username" class="form-control required" placeholder="Email">
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-xs-4">
              <button type="button" id="btnLogin" class="btn btn-primary btn-block btn-flat">Send Email</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <a href="<?php echo site_url();?>login">Login</a><br>

      </div>
      <!-- /.login-box-body -->
    </div>
<!-- /.login-box -->