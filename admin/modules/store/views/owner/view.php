<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-body">
				<form class="form-horizontal" role="form" id="form-add" method="post">
					<div class="form-group">
						<label for="title" class="col-sm-2 control-label">หัวข้อ</label>
						<div class="col-sm-5">
							<p class="form-control-static"><?php echo $item->title; ?></p>
						</div>
					</div>
					<div class="form-group">
						<label for="title" class="col-sm-2 control-label">สาขา</label>
						<div class="col-sm-5">
							<p class="form-control-static"><?php echo $item->branch_title; ?></p>
						</div>
					</div>
					<div class="form-group">
						<label for="desc_email" class="col-sm-2 control-label">รายการส่งแล้ว</label>
						<div class="col-sm-8">
							<table class="table table-striped">
								<thead> 
									<tr>
										<th>Parent Name</th> 
										<th>Email</th> 
									</tr>
								</thead>
								<tbody> 
									<?php foreach($email_result->result() as $item2){ ?>
									<tr> 
										<td><?php echo $item2->parent_first_name." ".$item2->parent_last_name; ?></td>
										<td><?php echo $item2->email; ?></td> 
									</tr> 
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="form-group">
						<label for="desc_email" class="col-sm-2 control-label">รายการยังไม่ส่ง</label>
						<div class="col-sm-8">
							<table class="table table-striped">
								<thead> 
									<tr>
										<th>Parent Name</th> 
										<th>Email</th> 
									</tr>
								</thead>
								<tbody> 
									<?php foreach($email_not_result->result() as $item3){ ?>
									<tr> 
										<td><?php echo $item3->parent_first_name." ".$item3->parent_last_name; ?></td>
										<td><?php echo $item3->email; ?></td> 
									</tr> 
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</form>
			</div> 
		</div>
	</div>
</div>