<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">รายการสั่งซื้อ <?php echo $item->orders_code; ?></h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <ul class="breadcrumb">
            <?php foreach ($breadcrumbs as $key => $val) { ?>
                <?php if ($val === reset($breadcrumbs)) { ?>
                    <li><a href="<?php echo base_url() . index_page() . $val; ?>"><i class="icon-home"></i> <?php echo $key; ?></a></li>
                <?php } elseif ($val === end($breadcrumbs)) { ?>
                    <li class="active"><?php echo $key; ?></li>
                <?php } else { ?>
                    <li><a href="<?php echo base_url() . index_page() . $val; ?>"> <?php echo $key; ?></a></li>
                <?php } ?>
            <?php } ?>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#tab-1" role="tab" data-toggle="tab">สถานะ</a></li>
            <li><a href="#tab-2-1" role="tab" data-toggle="tab">สินค้า</a></li>
            <li><a href="#tab-2" role="tab" data-toggle="tab">ที่อยู่จัดส่ง</a></li>
            <li><a href="#tab-3" role="tab" data-toggle="tab">ใบกำกับภาษี</a></li>
            <li><a href="#tab-4" role="tab" data-toggle="tab">วิธีชำระเงิน</a></li>
            <li><a href="#tab-5" role="tab" data-toggle="tab">วิธีจัดส่งสินค้า</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">            
            <div class="tab-pane active" id="tab-1">
                <div class="col-lg-5">
                    <div class="panel-body">
                        <p>สถานะการสั่งซื้อ : <?php echo $order_status; ?></p>
                        <?php echo (isset($item->payment_created) ? '<p>แจ้งชำระเงินเมื่อ : <i class="fa fa-clock-o"></i> ' . $this->Common_model->get_datethai($item->payment_created) : '</p>') ?>
                        <p>วันที่สั่งซื้อ : <?php echo $this->Common_model->get_datethai($item->created_at); ?></p>
                        <p>กำหนดชำระ : <?php echo $this->Common_model->get_datethai($item->created_at, 1); ?> 18.00 น.</p>                        
                    </div>
                </div>
                <?php if ($order_log->num_rows() > 0) { ?>
                    <div class="col-lg-7">
                        <div class="panel-body">
                            <?php foreach ($order_log->result() as $value) { ?>
                                <div class="bs-callout bs-callout-info">
                                    <h4><?php echo $value->log_title; ?> <i class="fa fa-clock-o"></i> <?php echo $this->Common_model->get_datethai($value->log_time); ?></h4> 
                                    <?php echo ($value->remark ? "<p>หมายเหตุ: " . $value->remark : NULL) . "</p>"; ?>
                                    <?php echo ((isset($value->tf_name) && ( $value->status == 'notified')) ? '<p>ชื่อผู้โอน: ' . $value->tf_name . '</p> <p>จำนวนเงิน: ' . number_format($value->tf_total) . ' บาท</p> <p>วันเวลา: ' . $value->fdate . ' ' . $value->ftime . '</p> <p>โอนจาก: ' . $value->from_bank . ' โอนเข้า: ' . $value->to_bank . '</p> <p>หลักฐานการโอนเงิน: ' . ($value->slip ? '<a href="' . base_url() . $value->slip . '" target="_blank">แสดงหลักฐาน</a>' : NULL) . '</p> <p>หมายเหตุ: ' . $value->remark . '</p>' : NULL); ?>
                                    </a>
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="tab-pane" id="tab-2-1">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                                <tr>
                                    <th width="8%" class="text-center">รูปสินค้า</th>
                                    <th width="5%" class="text-center">รหัสสินค้า</th>
                                    <th width="45%" class="text-center">รายการสินค้า</th>
                                    <th width="5%" class="text-center">ราคา</th>
                                    <th width="5%" class="text-center">จำนวน</th>
                                    <th width="8%" class="text-center">ราคารวม(บาท)</th>
                                </tr>
                            </thead>                        
                            <tbody>
                                <?php
                                $totalWeight = 0;
                                foreach ($prod as $items):
                                    $subtotal = $items['price'] * $items['qty'];
                                    ?>
                                    <tr>
                                        <td class="vert-align">
                                            <a href="<?php echo base_url() . index_page(); ?>products/view/<?php echo $items['product_id']; ?>" target="_blank" title="ดูรายละเอียดสินค้า"><img src="<?php echo get_thumbs($items['product_id']); ?>" width="100" class="img-thumbnail" /></a>
                                        </td>
                                        <td class="vert-align"><?php echo $items['product_code']; ?></td>
                                        <td class="vert-align">                                        
                                            <?php echo $items['cnt_title']; ?>
                                        </td>
                                        <td class="text-right vert-align"><?php echo number_format($items['price']); ?></td>
                                        <td class="text-center vert-align"><?php echo $items['qty']; ?></td>
                                        <td class="text-right vert-align"><?php echo number_format($subtotal); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td colspan="5" class="text-right"><strong>ราคารวมสินค้า (บาท)</strong></td>
                                    <td class="text-right"><?php echo number_format($item->total_price); ?></td>
                                </tr>
                                <?php if ($credit_store['balance'] > 0) { ?>
                                    <tr>
                                        <td colspan="5" class="text-right"><strong>ยอดเครดิตคงเหลือ</strong></td>
                                        <td class="text-right"><?php echo number_format($credit_store['balance']); ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" class="text-right"><strong>ยอดเครดิตคงเหลือสุทธิ</strong></td>
                                        <td class="text-right"><?php echo ($credit_store['mn'] ? '-' : ''); ?> <?php echo number_format($credit_store['balance']); ?></td>
                                    </tr>
                                <?php } else { ?>
                                    <tr>
                                        <td colspan="5" class="text-right"><strong>รวมเป็นเงินทั้งสิ้น</strong></td>
                                        <td class="text-right"><?php echo number_format($item->sum_price); ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab-2">
                <div class="panel-body">
                    <?php echo $address_1; ?>
                </div>
            </div>
            <div class="tab-pane" id="tab-3">
                <div class="panel-body">
                    <ul>
                        <?php echo ($tax_1 === 1 ? '<li>ใบเสร็จรับเงิน</li>' : ''); ?>   
                        <?php if ($tax_2) { ?>
                            <li>                    
                                <?php
                                foreach ($tax_2 as $value) {
                                    echo $value;
                                }
                                ?>
                            </li>  
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="tab-pane" id="tab-4">
                <div class="panel-body">
                    <?php
                    foreach ($payment_item as $value2) {
                        echo $value2->description;
                    }
                    ?>                    
                </div>
            </div>
            <div class="tab-pane" id="tab-5">
                <div class="panel-body">
                    <?php echo $shipping_item->title; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">    
    <div class="col-lg-12">
        <div class="panel-body">
            <div class="text-center">                                  
                <a href="<?php echo base_url() . index_page(); ?>products/order/prints/<?php echo $this->uri->segment(4); ?>" class="btn btn-success btn-lg" role="button" target="_blank" title="พิมพ์ใบสั่งซื้อ">
                    <i class="fa fa-print"></i> พิมพ์ใบสั่งซื้อ</a> 
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.btnPayment').click(function() {
        load_page();
        var data = {
            url: 'products/order/transfer_add/<?php echo $this->uri->segment(4); ?>',
            title: 'แจ้งชำระเงิน'
        };
        genModal(data);
    });
</script>