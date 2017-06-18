<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title><?php echo $title; ?></title>
        <link href="<?php echo base_url(); ?>assets/backend/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/backend/css/docs.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/backend/css/plugins/dataTables.bootstrap.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/backend/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/backend/css/plugins/timeline.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/backend/css/admin.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/backend/css/plugins/morris.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/backend/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/backend/js/plugins/bootstrap-spinedit/bootstrap-spinedit.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/backend/js/plugins/gritter/css/jquery.gritter.css" rel="stylesheet">
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="<?php echo base_url(); ?>assets/backend/js/jquery-1.11.0.js"></script>
        <script src="<?php echo base_url(); ?>assets/backend/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/backend/js/jquery.cookie.js"></script>
        <script src="<?php echo base_url(); ?>assets/backend/js/jquery.titlealert.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/plugins/dataTables/jquery.dataTables.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/plugins/dataTables/dataTables.bootstrap.js"></script> 
        <script src="<?php echo base_url(); ?>assets/backend/js/plugins/bootstrap-spinedit/bootstrap-spinedit.js"></script>
        <script src="<?php echo base_url(); ?>assets/backend/js/plugins/gritter/js/jquery.gritter.min.js"></script>
        <?php if ($this->ion_auth->in_group('wholesale') OR $this->ion_auth->in_group('admin') OR $this->ion_auth->in_group('seller')) { ?>
            <script src="//js.pusher.com/2.2/pusher.min.js" type="text/javascript"></script>
        <?php } ?>

        <script src="<?php echo base_url(); ?>assets/backend/js/script.js"></script>
        <style type="text/css">
            #page-wrapper {
                border-left: 1px solid #e7e7e7;
                margin: 0 0 0 250px;
                padding: 0 30px;
                position: inherit;
            }
            .container {
                width: 1045px;
            }
            .page-header {
                margin: 20px 0;
            }
        </style>
    </head>
    <body>
        <div id="wrapper">
            <!-- Navigation -->
            <nav style="margin-bottom: 0" role="navigation" class="navbar navbar-default navbar-static-top">
                <div class="navbar-header">
                    <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url() . index_page(); ?>backend">JIB-Office 2014</a>
                </div>
                <!-- /.navbar-header -->
                <?php require_once ('navbartop.php'); ?>                
                <!-- /.navbar-top-links -->

                <div role="navigation" class="navbar-default sidebar">
                    <div class="sidebar-nav navbar-collapse">
                        <ul id="side-menu" class="nav">
                            <li class="sidebar-search">
                                <div class="input-group custom-search-form">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                                <!-- /input-group -->
                            </li>
                            <?php foreach ($category as $key => $val) { ?>
                                <li>
                                    <a href="#"><?php echo $val; ?> <span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level collapse">
                                        <?php foreach ($this->Category_model->get_stk_category($key) as $key2 => $val2) { ?>
                                            <li>
                                                <a href="javascript:;" rel="<?php echo base_url() . index_page(); ?>products/backend/product/category/<?php echo $key2; ?>" class="load_product"><?php echo $val2; ?></a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </nav>

            <div id="page-wrapper" style="min-height: 404px;">
                <?php echo $body; ?>
            </div>
            <!-- /#page-wrapper -->

        </div>
        <script src="<?php echo base_url(); ?>assets/backend/js/plugins/metisMenu/metisMenu.min.js"></script>        
        <script type="text/javascript">
<?php
$parent_id = $this->ion_auth->get_user_id();
if ($this->ion_auth->in_group('wholesale') OR $this->ion_auth->in_group('admin') OR $this->ion_auth->in_group('seller')) {
    ?>
                var pusher = new Pusher('0523369038206a0a7183');
                var channel = pusher.subscribe('my_channel_<?php echo $parent_id; ?>');
                channel.bind('my_event', function(data) {
                    $.gritter.add({
                        title: 'Message',
                        text: data.message,
                        sticky: false,
                        time: 30000,
                        class_name: 'my-class',
                        before_open: function() {
                            $("#notification_topbar").load(base_url + index_page + "backend #notification_topbar");
                            $.titleAlert('New Message');
                        }
                    });
                });
<?php } ?>
        </script>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" id="button-close" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-warning" id="button-confirm">Confirm</button>
                        <button type="button" class="btn btn-primary" id="button-ok">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>
