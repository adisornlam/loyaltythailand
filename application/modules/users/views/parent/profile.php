    <div class="inner-bg">
    	<div class="container">
    		<div class="row">
    			<div class="col-md-12 form-box">
    				<div class="form-top">
    					<div class="form-top-left">
    						<h3>ข้อมูลนักเรียน</h3>
    					</div>
    					<div class="form-top-right">
    						<i class="fa fa-user" aria-hidden="true"></i>
    					</div>
              <form class="form-horizontal" name="form-add" id="form-add" method="post">
                <div class="form-group">
                  <label for="code_member" class="col-sm-3 control-label">Code</label>
                  <div class="col-sm-3"><p class="form-control-static"><?php echo $item->code_member; ?></p>
                  </div>
                </div>
                <div class="form-group">
                  <label for="first_name" class="col-sm-3 control-label">Fullname</label>
                  <div class="col-sm-9">
                    <p class="form-control-static"><?php echo $item->first_name.' '.$item->last_name; ?> <?php echo ($item->nick_name!=''? '('.$item->nick_name.')':''); ?></p>
                  </div>
                </div>
                <div class="form-group">
                  <label for="degree_id" class="col-sm-3 control-label">Degree</label>
                  <div class="col-sm-9">
                    <p class="form-control-static">
                      <?php echo (isset($item->degree_title)? $item->degree_title:' '); ?>
                      <?php echo ($item->school_name!=''? ''.$item->school_name.' ':''); ?>  
                      <?php echo (isset($item->school_provine_title)? 'จังหวัด'.$item->school_provine_title:''); ?>  
                    </p>
                  </div>
                </div>
                <hr />
                <div class="form-group">
                  <label for="parent_first_name" class="col-sm-3 control-label">Parent Name</label>
                  <div class="col-sm-9">
                    <p class="form-control-static"><?php echo $item->parent_first_name.' '.$item->parent_last_name; ?></p>
                  </div>
                </div>
                <div class="form-group">
                  <label for="parent_phone" class="col-sm-3 control-label">Phone</label>
                  <div class="col-sm-9">
                    <p class="form-control-static">
                      <?php echo $item->parent_phone; ?>              
                      <strong>Email :</strong> <?php echo $item->parent_email; ?>
                    </p>
                  </div>
                </div>
                <div class="form-group">
                  <label for="parent_address" class="col-sm-3 control-label">Address</label>
                  <div class="col-sm-8">
                    <p class="form-control-static"><?php echo $item->parent_address; ?></p>
                  </div>
                </div>
                <hr />
                <div class="form-group">
                  <label for="branch_id" class="col-sm-3 control-label">Branch</label>
                  <div class="col-sm-6">
                   <p class="form-control-static"><?php echo $item->branch_title; ?></p>
                 </div>
               </div>
               <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                  <div class="checkbox">
                    <label>
                      <?php echo form_checkbox('stuold', 1, ($item->stuold==1?true:false),'disabled="disabled" '); ?> นักเรียนเก่า
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                  <div class="checkbox">
                    <label>
                      <?php echo form_checkbox('active', 1, ($item->active==1?true:false),'disabled="disabled" '); ?> Active
                    </label>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>