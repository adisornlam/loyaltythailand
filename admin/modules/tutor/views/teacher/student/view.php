<div class="row">
  <div class="col-md-12 col-xs-12">
    <!-- Horizontal Form -->
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Student Information</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal" name="form-add" id="form-add" method="post">
        <div class="box-body">
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
                <?php echo form_checkbox('stuold', 1, ($item->stuold==1?true:false),'disabled'); ?> นักเรียนเก่า
              </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
            <div class="checkbox">
              <label>
                <?php echo form_checkbox('private', 1, ($item->private==1?true:false),'disabled'); ?> Private
              </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
            <div class="checkbox">
              <label>
                <?php echo form_checkbox('active', 1, ($item->active==1?true:false),'disabled'); ?> Active
              </label>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
  <!-- /.box -->
</div>
</div>
<div class="row">
  <div class="col-md-12 col-xs-12">
    <!-- Horizontal Form -->
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Course Information</h3>
      </div>
      <table class="table">
        <thead>
          <th width="10%">Code</th>
          <th width="60%">Title</th>
          <th width="30%"></th>
        </thead>
        <tbody>
          <?php foreach($result_course as $item_course){ ?>
          <tr>
            <td><?php echo $item_course->code_no; ?></td>
            <td><?php echo $item_course->title; ?> <?php echo ($item_course->private == 1 ? "(Private)":""); ?></td>
            <td>
              <a href="<?php echo site_url(); ?>tutor/student/comment/<?php echo $item_course->user_course_id; ?>" title="View Comment"><i class="fa fa-commenting-o fa-lg" aria-hidden="true"></i></a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>