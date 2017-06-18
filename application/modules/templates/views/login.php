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
        <link href="<?php echo base_url(); ?>assets/backend/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/backend/css/admin.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/backend/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="<?php echo base_url(); ?>assets/backend/js/jquery-1.11.0.js"></script>
        <script src="<?php echo base_url(); ?>assets/backend/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/backend/js/plugins/metisMenu/metisMenu.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/backend/js/script.js"></script>

    </head>

    <body>
        <div id="wrapper">
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url() . index_page(); ?>backend">WEB Backend 2014</a>
                </div>
            </nav>
            <div class="container">
                <?php echo $body; ?>                
            </div>
        </div>        
        <!-- Modal -->
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
                        <button type="button" class="btn btn-success" id="button-confirm">Confirm</button>
                        <button type="button" class="btn btn-primary" id="button-ok">OK</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </body>

</html>
