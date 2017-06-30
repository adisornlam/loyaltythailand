<div id="products" class="row list-group">
    <?php foreach ($result_product->result() as $item_product) { ?>
        <div class="item col-sm-12 col-lg-4">
            <div class="thumbnail"  style="height: 440px;">
                <img class="group list-group-image" src="<?php echo ($item_product->cover_img_thumb != NULL ? base_url() . $item_product->cover_img_path . $item_product->cover_img_thumb : 'http://www.placehold.it/250x250/EFEFEF/AAAAAA&amp;text=no+image'); ?>" alt="<?php echo $item_product->title; ?>" />
                <div class="caption">
                    <h4 class="group inner list-group-item-heading text-center"><?php echo $item_product->title; ?></h4>
                    <p class="group inner list-group-item-text"><?php echo $item_product->desc_short; ?></p>
                    <div class="row">
                        <div class="col-xs-6 col-md-6">
                            <p class="lead">ราคา <?php echo number_format($item_product->unit_price); ?> บาท <br /><i class="fa fa-star" aria-hidden="true"></i> <?php echo $item_product->point; ?> แต้ม</p>
                        </div>
                        <div class="col-xs-6 col-md-6 text-right">
                            <a class="btn btn-success" href="<?php echo site_url(); ?>store/add_cart/<?php echo $this->uri->segment(3); ?>/<?php echo $item_product->id; ?>"><i class="fa fa-cart-plus fa-2x" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<div class="text-center">
    <?php echo $pagination_helper->create_links(); ?>
</div>
