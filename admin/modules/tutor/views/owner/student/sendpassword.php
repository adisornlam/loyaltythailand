<form class="form-horizontal" role="form" id="form-add" method="post">    
    <div id="showerror"></div>
    <div class="form-group">
        <label for="code_member" class="col-sm-3 control-label">Code Member</label>
        <div class="col-sm-3">
            <?php echo form_input('code_member', $item->code_member, 'class="form-control required" id="code_member"'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="email" class="col-sm-3 control-label">Email</label>
        <div class="col-sm-5">
            <?php echo form_input('email', $item->email, 'class="form-control required" id="email"'); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <button type="button" id="btnDialogSave" class="btn btn-primary">Send Password</button>
        </div>
    </div>
</form>
<script type="text/javascript">
    $(function(){
        var options = {
            url: site_url + 'tutor/student/save/sendpassword',
            success: showResponse
        };
        $('#btnDialogSave').click(function () {
            $(this).addClass('disabled');
            $('#form-add').ajaxSubmit(options);
            return false;
        });
    });

    function showResponse(response, statusText, xhr, $form) {
      var as = JSON.parse(response);
      if (as.error.status === false) {
        $('#btnDialogSave').removeClass('disabled');
    }else{
        $('#myModal').modal('hide');
    }
}
</script>