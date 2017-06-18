    <div class="inner-bg">
    	<div class="container">
    		<div class="row">
    			<div class="col-md-12 form-box">
    				<div class="form-top">
    					<div class="form-top-left">
    						<h3><?php echo $page_title; ?></h3>
    					</div>
    					<div class="form-top-right">
    						<i class="fa fa-book" aria-hidden="true"></i>
    					</div>
             <div class="col-sm-12">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th width="20%" rowspan="2" class="text-center">รายวิชา</th>
                    <th width="10%" colspan="2" class="text-center">สอบครั้งที่/คะแนนเต็ม</th>
                    <th width="10%" colspan="2" class="text-center">Sum %</th>
                  </tr>
                  <tr>
                    <td class="text-center">1</td>
                    <td class="text-center">2</td>
                    <td class="text-center">1</td>
                    <td class="text-center">2</td>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $i=1;
                  $sum1 = 0;
                  $sum1_per = 0;
                  $sum2 = 0;
                  $sum2_per = 0;
                  $total = 0;
                  $user_id = $this->ion_auth->user()->row()->id;
                  foreach($result_course_sub->result() as $item2){ 

                    ?>
                    <tr>
                      <td><?php echo $item2->title; ?></td>
                      <?php
                      $score1 = $this->Tutor_model->get_quiz_score_item($this->uri->segment(3),$item2->id,1,$user_id);
                      $score2 = $this->Tutor_model->get_quiz_score_item($this->uri->segment(3),$item2->id,2,$user_id);

                      $sum1_per = ($score1['sum_per']>0?$score1['sum_per']:'');
                      $sum2_per = ($score2['sum_per']>0?$score2['sum_per']:'');


                      echo "<td class='text-center'>".($score1['sum']>0?$score1['sum']:'')."</td><td class='text-center'>".($score2['sum']>0?$score2['sum']:'')."</td>";

                      echo "<td class='text-center'>".$sum1_per."</td><td class='text-center'>".$sum2_per."</td>";
                      ?>
                    </tr>
                    <?php $i++; } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>