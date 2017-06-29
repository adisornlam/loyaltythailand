<style type="text/css">
    .media-body{padding: 5px;}
</style>
<div class="row">
    <div class="col-sm-12 col-md-10 col-md-offset-1">
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
                    ?>
                    <tr>
                        <td class="col-sm-8 col-md-6">
                            <div class="media">
                                <a class="thumbnail pull-left" href="#"> <img class="media-object" src="http://icons.iconarchive.com/icons/custom-icon-design/flatastic-2/72/product-icon.png" style="width: 72px; height: 72px;"> </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="#"><?php echo $cart_item['name']; ?></a></h4>
                                    <span>Status: </span><span class="text-success"><strong>In Stock</strong></span>
                                </div>
                            </div></td>
                        <td class="col-sm-1 col-md-1" style="text-align: center">
                            <?php echo form_input('cart[' . $cart_item['id'] . '][qty]', $cart_item['qty'], 'maxlength="3" class="form-control" style="text-align: right"'); ?>
                        </td>
                        <td class="col-sm-1 col-md-1 text-center"><strong><?php echo $cart_item['price']; ?></strong></td>
                        <?php $grand_total = $grand_total + $cart_item['subtotal']; ?>
                        <td class="col-sm-1 col-md-1 text-center"><strong><?php echo number_format($cart_item['subtotal'], 2) ?></strong></td>
                        <td class="col-sm-1 col-md-1">
                            <button type="button" class="btn btn-danger">
                                <span class="glyphicon glyphicon-remove"></span> Remove
                            </button></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td><h5>Subtotal</h5></td>
                    <td class="text-right"><h5><strong>$24.59</strong></h5></td>
                </tr>
                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td><h5>Estimated shipping</h5></td>
                    <td class="text-right"><h5><strong>$6.94</strong></h5></td>
                </tr>
                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td><h3>Total</h3></td>
                    <td class="text-right"><h3><strong>$31.53</strong></h3></td>
                </tr>
                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td>
                        <button type="button" class="btn btn-default">
                            <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
                        </button></td>
                    <td>
                        <button type="button" class="btn btn-success">
                            Checkout <span class="glyphicon glyphicon-play"></span>
                        </button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>