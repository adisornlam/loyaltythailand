<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <form class="form-horizontal" role="form" id="form-add" method="post">
                    <h3>ตั้งค่าเว็บไซต์</h3>
                    <div class="form-group">
                        <?php echo form_label('Store Name', 'storename', array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-4">
                            <?php echo form_input('storename', $item->storename, 'class="form-control"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Logo Name', 'logo_text', array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-4">
                            <?php echo form_input('logo_text', $item->logo_text, 'class="form-control"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Title Web site', 'site_name', array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-6">
                            <?php echo form_input('site_name', $item->site_name, 'class="form-control"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Keywords', 'keywords', array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-7">
                            <?php echo form_input('keywords', $item->keywords, 'class="form-control"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Description', 'description', array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-7">
                            <?php echo form_input('description', $item->description, 'class="form-control"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="btnSave" class="btn btn-primary">บันทึกการเปลี่ยนแปลง</button>
                        </div>
                    </div>
                    <input type="hidden" name="user_id" value="<?php echo $item->user_id; ?>" />
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        var options = {
            url: site_url + 'settings/save/edit',
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
            alert(as.error.message_info);
            $('#btnSave').removeClass('disabled');
        } else {
            window.location.href = site_url + as.error.redirect;
        }
    }
</script>