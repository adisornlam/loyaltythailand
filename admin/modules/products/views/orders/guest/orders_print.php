<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <link href="<?php echo base_url(); ?>assets/backend/css/bootstrap.min.css" rel="stylesheet" media="all">
        <style type="text/css">
            @media print {
                html, body {
                    /*changing width to 100% causes huge overflow and wrap*/
                    font-family: tahoma;
                    font-size: 8pt;
                }
            }
            .height {
                min-height: 200px;
            }

            .icon {
                font-size: 47px;
                color: #5CB85C;
            }

            .iconbig {
                font-size: 77px;
                color: #5CB85C;
            }

            .table > tbody > tr > .emptyrow {
                border-top: none;
            }

            .table > thead > tr > .emptyrow {
                border-bottom: none;
            }

            .table > tbody > tr > .highrow {
                border-top: 3px solid;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="text-center">
                        <i class="fa fa-search-plus pull-left icon"></i>
                        <h2>ใบสั่งซื้อเลขที่ <?php echo $item->orders_code; ?></h2>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-6 pull-left">
                            <div class="panel-body">
                                <h4>ข้อมูลลูกค้า</h4>
                                <p><strong><?php echo $item->first_name . " " . $item->last_name; ?></strong></p>
                                <p>ที่อยู่ : <?php echo $this->Users_model->get_address_dealer(0, $item->user_id); ?></p>
                            </div>
                        </div>                    
                        <div class="col-xs-6 pull-right">
                            <div class="panel-body">
                                <h4>ที่อยู่จัดส่งสินค้า</h4>
                                <?php echo $address_1; ?>
                                <h4>วิธีจัดส่งสินค้า</h4>
                                <?php echo $shipping_item->title; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-condensed">
                                    <thead>
                                        <tr>
                                            <td><strong>รหัสสินค้า</strong></td>
                                            <td><strong>สินค้า</strong></td>
                                            <td class="text-center"><strong>ราคา</strong></td>
                                            <td class="text-center"><strong>จำนวน</strong></td>
                                            <td class="text-right"><strong>รวม</strong></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $totalWeight = 0;
                                        foreach ($prod as $items):
                                            $subtotal = $items['price'] * $items['qty'];
                                            ?>                                        
                                            <tr>
                                                <td><?php echo $items['product_code']; ?></td>
                                                <td><?php echo $items['cnt_title']; ?></td>
                                                <td class="text-center"><?php echo number_format($items['price']); ?></td>
                                                <td class="text-center"><?php echo $items['qty']; ?></td>
                                                <td class="text-right"><?php echo number_format($subtotal); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td class="highrow text-right" colspan="4"><strong>รวมราคา</strong></td>
                                            <td class="highrow text-right"><?php echo number_format($item->total_price); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="emptyrow text-right" colspan="4"><strong>ยอดชำระสินค้าทั้งหมด</strong></td>
                                            <td class="emptyrow text-right"><?php echo number_format($item->sum_price); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="panel-body">
                        <h4>ข้อมูลชำระเงิน</h4>
                        <?php
                        foreach ($payment_item as $value2) {
                            echo $value2->desc_invoice;
                        }
                        ?> 
                    </div>
                </div>
            </div>
        </div>        
    </body>
</html>