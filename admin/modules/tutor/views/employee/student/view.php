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
        <div class="row">
          <div class="col-lg-6">
            <h3 class="box-title">Course Information</h3>
          </div>
          <div class="col-lg-6">
            <div class="pull-right">
              <a href="javascript:;" rel="tutor/student/add_course/<?php echo $item->id; ?>" class="btn btn-primary link_dialog" role="button" title="Add Couse"><li class="fa fa-plus"></li> Add Course</a>
            </div>
          </div>
        </div>
      </div>
      <table class="table">
        <thead>
          <th width="10%">Code</th>
          <th width="50%">Title</th>
          <th width="30%">Register</th>
          <th width="10%"></th>
        </thead>
        <tbody>
          <?php foreach($result_course as $item_course){ ?>
          <tr>
            <td><?php echo $item_course->code_no; ?></td>
            <td><?php echo $item_course->title; ?></td>
            <td><?php echo $item_course->register_date; ?></td>
            <td><a href="javascript:;" rel="tutor/student/save/course_delete/<?php echo $item_course->user_course_id; ?>" class="link_dialog delete"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i></a></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>