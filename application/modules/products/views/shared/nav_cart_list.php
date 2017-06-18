<?php foreach ($this->cart->contents() as $items): ?>
    <li>
        <a href="javascript:;">
            <div>
                <strong><?php echo $items['name']; ?></strong>
                <button type="button" class="btn btn-danger pull-right btn-xs delete_cart" value="<?php echo $items['rowid']; ?>"><i class="fa fa-trash-o"></i></button>
                <br />
                <span>ราคา: <?php echo number_format($items['price']); ?> บาท จำนวน: <?php echo number_format($items['qty']); ?> รายการ</span><span class="pull-right"><?php echo number_format($items['subtotal']); ?> บาท</span>                                                                        
            </div>
        </a>
    </li>
    <li class="divider"></li>  
<?php endforeach; ?> 
<?php if ($this->cart->total_items() > 0) { ?>
    <li>
        <div>
            <span class="pull-right"><strong>Total</strong>: <?php echo number_format($this->cart->total()); ?> Baht&nbsp;&nbsp;</span>
        </div>
    </li>
<?php } else { ?>
    <li class="text-center">ยังไม่มีรายการสินค้าในตะกร้า</li>
<?php } ?>
<li>
    <a class="text-center link_dialog" rel="products/cart/cart_dialog" title="ตะกร้าสินค้า" style="cursor: pointer;">
        <strong>สินค้าในตะกร้า</strong>
        <i class="fa fa-angle-right"></i>
    </a>
</li>