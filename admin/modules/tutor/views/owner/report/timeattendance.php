<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Search</h3>
			</div>
			<div class="box-body">
				<form class="form-horizontal" method="post" id="form-search" action="<?php echo base_url().index_page(); ?>tutor/report/timeattendance_export">
					<div class="form-group">
						<label for="start_datetime" class="col-sm-3 control-label">Date from</label>
						<div class="col-sm-2">
							<?php echo form_input('date_from', NULL, 'class="form-control date required" id="date_from"'); ?>
						</div>
					</div>
					<div class="form-group">
						<label for="start_datetime" class="col-sm-3 control-label">Date to</label>
						<div class="col-sm-2">
							<?php echo form_input('date_to', NULL, 'class="form-control date required" id="date_to"'); ?>
						</div>
					</div>
					<div class="form-group">
						<label for="branch_id" class="col-sm-3 control-label">Branch</label>
						<div class="col-sm-3">
							<?php
							echo form_dropdown('branch_id', $ddl_branch, null, 'class="form-control" id="branch_id"');
							?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<button type="button" id="btnSearch" class="btn btn-primary"><i class="fa fa-search"></i> Search </button>
							<button type="submit" name="btnExport" class="btn btn-success" value="excel"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Excel</button>
							<button type="submit" name="btnExport" class="btn btn-warning" value="pdf"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Export PDF</button>
						</div>
					</div>
				</form>
			</div> 
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Time Listall</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<table class="table table-striped table-bordered table-hover" id="student_listall"></table>
			</div> 
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('.date').datetimepicker({
			format: 'YYYY-MM-DD'
		});
		var oTable = $('#student_listall').dataTable({
			"processing": true,
			"serverSide": true,
			"deferLoading": 0,
			"ajax": {
				"url": site_url + "tutor/report/timeattendance_listall",
				"type": "POST",
				"data": function (d) {
					d.date_from = $('#date_from').val();
					d.date_to = $('#date_to').val();
				}
			},
			"language": {
				"url": "//cdn.datatables.net/plug-ins/1.10.9/i18n/Thai.json"
			},
			"aoColumns": [
			{"mData": "code_member","title": "Code", "width": "8%","orderable": false, "searchable": true},
			{"mData": "full_name","title": "Full Name", "width": "20%","orderable": false, "searchable": true},
			{"mData": "first_time","title": "First Time", "width": "12%","orderable": true, "searchable": false},
			{"mData": "last_time","title": "Last Time", "width": "12%","orderable": true, "searchable": false}
			],
			"sDom": 'ltipr'
		});

		$('#btnSearch').click(function () {
			if ($("#form-search").valid()) {
				oTable.fnDraw();
			}
		});
	});
</script>