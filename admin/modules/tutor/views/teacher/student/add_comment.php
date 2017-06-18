<div class="row">
  <div class="col-md-12 col-xs-12">
    <!-- Horizontal Form -->
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Student Comment</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal" name="form-add" id="form-add" method="post">
        <div class="box-body">
          <div class="form-group">
            <label for="private_content" class="col-sm-3 control-label">เนื้อหาที่ได้เรียน</label>
            <div class="col-sm-6">
              <?php echo form_textarea('private_content', NULL, 'class="form-control" id="private_content" rows="3"'); ?>
            </div>
          </div>
          <div class="form-group">
            <label for="private_skill" class="col-sm-3 control-label">ความรู้และทักษะที่ได้</label>
            <div class="col-sm-6">
              <?php echo form_textarea('private_skill', NULL, 'class="form-control" id="private_skill" rows="3"'); ?>
            </div>
          </div>
          <div class="form-group">
            <label for="private_recomment" class="col-sm-3 control-label">เสนอแนะให้นักเรียน</label>
            <div class="col-sm-6">
              <?php echo form_textarea('private_recomment', NULL, 'class="form-control" id="private_recomment" rows="3"'); ?>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
              <button type="button" id="btnSave" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i>
               Save</button>
             </div>
           </div>
         </div>
         <input type="hidden" name="id" value="<?php echo $this->uri->segment(4); ?>" />
       </form>
     </div>
     <!-- /.box -->
   </div>
 </div>
 <script type="text/javascript">
  $(function(){
    var options = {
      url: site_url + 'tutor/student/save/comment_add',
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