<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <title><?php echo $web_title; ?></title>
  <meta name="generator" content="Bootply" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link href="<?php echo base_url(); ?>assets/frontend/template/facebook/css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <![endif]-->
      <link href="<?php echo base_url(); ?>assets/frontend/template/facebook/css/styles.css" rel="stylesheet">

      <script src="https://use.fontawesome.com/c69d39ec5e.js"></script>

    </head>
    <body>
      <div class="wrapper">
        <div class="box">
          <div class="row row-offcanvas row-offcanvas-left">

            <!-- main right col -->
            <div class="column col-sm-12 col-xs-12" id="main">

              <!-- top nav -->
              <div class="navbar navbar-blue navbar-static-top">  
                <div class="navbar-header">
                  <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a href="<?php echo site_url(); ?>" class="navbar-brand logo">L</a>
                </div>
                <nav class="collapse navbar-collapse" role="navigation">
                  <form class="navbar-form navbar-left">
                    <div class="input-group input-group-sm" style="max-width:360px;">
                      <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
                      <div class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                      </div>
                    </div>
                  </form>
                  <ul class="nav navbar-nav">
                    <li>
                      <a href="<?php echo site_url(); ?>store/my/<?php echo $this->uri->segment(3); ?>"><i class="fa fa-home" aria-hidden="true"></i> หน้าหลัก</a>
                    </li>
                    <li>
                      <a href="<?php echo site_url(); ?>store/aboutus/<?php echo $this->uri->segment(3); ?>"><i class="fa fa-file" aria-hidden="true"></i> เกี่ยวกับเรา</a>
                    </li>
                    <li>
                    <a href="<?php echo site_url(); ?>store/contactus/<?php echo $this->uri->segment(3); ?>"><i class="fa fa-envelope" aria-hidden="true"></i> ติดต่อเรา</a>
                    </li>
                  </ul>
                  <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog" aria-hidden="true"></i></a>
                      <ul class="dropdown-menu">
                        <li><a href=""><i class="fa fa-user" aria-hidden="true"></i> Profile</a></li>
                        <li><a href=""><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
                      </ul>
                    </li>
                  </ul>
                </nav>
              </div>
              <!-- /top nav -->

              <div class="full col-sm-12">

                <!-- content -->                      
                <div class="row">
                  <?php echo $body; ?>
                </div>


                <hr>

                <h4 class="text-center">
                  <a href="http://bootply.com/96266" target="ext">Loyalty Thailand System 2017</a>
                </h4>

                <hr>


              </div><!-- /col-12 -->
            </div>
            <!-- /main -->

          </div>
        </div>
      </div>



      <!-- script references -->
      <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/frontend/template/facebook/js/bootstrap.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/frontend/template/facebook/js/scripts.js"></script>
    </body>
    </html>