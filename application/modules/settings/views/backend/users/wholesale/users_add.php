<form class="form-horizontal" role="form" id="form-add" method="post">    
    <div id="showerror"></div>
    <div class="form-group">
        <label for="first_name" class="col-sm-3 control-label">ชื่อ</label>
        <div class="col-sm-7">
            <input type="text" class="form-control" id="first_name" name="first_name">
        </div>
    </div>
    <div class="form-group">
        <label for="last_name" class="col-sm-3 control-label">นามสกุล</label>
        <div class="col-sm-7">
            <input type="text" class="form-control" id="last_name" name="last_name">
        </div>
    </div>
    <div class="form-group">
        <label for="nick_name" class="col-sm-3 control-label">ชื่อเล่น</label>
        <div class="col-sm-7">
            <input type="text" class="form-control" id="nick_name" name="nick_name">
        </div>
    </div>    
    <div class="form-group">
        <label for="email" class="col-sm-3 control-label">อีเมล์</label>
        <div class="col-sm-7">
            <input type="email" class="form-control" id="email" name="email">
        </div>
    </div>
    <div class="form-group">
        <label for="password" class="col-sm-3 control-label">รหัสผ่าน</label>
        <div class="col-sm-5">
            <input type="password" class="form-control" id="password" name="password">
        </div>
    </div>
    <div class="form-group">
        <label for="cat_code" class="col-sm-3 control-label">กลุ่ม</label>
        <div class="col-sm-5">
            <?php
            echo form_dropdown('group_id', $group, null, 'class="form-control"');
            ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="active" value="active"> เปิดใช้งาน
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <button type="button" id="btnDialogSave" class="btn btn-primary">บันทึก</button>
        </div>
    </div>
</form>
<script type="text/javascript">
    $('#btnDialogSave').click(function() {
        $(this).attr('disabled', 'disabled');
        loading_button();
        var data = {
            url: 'settings/backend/result_users_wholesale/add',
            v: $('#form-add, select input:not(#btnDialogSave)').serializeArray()
        };
        saveData(data);
    });
</script>