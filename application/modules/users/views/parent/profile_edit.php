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
                  <label for="nick_name" class="col-sm-3 control-label">NickName</label>
                  <div class="col-sm-3">
                    <?php echo form_input('nick_name', $item->nick_name, 'class="form-control required" id="nick_name"'); ?>
                  </div>
                </div>
                <div class="form-group">
                  <label for="first_name" class="col-sm-3 control-label">First Name</label>
                  <div class="col-sm-4">
                    <?php echo form_input('first_name', $item->first_name, 'class="form-control required" id="first_name"'); ?>
                  </div>
                </div>
                <div class="form-group">
                  <label for="last_name" class="col-sm-3 control-label">Last Name</label>
                  <div class="col-sm-4">
                    <?php echo form_input('last_name', $item->last_name, 'class="form-control required" id="last_name"'); ?>
                  </div>
                </div>
                <div class="form-group">
                  <label for="degree_id" class="col-sm-3 control-label">Degree</label>
                  <div class="col-sm-3">
                    <?php
                    echo form_dropdown('degree_id', $ddl_degree, $item->degree_id, 'class="form-control required" id="degree_id" style="height:50px;"');
                    ?>
                  </div>
                </div>
                <hr />
                <div class="form-group">
                  <label for="parent_first_name" class="col-sm-3 control-label">Parent First Name</label>
                  <div class="col-sm-4">
                    <?php echo form_input('parent_first_name', $item->parent_first_name, 'class="form-control required" id="parent_first_name"'); ?>
                  </div>
                </div>
                <div class="form-group">
                  <label for="parent_last_name" class="col-sm-3 control-label">Parent Last Name</label>
                  <div class="col-sm-4">
                    <?php echo form_input('parent_last_name', $item->parent_last_name, 'class="form-control required" id="parent_last_name"'); ?>
                  </div>
                </div>
                <div class="form-group">
                  <label for="parent_phone" class="col-sm-3 control-label">Phone</label>
                  <div class="col-sm-3">
                    <?php echo form_input('parent_phone', $item->parent_phone, 'class="form-control required" id="parent_phone"'); ?>
                  </div>
                </div>
                <div class="form-group">
                  <label for="parent_address" class="col-sm-3 control-label">Address</label>
                  <div class="col-sm-8">
                   <?php echo form_input('parent_address', $item->parent_address, 'class="form-control required" id="parent_address"'); ?>
                 </div>
               </div>
               <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                  <div class="checkbox">
                    <label>
                    <?php echo form_checkbox('chkpass', 1); ?> เปลี่ยนรหัสผ่าน
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="new_password" class="col-sm-3 control-label">รหัสผ่านใหม่</label>
                <div class="col-sm-3">
                  <?php echo form_input('new_password', null, 'class="form-control" id="new_password"'); ?>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                  <button type="button" name="btnSave" id="btnSave" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                </div>
              </div>
              <input type="hidden" name="id" value="<?php echo $item->id; ?>" />
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    $(function(){
     var options = {
      url: site_url + 'users/profile/edit_save',
      success: showResponse
    };
    $('#btnSave').click(function () {
      if ($("#form-add").valid()) {
       $(this).addClass('disabled', 'disabled');
       $(this).after('&nbsp;<span id="spinner_loading"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Loading...</span>');
       $('#form-add').ajaxSubmit(options);
       return false;
     }
   });
  });


    function showResponse(response, statusText, xhr, $form) {
     var as = JSON.parse(response);
     if (as.error.status === false) {
      var data = {
       title: 'Message',
       type: 'info1',
       text: as.error.message_info
     };
     genModal(data);
     $('#btnSave').removeClass('disabled');
   } else {
    $("#spinner_loading").remove();
    var data = {
     title: 'Message',
     type: 'info1',
     text: as.error.message_info
   };
   genModal(data);
   $('#myModal').on('hidden.bs.modal', function () {
     location.href = site_url+"users/profile";
   });
 }
}
</script>