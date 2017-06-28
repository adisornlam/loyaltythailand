<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?php echo (isset($description) ? $description : ''); ?>">
        <meta name="keywords" content="<?php echo (isset($keywords) ? $keywords : ''); ?>">
        <meta name="author" content="">
        <link rel="icon" href="<?php echo base_url(); ?>loyalty_fav.ico">
        <title><?php echo (isset($title_web) ? $title_web : TITLE); ?></title>
        <link href="<?php echo base_url(); ?>assets/frontend/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/frontend/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/frontend/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/frontend/css/navbar-static-top.css" rel="stylesheet">
        <!--[if lt IE 9]><script src="<?php echo base_url(); ?>assets/frontend/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/ie-emulation-modes-warning.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo base_url(); ?>assets/frontend/js/vendor/jquery.min.js"><\/script>')</script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/plugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/frontend/plugins/jquery-validation/additional-methods.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/plugins/jquery-validation/localization/messages_th.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/jquery.form.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/custom.js"></script>
        <script src="<?php echo base_url(); ?>assets/frontend/js/ie10-viewport-bug-workaround.js"></script>
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
          <![endif]-->
        <script type="text/javascript">
            var site_url = '<?php echo site_url(); ?>';
        </script>
    </head>
    <body>
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo site_url(); ?>store/my/<?php echo $this->uri->segment(3); ?>"><?php echo (isset($logo_text) ? $logo_text : 'Loyalty Thailand'); ?></a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="<?php echo ($this->uri->segment(2) == '' ? 'active' : ''); ?>"><a href="<?php echo site_url(); ?>store/my/<?php echo $this->uri->segment(3); ?>">หน้าหลัก</a></li>
                        <li class="<?php echo ($this->uri->segment(2) == 'aboutus' ? 'active' : ''); ?>"><a href="<?php echo site_url(); ?>store/aboutus/<?php echo $this->uri->segment(3); ?>">เกี่ยวกับเรา</a></li>
                        <li class="<?php echo ($this->uri->segment(2) == 'contactus' ? 'active' : ''); ?>"><a href="<?php echo site_url(); ?>store/contactus/<?php echo $this->uri->segment(3); ?>">ติดต่อเรา</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php if ($this->session->userdata('logged_in')) { ?>
                            <li><a href="<?php echo site_url(); ?>users/profile">ข้อมูลส่วนตัว</a></li>
                        <?php } else { ?>
                            <li><a href="<?php echo site_url(); ?>store/login/<?php echo $this->uri->segment(3); ?>">เข้าสู่ระบบ</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
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
