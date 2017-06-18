<div class="row">
  <div class="col-md-8 col-xs-12">
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
            <div class="col-sm-3">
              <?php echo form_input('code_member', $item->code_member, 'class="form-control" id="code_member" disabled'); ?>
            </div>
          </div>
          <div class="form-group">
            <label for="first_name" class="col-sm-3 control-label">Fullname</label>
            <div class="col-sm-9">
              <div class="row">
                <div class="col-md-5">
                  <?php echo form_input('first_name', $item->first_name, 'class="form-control required" id="first_name" placeholder="First Name"'); ?>
                </div>
                <div class="col-md-5">
                  <?php echo form_input('last_name', $item->last_name, 'class="form-control required" id="last_name" placeholder="Last Name"'); ?>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="nick_name" class="col-sm-3 control-label">Nickname</label>
            <div class="col-sm-4">
              <?php echo form_input('nick_name', $item->nick_name, 'class="form-control" id="nick_name"'); ?>
            </div>
          </div>
          <div class="form-group">
            <label for="degree_id" class="col-sm-3 control-label">Degree</label>
            <div class="col-sm-4">
             <?php
             echo form_dropdown('degree_id', $ddl_degree, $item->degree_id, 'class="form-control required" id="degree_id"');
             ?>
           </div>
         </div>
         <div class="form-group">
          <label for="school_name" class="col-sm-3 control-label">School Name</label>
          <div class="col-sm-6">
            <?php echo form_input('school_name', $item->school_name, 'class="form-control" id="school_name"'); ?>
          </div>
        </div>
        <div class="form-group">
          <label for="school_province_id" class="col-sm-3 control-label">School Province</label>
          <div class="col-sm-4">
           <?php
           echo form_dropdown('school_province_id', $ddl_province, $item->school_province_id, 'class="form-control required" id="school_province_id"');
           ?>
         </div>
       </div>
       <hr />
       <div class="form-group">
        <label for="parent_first_name" class="col-sm-3 control-label">Parent Name</label>
        <div class="col-sm-9">
          <div class="row">
            <div class="col-md-5">
              <?php echo form_input('parent_first_name', $item->parent_first_name, 'class="form-control required" id="parent_first_name" placeholder="First Name"'); ?>
            </div>
            <div class="col-md-5">
              <?php echo form_input('parent_last_name', $item->parent_last_name, 'class="form-control required" id="parent_last_name" placeholder="Last Name"'); ?>
            </div>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="parent_phone" class="col-sm-3 control-label">Phone</label>
        <div class="col-sm-4">
          <?php echo form_input('parent_phone', $item->parent_phone, 'class="form-control" id="parent_phone"'); ?>
        </div>
      </div>
      <div class="form-group">
        <label for="parent_email" class="col-sm-3 control-label">Email</label>
        <div class="col-sm-5">
          <?php echo form_input('parent_email', $item->parent_email, 'class="form-control" id="parent_email"'); ?>
        </div>
      </div>
      <div class="form-group">
        <label for="parent_address" class="col-sm-3 control-label">Address</label>
        <div class="col-sm-8">
          <?php echo form_input('parent_address', $item->parent_address, 'class="form-control" id="parent_address"'); ?>
        </div>
      </div>
      <hr />
      <div class="form-group">
        <label for="branch_id" class="col-sm-3 control-label">Branch</label>
        <div class="col-sm-6">
         <?php
         echo form_dropdown('branch_id', $ddl_branch, $item->branch_id, 'class="form-control required" id="branch_id"');
         ?>
       </div>
     </div>
     <div class="form-group">
       <label for="course_id" class="col-sm-3 control-label">Course</label>
       <div class="col-sm-9">
        <table class="table table-bordered">
          <tbody>
            <?php foreach($result_course as $item_course){ ?>
            <tr>
              <td><?php echo $item_course->code_no; ?></td>
              <td><?php echo $item_course->title; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-3 col-sm-9">
        <div class="checkbox">
          <label>
            <?php echo form_checkbox('stuold', 1, ($item->stuold==1?true:false)); ?> นักเรียนเก่า
          </label>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-3 col-sm-9">
        <div class="checkbox">
          <label>
            <?php echo form_checkbox('active', 1, ($item->active==1?true:false)); ?> Active
          </label>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-3 col-sm-9">
        <div class="checkbox">
          <label>
            <?php echo form_checkbox('private', 1, ($item->private==1?true:false)); ?> Private
          </label>
        </div>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    <div class="col-sm-offset-3 col-sm-9">
      <button type="button" class="btn btn-info pull-left" id="btnSave"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>&nbsp;<a href="<?php echo base_url().index_page(); ?>tutor/student/view/<?php echo $item->id; ?>" class="btn btn-success" role="button"><i class="fa fa-file-text-o" aria-hidden="true"></i> View</a>
    </div>
  </div>
  <!-- /.box-footer -->
  <input type="hidden" name="id" value="<?php echo $item->id; ?>">
</form>
</div>
<!-- /.box -->
</div>
</div>
<script type="text/javascript">
  $(function(){
    var options = {
      url: site_url + 'tutor/student/save/edit',
      success: showResponse
    };
    $('#btnSave').click(function () {
      if ($("#form-add").valid()) {
        $(this).addClass('disabled');
        $('#form-add').ajaxSubmit(options);
        return false;
      }
    });
  });

  function showResponse(response, statusText, xhr, $form) {
    var as = JSON.parse(response);
    if (as.error.status === false) {
      $('#btnSave').removeClass('disabled');
    }else{
      window.location.href = site_url+as.error.redirect;
    }
  }
</script>