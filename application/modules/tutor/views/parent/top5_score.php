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
               <table class="table">
                <thead>
                  <th width="10%">Code</th>
                  <th width="40%">Full Name</th>
                  <th width="15%">Score Total</th>
                </thead>
                <tbody>
                  <?php 
                  $sum = 0;
                  foreach($result_course->result() as $item_course){ 
                    ?>
                  <tr>
                    <td><?php echo $item_course->code_member; ?></td>
                    <td><?php echo $item_course->full_name; ?></td>
                    <td><?php echo $item_course->total_score; ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>