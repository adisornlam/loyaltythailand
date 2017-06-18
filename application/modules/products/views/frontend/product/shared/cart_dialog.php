<div class="table-responsive">
    <p>ท่านมีสินค้า <?php echo count($this->cart->contents()); ?> ชิ้นในตะกร้า</p>
    <form name="form-cart" role="form" method="post" id="form-cart">
        <table class="table borderless" id="sample_1">
            <thead>
                <tr>
                    <th width="8%" class="text-center"></th>
                    <th width="45%" class="text-center"></th>
                    <th width="8%" class="text-center">ราคา</th>
                    <th width="10%" class="text-center">จำนวน</th>                                
                    <th width="8%" class="text-center">รวม</th>
                    <th width="2%"></th>
                </tr>
            </thead>                        
            <tbody>
                <?php
                foreach ($this->cart->contents() as $items):
                    ?>
                    <tr>
                        <td class="vert-align">
                            <a href="<?php echo base_url() . index_page(); ?>products/<?php echo $items['id']; ?>/<?php echo clear_url($items['name']); ?>" target="_blank" title="ดูรายละเอียดสินค้า"><img src="<?php echo get_thumbs($items['id']); ?>" width="100" class="img-thumbnail" /></a>
                        </td>
                        <td class="vert-align">                                        
                            <?php echo $items['name']; ?>
                        </td>
                        <td class="text-right vert-align"><?php echo number_format($items['price']); ?></td>
                        <td class="text-center vert-align">  
                            <?php echo form_dropdown_count($items['rowid'], $items['options']['stock'], $items['qty']); ?>
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
    <a href="<?php echo base_url() . index_page(); ?>products/cart/shipping" class="btn btn-warning btn-lg pull-right" role="button">ดำเนินการต่อ <i class="fa fa-chevron-right"></i>
    </a>
</div>
<script type="text/javascript">
    $('.btnDeleteCart').click(function () {
        $.ajax({
            type: "post",
            url: base_url + index_page + 'products/result_cart/delete',
            data: {rowid: $(this).val()},
            cache: false,
            success: function () {
                var data = {
                    title: 'Loading',
                    type: 'alert',
                    text: '<div class="text-center"><p><i class="fa fa-spinner fa-spin fa-2x"></i></p></div>'
                };
                genModal(data);
                delay(function () {
                    var data2 = {
                        url: 'products/cart/cart_dialog',
                        title: 'ตะกร้าสินค้า'
                    };
                    genModal(data2);
                }, 1000);
            },
            error: function (e) {
                alert('Error while request..');
            }
        });
    });

    $('.ddl_count').change(function () {
        $.ajax({
            type: "post",
            url: base_url + index_page + 'products/result_cart/update',
            data: {rowid: $(this).attr('id'), qty: $(this).val()},
            cache: false,
            success: function () {
                var data = {
                    title: 'Loading',
                    type: 'alert',
                    text: '<div class="text-center"><p><i class="fa fa-spinner fa-spin fa-2x"></i></p></div>'
                };
                genModal(data);
                delay(function () {
                    var data2 = {
                        url: 'products/cart/cart_dialog',
                        title: 'ตะกร้าสินค้า'
                    };
                    genModal(data2);
                }, 1000);
            },
            error: function (e) {
                alert('Error while request..');
            }
        });
    });
</script>