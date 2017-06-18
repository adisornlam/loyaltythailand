<form class="form-horizontal" role="form" id="form-add" method="post">    
    <div id="showerror"></div>
    <div class="form-group">
        <label for="receive_name" class="col-sm-3 control-label">ผู้รับ</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="receive_name" name="receive_name">
        </div>
    </div>
    <div class="form-group">
        <label for="address" class="col-sm-3 control-label">ที่อยู่</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="address" name="address">
        </div>
    </div>
    <div class="form-group">
        <label for="province" class="col-sm-3 control-label">จังหวัด</label>
        <div class="col-sm-5">
            <?php
            echo form_dropdown('province_id', $province, null, 'class="form-control" id="province_id"');
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="amphur" class="col-sm-3 control-label">อำเภอ/เขต</label>
        <div class="col-sm-5">
            <select name="amphur_id" id="sub1" class="form-control">
                <option selected="selected" value=""></option>                            
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="district" class="col-sm-3 control-label">ตำบล</label>
        <div class="col-sm-5">
            <select name="district_id" id="sub2" class="form-control">
                <option selected="selected" value=""></option>                            
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="zipcode" class="col-sm-3 control-label">รหัสไปรษณียร์</label>
        <div class="col-sm-4">
            <select name="zipcode" id="sub3" class="form-control">
                <option selected="selected" value=""></option>                            
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <button type="button" id="btnDialogSave" class="btn btn-primary">Save</button>
        </div>
    </div>
    <input type="hidden" name="redirect" value="products/cart/shipping" />
</form>
<script type="text/javascript">
    $('#btnDialogSave').click(function() {
        $(this).attr('disabled', 'disabled');
        loading_button();
        var data = {
            url: 'users/result_user/add_address',
            v: $('#form-add, select input:not(#btnDialogSave)').serializeArray()
        };
        saveData(data);
    });

    $('#province_id').change(function() {
        $('#sub2').empty();
        $('#sub3').empty();
        $.get(base_url + index_page + 'common/amphur/', {id: $(this).val()},
        function(data) {
            var as = JSON.parse(data);
            if (as) {
                var sub1 = $('#sub1');
                sub1.empty();
                sub1.append("<option value=''>Please select.</option>");
                $.each(as, function(index, element) {
                    sub1.append("<option value='" + index + "'>" + element + "</option>");
                });
            }
        });
    });
    $('#sub1').change(function() {
        $('#sub2').empty();
        $.get(base_url + index_page + 'common/district/', {id: $(this).val()},
        function(data) {
            var as = JSON.parse(data);
            if (as) {
                var sub2 = $('#sub2');
                sub2.empty();
                sub2.append("<option value=''>Please select.</option>");
                $.each(as, function(index, element) {
                    sub2.append("<option value='" + index + "'>" + element + "</option>");
                });
            }
        });
        $.get(base_url + index_page + 'common/zipcode/', {amphur_id: $(this).val()}, function(data) {
            var zp = JSON.parse(data);
            if (zp) {
                var sub3 = $('#sub3');
                sub3.empty();
                $.each(zp, function(index, element) {
                    sub3.append("<option value='" + index + "'>" + element + "</option>");
                });
            }
        });
    });
</script>