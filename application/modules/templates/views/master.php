<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../../favicon.ico">

  <title><?php echo (isset($title_web)? $title_web:TITLE); ?></title>

  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url(); ?>assets/frontend/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <link href="<?php echo base_url(); ?>assets/frontend/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="<?php echo base_url(); ?>assets/frontend/css/navbar-static-top.css" rel="stylesheet">

  <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
  <!--[if lt IE 9]><script src="<?php echo base_url(); ?>assets/frontend/js/ie8-responsive-file-warning.js"></script><![endif]-->
  <script src="<?php echo base_url(); ?>assets/frontend/js/ie-emulation-modes-warning.js"></script>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo base_url(); ?>assets/frontend/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="<?php echo base_url(); ?>assets/frontend/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo base_url(); ?>assets/frontend/js/ie10-viewport-bug-workaround.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    </head>

    <body>

      <!-- Static navbar -->
      <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Loyalty Thailand</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="<?php echo base_url().index_page(); ?>">หน้าหลัก</a></li>
              <li><a href="<?php echo base_url().index_page(); ?>home/abouts">เกี่ยวกับเรา</a></li>
              <li><a href="<?php echo base_url().index_page(); ?>home/contactus">ติดต่อเรา</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li><a href="../navbar/">ข้อมูลส่วนตัว</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </nav>


      <div class="container">

      <?php echo $body; ?>

      </div> <!-- /container -->
    </body>
    </html>
