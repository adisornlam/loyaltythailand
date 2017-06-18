<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">ตะกร้าสินค้า</h1>
    </div>
</div>
<div class="row">    
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="stepy-tab">
                    <ul class="stepy-titles clearfix">
                        <li><a href="<?php echo $link_wizad['step1']; ?>"><div>เลือกสินค้า</div><span></span></a>
                        </li> <li class="current-step"><div>ตะกร้าสินค้า</div><span> </span></li>
                        <li><a href="<?php echo $link_wizad['step3']; ?>"><div>ที่อยู่จัดส่งสินค้า</div><span></span></a></li>
                        <li><a href="<?php echo $link_wizad['step4']; ?>"><div>วิธีชำระเงิน</div><span></span></a></li>
                        <li><a href="<?php echo $link_wizad['step5']; ?>"><div>ยืนยันการสั่งซื้อ</div><span> </span></a></li>
                    </ul>
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
                                <th width="40%">ชื่อสินค้า</th>
                                <th width="5%" class="text-center">ราคา</th>
                                <th width="5%" class="text-center">จำนวน</th>                                
                                <th width="8%" class="text-center">ราคารวม(บาท)</th>
                                <th width="2%"></th>
                            </tr>
                        </thead>                        
                        <tbody>
                            <?php
                            foreach ($this->cart->contents() as $items):
                                ?>
                                <tr>
                                    <td><?php echo $items['name']; ?> <a href="javascript:;" rel="products/backend/product/spec/<?php echo $items['id']; ?>" class="link_dialog" title="Product Spec"><i class="fa fa-picture-o"></i></a></td>
                                    <td class="text-right"><?php echo number_format($items['price']); ?></td>
                                    <td class="text-center">                                        
                                        <input type="text" size="5" value="<?php echo $items['qty']; ?>" name="qty" class="qty_cart text-center" id="<?php echo $items['rowid']; ?>" />
                                    </td>
                                    <td class="text-right"><?php echo number_format($items['subtotal']); ?></td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-danger btn-xs delete_cart" value="<?php echo $items['rowid']; ?>"  title="Delete item"><i class="fa fa-trash-o"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>                      
                            <tr>
                                <td colspan="3" class="text-right"><strong>ราคารวมทั้งหมด</strong></td>
                                <td class="text-right"><?php echo number_format($this->cart->total()); ?></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="panel-body">
            <div class="text-center">   
                <a href="<?php echo $link_wizad['step1']; ?>" class="btn btn-success btn-lg" role="button">
                    ย้อนกลับ <i class="fa fa-arrow-circle-left"></i></a>  
                <a href="<?php echo $link_wizad['step3']; ?>" class="btn btn-success btn-lg" role="button">
                    <i class="fa fa-arrow-circle-right"></i> ถัดไป</a>  
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.qty_cart').keypress(function() {
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
                update_cart(obj.attr('id'), obj.val());
            }

        }, 500);

    });
    function update_cart(rowid, qty)
    {
        $.ajax({
            type: "post",
            url: base_url + index_page + 'products/backend/result_cart/update',
            data: {rowid: rowid, qty: qty},
            cache: false,
            success: function(result) {
                try {
                    var obj = $.parseJSON(result);
                    if (obj.status === true) {
                        window.location.href = document.URL;
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
</script>