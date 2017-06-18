<div class="row">
  <div class="col-md-9 col-xs-12">
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
            <label for="first_name" class="col-sm-3 control-label">Fullname</label>
            <div class="col-sm-9">
              <div class="row">
                <div class="col-md-5">
                  <?php echo form_input('first_name', NULL, 'class="form-control required" id="first_name" placeholder="First Name"'); ?>
                </div>
                <div class="col-md-5">
                  <?php echo form_input('last_name', NULL, 'class="form-control required" id="last_name" placeholder="Last Name"'); ?>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="nick_name" class="col-sm-3 control-label">Nickname</label>
            <div class="col-sm-4">
              <?php echo form_input('nick_name', NULL, 'class="form-control" id="nick_name"'); ?>
            </div>
          </div>
          <div class="form-group">
            <label for="degree_id" class="col-sm-3 control-label">Degree</label>
            <div class="col-sm-4">
             <?php
             echo form_dropdown('degree_id', $ddl_degree, null, 'class="form-control required" id="degree_id"');
             ?>
           </div>
         </div>
         <div class="form-group">
          <label for="school_name" class="col-sm-3 control-label">School Name</label>
          <div class="col-sm-6">
            <?php echo form_input('school_name', NULL, 'class="form-control" id="school_name"'); ?>
          </div>
        </div>
        <div class="form-group">
          <label for="school_province_id" class="col-sm-3 control-label">School Province</label>
          <div class="col-sm-4">
           <?php
           echo form_dropdown('school_province_id', $ddl_province, null, 'class="form-control required" id="school_province_id"');
           ?>
         </div>
       </div>
       <hr />
       <div class="form-group">
        <label for="parent_first_name" class="col-sm-3 control-label">Parent Name</label>
        <div class="col-sm-9">
          <div class="row">
            <div class="col-md-5">
              <?php echo form_input('parent_first_name', NULL, 'class="form-control required" id="parent_first_name" placeholder="First Name"'); ?>
            </div>
            <div class="col-md-5">
              <?php echo form_input('parent_last_name', NULL, 'class="form-control required" id="parent_last_name" placeholder="Last Name"'); ?>
            </div>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="parent_phone" class="col-sm-3 control-label">Phone</label>
        <div class="col-sm-4">
          <?php echo form_input('parent_phone', NULL, 'class="form-control" id="parent_phone"'); ?>
        </div>
      </div>
      <div class="form-group">
        <label for="parent_email" class="col-sm-3 control-label">Email</label>
        <div class="col-sm-5">
          <?php echo form_input('parent_email', NULL, 'class="form-control" id="parent_email"'); ?>
        </div>
      </div>
      <div class="form-group">
        <label for="parent_address" class="col-sm-3 control-label">Address</label>
        <div class="col-sm-8">
          <?php echo form_input('parent_address', NULL, 'class="form-control" id="parent_address"'); ?>
        </div>
      </div>
      <hr />
      <div class="form-group">
        <label for="branch_id" class="col-sm-3 control-label">Branch</label>
        <div class="col-sm-6">
         <?php
         echo form_dropdown('branch_id', $ddl_branch, null, 'class="form-control required" id="branch_id"');
         ?>
       </div>
     </div>
     <div class="form-group">
       <label for="course_id" class="col-sm-3 control-label">Course</label>
       <div class="col-sm-8">
         <select name="course_id[]" id="course_id" class="form-control required" multiple="multiple">
          <option selected="selected" value=""></option>                
        </select>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-3 col-sm-9">
        <div class="checkbox">
          <label>
            <?php echo form_checkbox('stuold', 1); ?> นักเรียนเก่า
          </label>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-3 col-sm-9">
        <div class="checkbox">
          <label>
          <?php echo form_checkbox('private', 1); ?> Private
          </label>
        </div>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    <div class="col-sm-offset-3 col-sm-9">
      <button type="button" class="btn btn-info pull-left" id="btnSave"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
    </div>
  </div>
  <!-- /.box-footer -->
</form>
</div>
<!-- /.box -->
</div>
</div>
<script type="text/javascript">
  $(function(){
    $('#branch_id').change(function () {
      var course_id = $('#course_id');
      course_id.empty();
      $.get(site_url + 'common/get_course_ddl/', {branch_id: $('#branch_id').val()},
        function (data) {
          var as = JSON.parse(data);
          if (as) {
            $.each(as, function (index, element) {
              course_id.append("<option value='" + index + "'>" + element + "</option>");
            });
          }
        });
    });
    var options = {
      url: site_url + 'tutor/student/save/add',
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