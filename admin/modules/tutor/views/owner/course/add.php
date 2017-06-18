<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-body">
        <form class="form-horizontal" role="form" id="form-add" method="post">
          <div class="form-group">
            <label for="code_no" class="col-sm-2 control-label">Code</label>
            <div class="col-sm-2">
              <?php echo form_input('code_no', NULL, 'class="form-control required" id="code_no"'); ?>
            </div>
          </div>
          <div class="form-group">
            <label for="title" class="col-sm-2 control-label">Title</label>
            <div class="col-sm-8">
              <?php echo form_input('title', NULL, 'class="form-control required" id="title"'); ?>
            </div>
          </div>
          <div class="form-group">
            <label for="branch_id" class="col-sm-2 control-label">Branch</label>
            <div class="col-sm-3">
             <?php
             echo form_dropdown('branch_id', $ddl_branch, null, 'class="form-control required" id="branch_id"');
             ?>
           </div>
         </div>
         <div class="form-group">
          <label for="title" class="col-sm-2 control-label">Course Sub</label>
          <div class="col-sm-5">
            <?php foreach ($result_course_sub->result() as $sub_item) { ?>
            <div class="checkbox">
              <label>
                <?php echo form_checkbox('course_sub_id[]', $sub_item->id).' '.$sub_item->title; ?>
              </label>
            </div>
            <?php } ?>
          </div>
        </div>
        <div class="form-group">
          <label for="desc" class="col-sm-2 control-label">Desc</label>
          <div class="col-sm-6">
            <?php echo form_textarea('desc', NULL, 'class="form-control" id="desc" rows="3"'); ?>
          </div>
        </div>
        <div class="form-group">
          <label for="cost" class="col-sm-2 control-label">Cost</label>
          <div class="col-sm-2">
            <?php echo form_input('cost', NULL, 'class="form-control required" id="cost"'); ?>
          </div>
        </div>
        <div class="form-group">
          <label for="qty" class="col-sm-2 control-label">Qty</label>
          <div class="col-sm-2">
            <?php echo form_input('qty', NULL, 'class="form-control" id="qty"'); ?>
          </div>
        </div>
        <div class="form-group">
          <label for="start_datetime" class="col-sm-2 control-label">Start Date</label>
          <div class="col-sm-2">
            <?php echo form_input('start_datetime', NULL, 'class="form-control date required" id="startdate"'); ?>
          </div>
        </div>
        <div class="form-group">
          <label for="end_datetime" class="col-sm-2 control-label">Start End</label>
          <div class="col-sm-2">
            <?php echo form_input('end_datetime', NULL, 'class="form-control date required" id="enddate"'); ?>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
              <label>
                <?php echo form_checkbox('private', 1); ?> Private
              </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
              <label>
                <?php echo form_checkbox('disabled', 1, TRUE); ?> Enable
              </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="button" id="btnSave" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i>
             Save</button>
           </div>
         </div>
       </form>
     </div> 
   </div>
 </div>
</div>
<script type="text/javascript">
  $(function(){
    $('.date').datetimepicker({
      format: 'YYYY-MM-DD HH:mm'
    });
    var options = {
      url: site_url + 'tutor/course/add_save',
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