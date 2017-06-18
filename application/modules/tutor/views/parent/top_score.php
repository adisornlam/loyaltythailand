    <div class="inner-bg">
    	<div class="container">
    		<div class="row">
    			<div class="col-md-12 form-box">
    				<div class="form-top">
    					<div class="form-top-left">
    						<h3>ประวัติการเรียน</h3>
    					</div>
    					<div class="form-top-right">
    						<i class="fa fa-book" aria-hidden="true"></i>
    					</div>
             <div class="col-sm-12">
               <table class="table">
                <thead>
                  <th width="10%">Code</th>
                  <th width="40%">Title</th>
                  <th width="15%">Score Total</th>
                </thead>
                <tbody>
                  <?php 
                  $sum = 0;
                  foreach($result_course as $item_course){ 
                    ?>
                  <tr>
                    <td><a href="<?php echo site_url(); ?>tutor/top5_score/<?php echo $item_course->id; ?>"><?php echo $item_course->code_no; ?></a></td>
                    <td><?php echo $item_course->title; ?> <?php echo ($item_course->private == 1 ? "(Private)":""); ?></td>
                    <td>
                      <?php
                      $q_score = $this->Tutor_model->get_score_sum($item_course->id,$item_course->user_id);
                      $score = ($q_score->row()->total!=NULL ? number_format($q_score->row()->total,2):0);
                      $sum += $score;
                      echo ($score>0 ? $score : "");
                      ?>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>