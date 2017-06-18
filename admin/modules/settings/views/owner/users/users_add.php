<form class="form-horizontal" role="form" id="form-add" method="post">    
    <div id="showerror"></div>
    <div class="form-group">
        <label for="first_name" class="col-sm-3 control-label">First Name</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="first_name" name="first_name">
        </div>
    </div>
    <div class="form-group">
        <label for="last_name" class="col-sm-3 control-label">Last Name</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="last_name" name="last_name">
        </div>
    </div>
    <div class="form-group">
        <label for="email" class="col-sm-3 control-label">Email</label>
        <div class="col-sm-5">
            <input type="email" class="form-control" id="email" name="email">
        </div>
    </div>
    <div class="form-group">
        <label for="password" class="col-sm-3 control-label">Password</label>
        <div class="col-sm-4">
            <input type="password" class="form-control" id="password" name="password">
        </div>
    </div>
    <div class="form-group">
        <label for="group_id" class="col-sm-3 control-label">Group</label>
        <div class="col-sm-4">
            <?php
            echo form_dropdown('group_id', $ddl_group, null, 'class="form-control"');
            ?>
        </div>
    </div>
    <div class="form-group">
    <label for="branch_id" class="col-sm-3 control-label">Branch</label>
        <div class="col-sm-5">
            <?php
            echo form_dropdown('branch_id', $ddl_branch, null, 'class="form-control"');
            ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="active" value="active"> Active
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <button type="button" id="btnDialogSave" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
        </div>
    </div>
</form>
<script type="text/javascript">
    $(function(){
        var options = {
            url: site_url + 'settings/users/users_add_save',
            success: showResponse
        };
        $('#btnDialogSave').click(function () {
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
        $('#btnDialogSave').removeClass('disabled');
    }else{
        window.location.href = site_url+as.error.redirect;
    }
}
</script>