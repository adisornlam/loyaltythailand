<form class="form-horizontal" role="form" id="form-add" method="post">    
    <div id="showerror"></div>
    <div class="form-group">
        <label for="first_name" class="col-sm-3 control-label">ชื่อ</label>
        <div class="col-sm-7">
            <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $item->first_name; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="last_name" class="col-sm-3 control-label">นามสกุล</label>
        <div class="col-sm-7">
            <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $item->last_name; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="nick_name" class="col-sm-3 control-label">ชื่อเล่น</label>
        <div class="col-sm-7">
            <input type="text" class="form-control" id="nick_name" name="nick_name" value="<?php echo $item->nick_name; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="email" class="col-sm-3 control-label">อีเมล์</label>
        <div class="col-sm-7">
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $item->email; ?>" disabled="disabled">
        </div>
    </div>
    <div class="form-group">
        <label for="cat_code" class="col-sm-3 control-label">กลุ่ม</label>
        <div class="col-sm-5">
            <?php
            echo form_dropdown('group_id', $group, $item->group_id, 'class="form-control"');
            ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <div class="checkbox">
                <label>
                    <?php echo form_checkbox('active', 'active', ($item->active == 1 ? true : false)); ?> Active
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <button type="button" id="btnDialogSave" class="btn btn-primary">บันทึก</button>
        </div>
    </div>
    <input type="hidden" name="user_id" value="<?php echo $item->id; ?>" />
</form>
<script type="text/javascript">
    $('#btnDialogSave').click(function() {
        $(this).attr('disabled', 'disabled');
        loading_button();
        var data = {
            url: 'settings/backend/result_users_wholesale/edit',
            v: $('#form-add, select input:not(#btnDialogSave)').serializeArray()
        };
        saveData(data);
    });
</script>