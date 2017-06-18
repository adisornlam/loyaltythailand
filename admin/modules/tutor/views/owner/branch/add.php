<form class="form-horizontal" role="form" id="form-add" method="post">    
    <div id="showerror"></div>
    <div class="form-group">
        <label for="codes" class="col-sm-3 control-label">Code</label>
        <div class="col-sm-5">
            <?php echo form_input('code_no', NULL, 'class="form-control required" id="code_no"'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="title" class="col-sm-3 control-label">Title</label>
        <div class="col-sm-5">
            <?php echo form_input('title', NULL, 'class="form-control required" id="title"'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="address" class="col-sm-3 control-label">Address</label>
        <div class="col-sm-8">
            <?php echo form_input('address', NULL, 'class="form-control" id="address"'); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <div class="checkbox">
                <label>
                    <?php echo form_checkbox('disabled', 1, TRUE); ?> Enable
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
            url: site_url + 'tutor/branch/save/add',
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