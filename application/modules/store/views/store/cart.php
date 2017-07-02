<style type="text/css">
    .media-body{padding: 5px;}
</style>
<div class="page-header">
  <h3><?php echo $title_page; ?></h3>
</div>
<div class="row">
    <div class="col-sm-12 col-md-10 col-md-offset-1">
        <form name="form-cart" id="form-cart" action="<?php  echo site_url(); ?>store/update_cart/<?php echo $this->uri->segment(3); ?>" method="post">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>สินค้า</th>
                    <th>จำนวน</th>
                    <th class="text-center">ราคา</th>
                    <th class="text-center">รวม</th>
                    <th> </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $grand_total = 0;
                $i = 1;
                $cart = $this->cart->contents();
                foreach ($cart as $cart_item) {
                    echo form_hidden('cart[' . $cart_item['id'] . '][id]', $cart_item['id']);
                    echo form_hidden('cart[' . $cart_item['id'] . '][rowid]', $cart_item['rowid']);
                    echo form_hidden('cart[' . $cart_item['id'] . '][name]', $cart_item['name']);
                    echo form_hidden('cart[' . $cart_item['id'] . '][price]', $cart_item['price']);
                    echo form_hidden('cart[' . $cart_item['id'] . '][qty]', $cart_item['qty']);
                    ?>
                    <tr>
                        <td class="col-sm-8 col-md-6">
                            <div class="media">
                                <a class="thumbnail pull-left" href="#"> <img class="media-object" src="<?php echo base_url() . $cart_item['img_path'] . $cart_item['img']; ?>" style="width: 72px; height: 72px;"> </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="#"><?php echo $cart_item['name']; ?></a></h4>
                                    <span>สถานะ: </span><span class="text-success"><strong>มีสินค้า</strong></span>
                                </div>
                            </div></td>
                        <td class="col-sm-1 col-md-1" style="text-align: center">
                            <?php echo form_input('cart[' . $cart_item['id'] . '][qty]', $cart_item['qty'], 'maxlength="3" class="form-control" style="text-align: right"'); ?>
                        </td>
                        <td class="col-sm-1 col-md-1 text-center"><strong><?php echo number_format($cart_item['price'],2); ?></strong></td>
                        <?php $grand_total = $grand_total + $cart_item['subtotal']; ?>
                        <td class="col-sm-1 col-md-1 text-center"><strong><?php echo number_format($cart_item['subtotal'], 2) ?></strong></td>
                        <td class="col-sm-1 col-md-1">
                            <a class="btn btn-danger" href="<?php echo site_url(); ?>store/remove_cart/<?php echo $this->uri->segment(3); ?>/<?php echo $cart_item['rowid']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td><h5>รวมราคาสุทธิ</h5></td>
                    <td class="text-right"><h5><strong><?php echo number_format($grand_total, 2); ?></strong></h5></td>
                </tr>
                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>
                        <button class="btn btn-info" type="submit"><i class="fa fa-pencil-square" aria-hidden="true"></i> อัพเดตสินค้า</button>
                    </td>
                    <td>
                        <a class="btn btn-default" href="<?php echo site_url(); ?>store/my/<?php echo $this->uri->segment(3); ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i> ซื้อสินค้าเพิ่ม</a>    
                    </td>
                    <td>
                        <a class="btn btn-success" href="<?php echo site_url(); ?>store/checkout/<?php echo $this->uri->segment(3); ?>"><i class="fa fa-money" aria-hidden="true"></i> ชำระเงิน</a>
                    </td>
                </tr>
            </tbody>
        </table>
        </form>
    </div>
</div>