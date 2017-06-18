<form class="form-horizontal" name="form-course-add" id="form-course-add" method="post">
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
     <select name="course_id" id="course_id" class="form-control required">
      <option selected="selected" value=""></option>                
    </select>
  </div>
</div>
<div class="form-group">
  <label for="register_date" class="col-sm-3 control-label">Register Date</label>
  <div class="col-sm-3">
    <?php echo form_input('register_date', NULL, 'class="form-control date" id="register_date"'); ?>
  </div>
</div>
<div class="form-group">
  <div class="col-sm-offset-3 col-sm-9">
    <button type="button" id="btnDialogSave" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
  </div>
</div>
<input type="hidden" name="user_id" value="<?php echo $this->uri->segment(4); ?>" />
</form>

<script type="text/javascript">
  $(function(){
    $('.date').datetimepicker({
      format: 'YYYY-MM-DD'
    });
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
      url: site_url + 'tutor/student/save/course_add',
      success: showResponse
    };
    $('#btnDialogSave').click(function () {
      if ($("#form-course-add").valid()) {
        $(this).addClass('disabled');
        $('#form-course-add').ajaxSubmit(options);
        return false;
      }
    });
  });

  function showResponse(response, statusText, xhr, $form) {
    var as = JSON.parse(response);
    if (as.error.status === false) {
      $('#btnDialogSave').removeClass('disabled');
    }else{
      window.location.href = site_url+as.error.redirect;
    }
  }
</script>