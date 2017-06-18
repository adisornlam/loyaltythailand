<?php if (isset($item->product_name)) { ?>
    <div class="panel panel-warning" style="padding: 5px; margin: 0; margin-bottom: 10px; background: #F6C715;">
        <div class="panel-heading" ><?php echo $item->product_name; ?></div>
        <div class="panel-body" style="padding: 6px; margin: 0; background: #FFF;">
            <h4 class="text-center" style="margin: 15px 0; padding: 5px;">รับประกัน <?php echo $item->warranty; ?> ปี</h4>
            <h5 style="padding: 0; margin: 0; color: #666;"class="text-center">
                <s>
                    <?php
                    if (get_price_dealer($item->product_id) != get_price_dealer($item->product_id, 1)) {
                        echo number_format(get_price_dealer($item->product_id));
                    }
                    ?>
                </s>
            </h5>
            <h3 style="padding: 5px; margin: 0; margin-bottom: 10px;" class="text-center">
                ราคา <span style="color: red; font-weight: bold;"><?php echo number_format(get_price_dealer($item->product_id, 1)); ?></span> บาท
            </h3>
            <p class="text-center">
                <a href="#" class="add_cart"  rel="<?php echo $item->product_id; ?>" style="color: #FFF;">
                    <i class="fa fa-shopping-cart"></i> ซื้อเลย
                </a>
            </p>
            <p style="padding: 15px 0 0 0;" align="center">รหัสสินค้า : <strong><?php echo $item->product_code; ?></strong></p>
        </div>
    </div>
<?php } ?>