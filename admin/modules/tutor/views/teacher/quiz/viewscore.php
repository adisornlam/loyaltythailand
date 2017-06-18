<div class="row">
	<div class="col-md-12 col-xs-12">
		<!-- Horizontal Form -->
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title">Quiz View</h3>
			</div>
			<!-- form start -->
			<form class="form-horizontal">
				<div class="box-body">
					<div class="form-group">
						<label class="col-sm-1 control-label">Branch</label>
						<p class="form-control-static"><?php echo $item->branch_title; ?></p>
					</div>
					<div class="form-group">
						<label class="col-sm-1 control-label">Course</label>
						<p class="form-control-static"><?php echo $item->course_no." ".$item->course_title; ?></p>
					</div>
				</div>
				<div class="box-body no-padding">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th width="2%" rowspan="2" class="text-center">No.</th>
								<th width="5%" rowspan="2" class="text-center">Code</th>
								<th width="25%" rowspan="2" class="text-center">Full Name</th>
								<?php 
								foreach ($course_sub_result->result() as $course_sub_item) 
								{
									echo "<th colspan='2' class='text-center'>".$course_sub_item->title."</th>";
								}
								?>
								<th colspan="2" class="text-center">ครั้งที่ 1</th>
								<th colspan="2" class="text-center">ครั้งที่ 2</th>
							</tr>
							<tr>
								<?php 
								foreach($course_sub_result->result() as $course_sub_item2) 
								{
									echo '<th class="text-center">1</th>';
									echo '<th class="text-center">2</th>';
								}
								?>
								<th class="text-center">รวม</th>
								<th class="text-center">%</th>
								<th class="text-center">รวม</th>
								<th class="text-center">%</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$i=1;
							$sum = 0;
							$course_num = $course_sub_result->num_rows();
							foreach($desc_result as $item2){ 
								?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $item2->code_member; ?></td>
									<td><?php echo $item2->first_name." ". $item2->last_name; ?></td>
									<?php
									$sum1 = 0;
									$sum1_per = 0;
									$sum2 = 0;
									$sum2_per = 0;
									$total1_per = 0;
									$total2_per = 0;
									foreach($course_sub_result->result() as $course_sub_item3)
									{
										$score1 = $this->Quiz_model->get_quiz_score_item($this->uri->segment(4),$course_sub_item3->id,1,$item2->student_id);
										$score2 = $this->Quiz_model->get_quiz_score_item($this->uri->segment(4),$course_sub_item3->id,2,$item2->student_id);
										$sum1_per += $score1['sum_per'];

										$sum2_per += $score2['sum_per'];
										echo "<td class='text-center'>".($score1['sum']>0?$score1['sum']:'')."</td><td class='text-center'>".($score2['sum']>0?$score2['sum']:'')."</td>";
									}
									$total1_per = ($sum1_per/($course_num*100))*100;
									$total2_per = ($sum2_per/($course_num*100))*100;
									?>
									<td class='text-center'><?php echo $sum1_per; ?></td>
									<td class='text-center'><?php echo number_format($total1_per,2); ?></td>
									<td class='text-center'><?php echo $sum2_per; ?></td>
									<td class='text-center'><?php echo number_format($total2_per,2); ?></td>
								</tr>
								<?php 
								$i++; 
								$sum = 0;
							} ?>
						</tbody>
					</table>
				</div>
			</form>
		</div>
		<!-- /.box -->
	</div>
</div>