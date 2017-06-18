<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">รายการสินค้า</h1>
    </div>
</div>
<div class="row">    
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="stepy-tab">
                    <ul class="stepy-titles clearfix">
                        <li class="current-step"><div>เลือกสินค้า</div><span> </span></li>
                        <li><a href="<?php echo $link_wizad['step2']; ?>"><div>ตะกร้าสินค้า</div><span> </span></a></li>
                        <li><a href="<?php echo $link_wizad['step3']; ?>"><div>ที่อยู่จัดส่งสินค้า</div><span> </span></a></li>
                        <li><a href="<?php echo $link_wizad['step4']; ?>"><div>วิธีชำระเงิน</div><span> </span></a></li>
                        <li><a href="<?php echo $link_wizad['step5']; ?>"><div>ยืนยันการสั่งซื้อ</div><span> </span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default borderless">
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="txtSearch" name="txtSearch" placeholder="ค้นหา Produce Code/Product Name/Category">
                    </div>
                    <div class="col-sm-3">
                        <select name="myCat" id="myCat" class="form-control">
                            <option value="">Please select category.</option>
                            <?php foreach ($search_category as $key => $val) { ?>
                                <optgroup label="<?php echo $val ?>">
                                    <?php foreach ($this->Category_model->get_stk_category($key) as $key2 => $val2) { ?>
                                        <option value="<?php echo $key2; ?>"><?php echo $val2; ?></option>
                                    <?php } ?>
                                </optgroup>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                            <tr>
                                <th width="12%">รหัส</th>
                                <th width="40%">ชื่อสินค้า</th>
                                <th width="15%">หมวดหมู่</th>
                                <th width="7%">ประกัน</th>
                                <?php echo ($this->Ion_auth_model->check_dealer($this->ion_auth->get_user_id()) ? '<th width="10%">ราคาส่ง</th>' : '<th width="10%">ราคาปลีก</th>'); ?>                                
                                <th width="8%">จำนวน</th>
                            </tr>
                        </thead>                        
                        <tbody>

                        </tbody>                        
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="panel-body">
            <div class="text-center">                   
                <a href="<?php echo $link_wizad['step2']; ?>" class="btn btn-success btn-lg" role="button">
                    <i class="fa fa-arrow-circle-right"></i> ถัดไป</a>  
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        var oTable = $('#sample_1').dataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
            "ajax": {
                "url": base_url + index_page + "products/backend/result_product/listall",
                "type": "POST"
            },
            "aoColumns": [
                {"mData": "product_code"},
                {"mData": "cnt_title"},
                {"mData": "cat_name"},
                {"mData": "warranty", "sClass": "text-center"},
                {"mData": "price", "sClass": "text-right"},
                {"mData": "product_id", "sClass": "text-center"}
            ],
            "aoColumnDefs": [
                {'bSortable': false, 'aTargets': [0, 1, 2, 3, 5]}
            ],
            "sDom": 'ltipr'
        });
        $('#txtSearch').keyup(function() {
            oTable.fnFilter($(this).val());
        });

        $('#myCat').on('change', function() {
            var selectedValue = $(this).val();
            oTable.fnFilter(selectedValue, 3); //Exact value, column, reg
        });
    });

    $('body').on('keypress', '.add_cart', function() {
        var obj = $(this);
        delay(function() {
            if (obj.val() > 10) {
                var data = {
                    title: 'แจ้งเตือน',
                    text: 'ลูกค้าซื้อสินค้ามีจำนวนมากกว่า 10 ชิ้นขึ้นไป กรุณาติดต่อพนักงานขาย',
                    type: 'alert'
                };
                genModal(data);
            } else if (obj.val() <= 0) {
                var data = {
                    title: 'แจ้งเตือน',
                    text: 'กรุณาระบุจำนวนสินค้าให้ถูกต้อง',
                    type: 'alert'
                };
                genModal(data);
            } else if (obj.val() === '') {
                var data = {
                    title: 'แจ้งเตือน',
                    text: 'กรุณาระบุจำนวนสินค้าให้ถูกต้อง',
                    type: 'alert'
                };
                genModal(data);
            } else {
                $.ajax({
                    type: "post",
                    url: base_url + index_page + 'products/backend/result_cart/add',
                    data: {product_id: obj.attr('id'), qty: obj.val()},
                    cache: false,
                    success: function(result) {
                        try {
                            var obj = $.parseJSON(result);
                            if (obj.status === true) {
                                $('#cart_msg_popup').tooltip('show');
                                setTimeout(function() {
                                    $('#cart_msg_popup').tooltip('hide');
                                    window.location.href = document.URL;
                                }, 1000);
                            } else {
                                alert('Add cart false. !!!');
                            }
                        } catch (e) {
                            alert('Exception while request..');
                        }
                    },
                    error: function(e) {
                        console.log(e);
                        alert('Error while request..');
                    }
                });
            }
        }, 500);
    });
</script>