
<style>
    .tip {
        color: #fff;
        background:#FFF;
        display:none; /*--Hides by default--*/
        padding:5px;
        position:absolute;
        z-index:1000;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
    }
</style>

<div class="row">    
    <div class="col-lg-12">
        <h1 class="page-header">รายการสินค้า</h1>
    </div>
</div>
<div class="row">    
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-lg-6">
                    <a href="javascript:;" class="btn btn-primary ajax_page" role="button" 
                       rel="<?php echo base_url() . index_page(); ?>products/compare" title="แสดงรายการเปรียบเทียบสินค้า"><i class="fa fa-files-o"></i> แสดงรายการเปรียบเทียบสินค้า</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="panel-body">
        <div class="col-lg-6 text-left">
            <p>รายการสินค้าทั้งหมด <strong><?php echo number_format($total); ?></strong> รายการ</p>
        </div>            
        <div class="col-lg-6 text-right">
            <?php echo $links; ?>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-hover">
            <thead>
            <th width="2%" class="text-center"></th>
            <th width="35%" class="text-center">ชื่อสินค้า</th>
            <th width="35%" class="text-center">รายละเอียด</th>
            <th width="8%" class="text-center">ราคา(บาท)</th>
            <th width="8%" class="text-center">ประกัน/ปี</th>
            <th width="10%" class="text-center"></th>
            </thead>
            <tbody>
                <?php
                foreach ($result as $item) {
                    $img = 'https://www.jib.co.th/jib_content/images/content/' . $item->cnt_thumb_url;
                    $price = get_price_dealer($item->product_id);
                    $price_pro = get_price_dealer($item->product_id, 1);
                    ?>
                    <tr>
                        <td>
                            <a href="#" target="_blank" class="tip_trigger" 
                               style="float: left; margin: 2px; padding: 8px; border: 1px dashed #ddd;">
                                <i class="fa fa-file-image-o"></i>
                                <span class="tip">
                                    <img src="<?= $img ?>" width="170" alt="" class=" img-thumbnail" />
                                </span> 
                            </a>
                        </td>
                        <td><?php echo $item->cnt_title; ?></td>
                        <td><?php echo $item->cnt_sum_info; ?></td>
                        <td class="text-right"><?php echo number_format($price); ?></td>
                        <td class="text-center"><?php echo $item->warranty; ?></td>
                        <td class="text-center">
                            <a href="javascript:;" class="btn btn-danger btn-sm add_cart" role="button" title="ซื้อสินค้า" rel="<?php echo $item->product_id; ?>">
                                <i class="fa fa-shopping-cart"></i>
                            </a>
                            <a href="javascript:;" class="btn btn-primary btn-sm compare" role="button" title="เปรียบเทียบสินค้า" id="<?php echo $item->product_id; ?>">
                                <i class="fa fa-files-o"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table> 

    </div>
    <div class="row">
        <div class="col-lg-6 text-left">
        </div> 
        <div class="col-lg-6 text-right">
            <?php echo $links; ?>
        </div>            
    </div>
</div>
<script type="text/javascript">
    $(function() {
        var my_array = [];
        $(".compare").click(function() {
            var val = $(this).attr('id');
            if (my_array.indexOf(val) === -1) {
                my_array.push(val);
            }
            $.cookie('product_compare_id', my_array, {expires: 1, path: '/'});
            $.gritter.add({
                title: 'แจ้งเตือน',
                text: 'เพิ่มรายการเปรียบเทียบสินค้าแล้ว',
                sticky: false,
                time: '3000'
            });
        });
        $(".tip_trigger").hover(function() {
            tip = $(this).find('.tip');
            tip.show();
        }, function() {
            tip.hide();
        }).mousemove(function(e) {
            var mousex = e.pageX + 50;
            var mousey = e.pageY + 20;
            var tipWidth = tip.width();
            var tipHeight = tip.height();
            var tipVisX = 0;
            var tipVisY = 0;
            if (tipVisX < 20) {
                mousex = e.pageX - tipWidth - 20;
            }
            if (tipVisY < 20) {
                mousey = e.pageY - tipHeight - 20;
            }
            tip.css({top: mousey, left: mousex});
        });

    });
</script>