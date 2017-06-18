<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">รายการสินค้า</h1>
    </div>
</div>
<?php if (isset($breadcrumbs)) { ?>
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
<?php } ?>
<div class="row">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-6 text-left">
                <p>รายการสินค้าทั้งหมด <strong><?php echo number_format($total); ?></strong> รายการ</p>
            </div>            
            <div class="col-lg-6 text-right">
                <?php echo $links; ?>
            </div>   
        </div>

        <div class="row">
            <?php
            foreach ($result as $item) {
                $img = 'https://www.jib.co.th/jib_content/images/content/' . $item->cnt_thumb_url;
                $price = get_price_dealer($item->product_id);
                $price_pro = get_price_dealer($item->product_id, 1);
                ?>
                <div class="col-sm-3" style="padding-bottom: 20px; border-bottom: 1px dashed #DFDFDF;">
                    <div class="col-item">
                        <div class="photo">
                            <a href="<?php echo base_url() . index_page(); ?>products/<?php echo $item->product_id; ?>/<?php echo clear_url($item->cnt_title); ?>" title="<?php echo $item->cnt_title; ?>" id="<?php echo $item->product_id; ?>">
                                <img src="<?php echo $img; ?>?v=1001" class="img-responsive" alt="Loading..." />
                            </a>
                        </div>
                        <div class="info">
                            <div class="row">
                                <div class="price col-md-12" style=" text-align: center;">
                                    <h5><?php echo $item->cnt_title; ?></h5>                                 
                                </div>                               
                            </div>
                            <div class="row" style="text-align: center; color: #666;">
                                <?php
                                if ($price != $price_pro) {
                                    echo '<s>' . number_format($price) . '</s>';
                                } else {
                                    echo '&nbsp;';
                                }
                                ?>
                            </div>
                            <div class="clear-left text-center">
                                <h4 class="price-text-color"><strong class="text-danger"><?php echo number_format($price_pro); ?> บาท</strong> </h4>
                            </div>
                            <div class="separator clear-left" style=" padding: 10px 0; text-align: center;">
                                <a href="javascript:;" class="hidden-sm add_cart btn_shop" rel="<?php echo $item->product_id; ?>">
                                    <i class="fa fa-shopping-cart"></i> ซื้อเลย
                                </a>
                            </div>
                            <div class="clearfix">
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <div class="row">
            <div class="panel-body">
                <div class="col-lg-6 text-left">
                </div> 
                <div class="col-lg-6 text-right">
                    <?php echo $links; ?>
                </div>  
            </div>
        </div>
    </div>
</div>