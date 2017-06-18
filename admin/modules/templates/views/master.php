<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo TITLE; ?></title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/plugins/datatables/css/dataTables.bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/dist/css/skins/_all-skins.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/dist/css/custom.css">
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src="<?php echo base_url(); ?>assets/backend/plugins/jQuery/jquery-2.2.3.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/backend/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/backend/plugins/datatables/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/backend/plugins/datatables/js/dataTables.bootstrap.js"></script>
  <script src="<?php echo base_url(); ?>assets/backend/plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/backend/plugins/fastclick/fastclick.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/backend/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/backend/plugins/jquery-validation/jquery.validate.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/backend/plugins/jquery-validation/additional-methods.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/backend/dist/js/jquery.form.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/backend/dist/js/app.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/backend/dist/js/demo.js"></script>
  <script src="<?php echo base_url(); ?>assets/backend/dist/js/custom.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<!-- Site wrapper -->
	<div class="wrapper">

		<header class="main-header">
			<!-- Logo -->
			<a href="<?php echo base_url().index_page(); ?>" class="logo">
				<!-- mini logo for sidebar mini 50x50 pixels -->
				<span class="logo-mini"><b>Loyalty</b></span>
				<!-- logo for regular state and mobile devices -->
				<span class="logo-lg"><b>Loyalty</b>Thailand</span>
			</a>
			<!-- Header Navbar: style can be found in header.less -->
			<nav class="navbar navbar-static-top">
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<span id="clock_time" style="font-size: 25pt; color:#FFF;"></span>
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<!-- User Account: style can be found in dropdown.less -->
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<span class="hidden-xs"><?php echo $this->ion_auth->user()->row()->first_name . " " . $this->ion_auth->user()->row()->last_name; ?></span>
							</a>
							<ul class="dropdown-menu">
								<!-- Menu Footer-->
								<li class="user-footer">
									<div class="pull-left">
										<a href="#" class="btn btn-default btn-flat">Profile</a>
									</div>
									<div class="pull-right">
										<a href="<?php echo base_url() . index_page(); ?>logout" class="btn btn-default btn-flat">Sign out</a>
									</div>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
		</header>

		<!-- =============================================== -->

		<!-- Left side column. contains the sidebar -->
		<aside class="main-sidebar">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
				<!-- sidebar menu: : style can be found in sidebar.less -->
				<ul class="sidebar-menu">
					<li class="header">MAIN NAVIGATION</li>
					<?php
					foreach ($this->Menu_model->get_menu_auth() as $item) {
						?>
						<li class="treeview <?php echo ($this->uri->segment(1)==$item->modules?'active':''); ?>">
							<a href="<?php echo ($item->url != "javascript:;"? base_url() . index_page() . $item->url:"javascript:;"); ?>">
								<i class="<?php echo $item->icon; ?>"></i> <span><?php echo $item->title; ?></span>
								<?php if ($this->Menu_model->get_menu_auth($item->id)) { ?>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
								<?php } ?>
							</a>
							<?php if ($this->Menu_model->get_menu_auth($item->id)) { ?>
							<ul class="treeview-menu <?php echo ($this->uri->segment(1)==$item->modules?'active':''); ?>">
								<?php foreach ($this->Menu_model->get_menu_auth($item->id) as $item2) { ?>
								<li>
									<a class="" href="<?php echo base_url() . index_page() . $item2->url; ?>"><?php echo $item2->title; ?>
										<?php if ($this->Menu_model->get_menu_auth($item2->id)) { ?>
										<span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
										</span>
										<?php } ?>
									</a>
									<?php if ($this->Menu_model->get_menu_auth($item2->id)) { ?>
									<ul class="treeview-menu <?php echo ($this->uri->segment(1)==$item->modules?'active':''); ?>">
										<?php foreach ($this->Menu_model->get_menu_auth($item2->id) as $item3) { ?>
										<li><a href="<?php echo base_url() . index_page() . $item3->url; ?>"><i class="fa fa-circle-o"></i> <?php echo $item3->title; ?></a></li>
										<?php } ?>
									</ul>
									<?php } ?>
								</li>
								<?php } ?>
							</ul>
							<?php } ?>

						</li>
						<?php } ?>
					</ul>
				</section>
				<!-- /.sidebar -->
			</aside>

			<!-- =============================================== -->

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						<?php echo $title_page; ?>
					</h1>
					<?php if(isset($breadcrumbs)){ ?>
					<ol class="breadcrumb">
						<?php foreach ($breadcrumbs as $key => $val) { ?>
						<?php if ($val === reset($breadcrumbs)) { ?>
						<li><a href="<?php echo base_url() . index_page() . $val; ?>"><i class="icon-home"></i> <?php echo $key; ?></a></li>
						<?php } elseif ($val === end($breadcrumbs)) { ?>
						<li class="active"><?php echo $key; ?></li>
						<?php } else { ?>
						<li><a href="<?php echo base_url() . index_page() . $val; ?>"> <?php echo $key; ?></a></li>
						<?php } ?>
						<?php } ?>
					</ol>
					<?php } ?>
				</section>

				<!-- Main content -->
				<section class="content">

					<?php echo $body; ?>

				</section>
				<!-- /.content -->
			</div>
			<!-- /.content-wrapper -->

			<footer class="main-footer">
				<div class="pull-right hidden-xs">
					<b>Version</b> 2.3.6
				</div>
				<strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
				reserved.
			</footer>
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
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