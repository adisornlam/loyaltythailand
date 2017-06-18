<div class="row">
	<div class="col-md-12 col-xs-12">
		<!-- Horizontal Form -->
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Course Information</h3>
			</div>
			<form class="form-horizontal" name="form-add" id="form-add" method="post">
				<table class="table table-bordered">
					<thead>
						<th width="10%">Code</th>
						<th width="60%">Title</th>
						<th width="30%"></th>
					</thead>
					<tbody>
						<?php foreach($result_course as $item_course){ ?>
						<tr>
							<td><?php echo $item_course->code_no; ?></td>
							<td><?php echo $item_course->title; ?></td>
							<td></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<div class="box-footer">
					<div class="col-sm-offset-3 col-sm-9">
						<button type="button" class="btn btn-info pull-left" id="btnSave"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
					</div>
				</div>
				<!-- /.box-footer -->
				<input type="hidden" name="id" value="<?php echo $item->id; ?>">
			</form>
		</div>
	</div>
</div>