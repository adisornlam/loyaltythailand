<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $web_title; ?></title>

  <!-- CSS -->
  <!-- <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500"> -->
  <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet"> 
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/template/form-1/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/template/form-1/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/template/form-1/css/form-elements.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/template/form-1/css/style.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script type="text/javascript" src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script type="text/javascript" src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
            <![endif]-->

            <!-- Favicon and touch icons -->
            <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/frontend/template/form-1/ico/favicon.png">
            <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url(); ?>assets/frontend/template/form-1/ico/apple-touch-icon-144-precomposed.png">
            <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url(); ?>assets/frontend/template/form-1/ico/apple-touch-icon-114-precomposed.png">
            <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url(); ?>assets/frontend/template/form-1/ico/apple-touch-icon-72-precomposed.png">
            <link rel="apple-touch-icon-precomposed" href="<?php echo base_url(); ?>assets/frontend/template/form-1/ico/apple-touch-icon-57-precomposed.png">

            <!-- Javascript -->
            <script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/template/form-1/js/jquery-1.11.1.min.js"></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/template/form-1/bootstrap/js/bootstrap.min.js"></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/template/form-1/js/jquery.backstretch.min.js"></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/template/form-1/js/retina-1.1.0.min.js"></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/jquery.form.min.js"></script> 
            <script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/jquery.validate.min.js"></script> 
            <script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/script.js"></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/template/form-1/js/scripts.js"></script>

        <!--[if lt IE 10]>
            <script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/template/form-1/js/placeholder.js"></script>
            <![endif]-->
          </head>

          <body>

            <!-- Top menu -->
            <nav class="navbar navbar-inverse navbar-no-bg" role="navigation">
             <div class="container">
              <div class="navbar-header">
               <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="index.html">Bootstrap Registration Form Template</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="top-navbar-1">
             <ul class="nav navbar-nav navbar-right">
              <li>
               <span class="li-text">
                ติดตามข้อมูลข่าวสารอัพเดตได้ที่นี่
              </span> 
              <span class="li-social">
                <a href="#"><i class="fa fa-facebook"></i></a> 
                <a href="#"><i class="fa fa-twitter"></i></a> 
                <a href="#"><i class="fa fa-envelope"></i></a> 
                <a href="#"><i class="fa fa-skype"></i></a>
              </span>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Top content -->
    <div class="top-content">

      <?php echo $body; ?>   

    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
          </div>
          <div class="modal-body"></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="button-close" data-dismiss="modal">Close</button>
            <a class="btn btn-primary" href="javascript" target="_blank" id="button-print" role="button"><i class="fa fa-print"></i> Print</a>
            <button type="button" class="btn btn-warning" id="button-confirm">Confirm</button>     
            <button type="button" class="btn btn-warning hidden" id="button-confirm2">Confirm</button>     
            <button type="button" class="btn btn-primary" id="button-ok">OK</button>
          </div>
        </div>
      </div>
    </div>
  </body>

  </html>