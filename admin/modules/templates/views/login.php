<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo TITLE; ?> | Log in</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/plugins/iCheck/square/blue.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/dist/css/custom.css">
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">

  <?php echo $body; ?>

  <script src="<?php echo base_url(); ?>assets/backend/plugins/jQuery/jquery-2.2.3.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/backend/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/backend/plugins/iCheck/icheck.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/backend/plugins/jquery-validation/jquery.validate.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/backend/plugins/jquery-validation/additional-methods.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/backend/dist/js/jquery.form.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/backend/dist/js/custom.js"></script>
  <script type="text/javascript">
    $(function () {
      $('#form-login #username').focus();
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%'
      });

      var options = {
        url: site_url + 'authentication/check_login',
        success: showResponse
      };
      $('#btnLogin').click(function () {
        if ($("#form-login").valid()) {
          $(this).addClass('disabled');
          $('#form-login').ajaxSubmit(options);
          return false;
        }
      });
      
$('#form-login').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) { 
        if ($("#form-login").valid()) {
          $(this).addClass('disabled');
          $('#form-login').ajaxSubmit(options);
          return false;
        }
  }
});

    });

    function showResponse(response, statusText, xhr, $form) {
      var as = JSON.parse(response);
      if (as.error.status === false) {
        $('#show_msg').html(as.error.message_info);
        $('#btnLogin').removeClass('disabled');
      }else{
        window.location.href = site_url+as.error.redirect;
      }
    }
  </script>
</body>
</html>
