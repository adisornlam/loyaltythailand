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
                    </li> <li class="current-step"><div>ตะกร้าสินค้า</div><span> </span></li>
                <?php if ($this->ion_auth->logged_in()) { ?>
                    <li><a href="javascript:;" rel="<?php echo $link_wizad['step3']; ?>" class="ajax_page"><div>ที่อยู่จัดส่งสินค้า</div><span></span></a></li>
                <?php } else { ?>
                    <li><a href="javascript:;" rel="<?php echo base_url() . index_page(); ?>authentication/auth/login" class="ajax_page"><div>ที่อยู่จัดส่งสินค้า</div><span></span></a></li>
                <?php } ?>
                <li><a href="javascript:;" rel="<?php echo $link_wizad['step4']; ?>" class="ajax_page"><div>วิธีชำระเงิน</div><span></span></a></li>
                <li><a href="javascript:;" rel="<?php echo $link_wizad['step5']; ?>" class="ajax_page"><div>ยืนยันการสั่งซื้อ</div><span> </span></a></li>
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
                    <form name="form-cart" role="form" method="post" id="form-cart">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                                <tr>
                                    <th width="8%" class="text-center">รูปสินค้า</th>
                                    <th width="5%" class="text-center">รหัสสินค้า</th>
                                    <th width="45%" class="text-center">รายการสินค้า</th>
                                    <th width="8%" class="text-center">ราคา</th>
                                    <th width="10%" class="text-center">จำนวน</th>                                
                                    <th width="8%" class="text-center">ราคา</th>
                                    <th width="2%"></th>
                                </tr>
                            </thead>                        
                            <tbody>
                                <?php
                                foreach ($this->cart->contents() as $items):
                                    ?>
                                    <tr>
                                        <td class="vert-align">
                                            <a href="<?php echo base_url() . index_page(); ?>products/<?php echo $items['id']; ?>/<?php echo $items['name']; ?>" target="_blank" title="ดูรายละเอียดสินค้า"><img src="<?php echo get_thumbs($items['id']); ?>" width="100" class="img-thumbnail" /></a>
                                        </td>
                                        <td class="vert-align"><?php echo $items['options']['code']; ?></td>
                                        <td class="vert-align">                                        
                                            <?php echo $items['name']; ?>
                                        </td>
                                        <td class="text-right vert-align"><?php echo number_format($items['price']); ?></td>
                                        <td class="text-center vert-align">  
                                            <input type="text" size="5" value="<?php echo $items['qty']; ?>" name="qty[]" class="qty_cart text-center" />
                                            <input type="hidden" name="prod[]" value="<?php echo $items['rowid']; ?>" />
                                        </td>
                                        <td class="text-right vert-align"><?php echo number_format($items['subtotal']); ?></td>
                                        <td class="text-center vert-align">
                                            <button type="button" class="btn btn-danger btn-xs btnDeleteCart" value="<?php echo $items['rowid']; ?>"><i class="fa fa-trash-o"></i></button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>                      
                                <tr>
                                    <td colspan="5" class="text-right"><strong>ราคารวมทั้งหมด</strong></td>
                                    <td class="text-right"><?php echo number_format($this->cart->total()); ?></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                    <button type="button" class="btn btn-warning pull-right" id="btnUpdateCart"><i class="fa fa-refresh"></i> Update Cart</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="panel-body">
            <div class="text-center">    
                <?php if ($this->ion_auth->logged_in()) { ?>
                    <a href="javascript:;" rel="<?php echo $link_wizad['step3']; ?>" class="btn btn-success btn-lg ajax_page" role="button">
                        <i class="fa fa-arrow-circle-right"></i> ถัดไป</a>  
                <?php } else { ?>
                    <a href="javascript:;" rel="<?php echo base_url() . index_page(); ?>authentication/auth/login" class="btn btn-success btn-lg ajax_page" role="button">
                        <i class="fa fa-arrow-circle-right"></i> ถัดไป</a>
                    <?php } ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.btnDeleteCart').click(function () {
        $.ajax({
            type: "post",
            url: base_url + index_page + 'products/result_cart/delete',
            data: {rowid: $(this).val()},
            cache: false,
            success: function () {
                $.gritter.add({
                    title: 'แจ้งเดือน',
                    text: 'อัพเดตรายการสินค้าในตะกร้าแล้ว',
                    sticky: false,
                    time: '2000'
                });
                delay(function () {
                    ajax_page(window.location.href);
                }, 1000);
            },
            error: function (e) {
                alert('Error while request..');
            }
        });
    });
    $('#btnUpdateCart').click(function () {
        $.ajax({
            type: "post",
            url: base_url + index_page + 'products/result_cart/update',
            data: $('#form-cart').serializeArray(),
            cache: false,
            success: function () {
                $.gritter.add({
                    title: 'แจ้งเดือน',
                    text: 'อัพเดตรายการสินค้าในตะกร้าแล้ว',
                    sticky: false,
                    time: '2000'
                });
                delay(function () {
                    ajax_page(window.location.href);
                }, 1000);
            },
            error: function (e) {
                alert('Error while request..');
            }
        });
    });
    $('.qty_cart').keypress(function () {
        var obj = $(this);
        delay(function () {
            if (obj.val() > 10) {
                alert('ลูกค้าซื้อสินค้ามีจำนวนมากกว่า 10 ชิ้นขึ้นไป กรุณาติดต่อพนักงานขาย');
                ajax_page(window.location.href);
            } else if (obj.val() <= 0) {
                alert('กรุณาระบุจำนวนสินค้าให้ถูกต้อง');
                ajax_page(window.location.href);
            } else if (obj.val() === '') {
                alert('กรุณาระบุจำนวนสินค้าให้ถูกต้อง');
                ajax_page(window.location.href);
            }
        }, 500);

    });
</script>