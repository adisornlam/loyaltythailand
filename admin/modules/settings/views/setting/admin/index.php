<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">ตั้งค่าทั่วไป</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <form class="form-horizontal" role="form" id="form-add" method="post">
                    <h3>ตั้งค่าเว็บไซต์</h3>
                    <div class="form-group">
                        <?php echo form_label('Title', 'site_name', array('class' => 'col-sm-2 control-label')); ?>
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
                    <h3>ตั้งค่าอีเมล์</h3>
                    <div class="form-group">
                        <?php echo form_label('User Agent', 'useragent', array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-4">
                            <?php echo form_input('useragent', $item->useragent, 'class="form-control"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Host', 'host', array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-4">
                            <?php echo form_input('host', $item->host, 'class="form-control"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Port', 'port', array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-4">
                            <?php echo form_input('port', $item->port, 'class="form-control"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('From email', 'from_email', array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-4">
                            <?php echo form_input('from_email', $item->from_email, 'class="form-control"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Receive email', 'receive_email', array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-4">
                            <?php echo form_input('receive_email', $item->receive_email, 'class="form-control"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Username', 'username', array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-4">
                            <?php echo form_input('username', $item->username, 'class="form-control"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Password', 'password', array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-4">
                            <?php echo form_password('password', $item->password, 'class="form-control"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="btnSave" class="btn btn-primary">บันทึกการเปลี่ยนแปลง</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#btnSave').click(function () {
        $(this).attr('disabled', 'disabled');
        var data = {
            url: 'settings/backend/result_setting/edit',
            v: $('#form-add input:not(#btnSave)').serializeArray()
        };
        saveData(data);
    });
</script>