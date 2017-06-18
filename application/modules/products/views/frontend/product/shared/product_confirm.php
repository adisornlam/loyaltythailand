<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">ยืนยันการสั่งซื้อ</h1>
    </div>
</div>
<div class="row">    
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="stepy-tab">
                    <ul class="stepy-titles clearfix">
                        <li><a href="javascript:;" rel="<?php echo $link_wizad['step2']; ?>" class="ajax_page"><div>ตะกร้าสินค้า</div><span> </span></a></li>
                        <li><a href="javascript:;" rel="<?php echo $link_wizad['step3']; ?>" class="ajax_page"><div>ที่อยู่จัดส่งสินค้า</div><span> </span></a></li>
                        <li><a href="javascript:;" rel="<?php echo $link_wizad['step4']; ?>" class="ajax_page"><div>วิธีชำระเงิน</div><span> </span></a></li>
                        <li class="current-step"><div>ยืนยันการสั่งซื้อ</div><span> </span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">    
    <div class="col-lg-12">
        <div class="list-group">
            <a href="javascript:;" class="list-group-item">
                <h4 class="list-group-item-heading">ที่อยู่จัดส่งสินค้า</h4>
                <p class="list-group-item-text">
                    <?php echo $address_1; ?>
                </p>
            </a>
            <a href="javascript:;" class="list-group-item">
                <h4 class="list-group-item-heading">วิธีจัดส่งสินค้า</h4>
                <p class="list-group-item-text">
                    <?php echo $shipping_item->title; ?>
                </p>
            </a>
            <a href="javascript:;" class="list-group-item">
                <h4 class="list-group-item-heading">ใบกำกับภาษี</h4>
                <p class="list-group-item-text">
                <ul>
                    <?php echo ($this->input->cookie('tax_1', true) ? '<li>ใบเสร็จรับเงิน</li>' : ''); ?>     
                    <?php if ($address_tax) { ?>
                        <li>                    
                            <?php
                            foreach ($address_tax as $value) {
                                echo $value;
                            }
                            ?>
                        </li>     
                    <?php } ?>
                </ul>
                </p>
            </a>
            <a href="javascript:;" class="list-group-item">
                <h4 class="list-group-item-heading">วิธีชำระเงิน</h4>
                <p class="list-group-item-text">
                    <?php
                    foreach ($payment_item as $value2) {
                        echo $value2->description;
                    }
                    ?>
                </p>
            </a>
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
                                <th width="5%" class="text-center">รูปสินค้า</th>
                                <th width="60%">ชื่อสินค้า</th>
                                <th width="8%" class="text-center">ราคา</th>
                                <th width="8%" class="text-center">จำนวน</th>                                
                                <th width="8%" class="text-center">ราคารวม</th>
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
                                    <td class="vert-align"><?php echo $items['name']; ?></td>
                                    <td class="text-right vert-align"><?php echo number_format($items['price']); ?></td>
                                    <td class="text-center vert-align"><?php echo $items['qty']; ?></td>
                                    <td class="text-right vert-align"><?php echo number_format($items['subtotal']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="4" class="text-right"><strong>ราคารวมสินค้า (บาท)</strong></td>
                                <td class="text-right"><?php echo number_format($this->cart->total()); ?></td>
                            </tr>
                            <?php if ($credit_store['balance'] > 0) { ?>
                                <tr>
                                    <td colspan="4" class="text-right"><strong>ยอดเครดิตคงเหลือ</strong></td>
                                    <td class="text-right"><?php echo number_format($credit_store['balance']); ?></td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-right"><strong>ยอดเครดิตคงเหลือสุทธิ</strong></td>
                                    <td class="text-right"><?php echo ($credit_store['mn'] ? '-' : ''); ?> <?php echo number_format($credit_store['dif']); ?></td>
                                </tr>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="4" class="text-right"><strong>รวมเป็นเงินทั้งสิ้น</strong></td>
                                    <td class="text-right"><?php echo number_format($this->cart->total()); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="panel-body">
            <div class="text-center">  
                <a href="javascript:;" rel="<?php echo $link_wizad['step4']; ?>" class="btn btn-success btn-lg ajax_page" role="button">
                    ย้อนกลับ <i class="fa fa-arrow-circle-left"></i></a>  
                <a href="javascript:;" class="btn btn-danger btn-lg btnConfirm" role="button">
                    <i class="fa fa-check-circle"></i> ยืนยันการสั่งซื้อ</a>  
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.btnConfirm').click(function() {
        var data = {
            title: 'Confirm Order',
            text: 'ยืนยันการสั่งซื้อสินค้า ?',
            type: 'confirm'
        };
        genModal(data);

        $('body').on('click', '#myModal #button-confirm', function() {
            $('#myModal #button-confirm').attr('disabled', 'disabled');
            $('#myModal #button-confirm').after('&nbsp;<span id="spinner_loading"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Loading...</span>');
            var dt = {
                address_id: $.cookie('address_id'),
                tax_1: $.cookie('tax_1'),
                tax_2: $.cookie('tax_2'),
                shipping_id: $.cookie('shipping_id'),
                payment_id: $.cookie('payment_id')
            };
            var data3 = {
                url: 'products/result_cart/confirm',
                v: dt
            };
            var rs = getDataUrl(data3);
            var obj = $.parseJSON(rs);
            if (obj.error.status === true)
            {
                $('#myModal .modal-footer').hide();
                $('#myModal .modal-body').empty();
                $('#myModal .modal-body').html('<div class="text-center"><p><i class="fa fa-check-circle fa-3x text-success"></i></p>' + obj.error.message + '</div>');
                $('#spinner_loading').remove();
                setTimeout(function() {
                    $('#myModal').modal('hide');
                    $('#myModal').on('hidden.bs.modal', function(e) {
                        window.location.href = base_url + index_page + obj.error.redirect;
                    });
                }, 2000);

                $('#myModal').on('hidden.bs.modal', function(e) {
                    window.location.href = base_url + index_page + obj.error.redirect;
                });
            }
        });
    });
</script>