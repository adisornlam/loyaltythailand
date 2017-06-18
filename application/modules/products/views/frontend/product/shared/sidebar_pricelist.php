<div style="width:180px;" id="jib_side_menu">
    <div class="header_title"><a style="color:#FFF; padding-left: 30px;" href="javascript:;">ประเภทสินค้า</a></div>  
    <ul style="padding-top:2px;">
        <?php foreach ($this->Category_model->get_stk_category() as $key => $val) { ?>
            <li>
                <a class="ajax_page" href="javascript:;" rel="<?php echo base_url() . index_page(); ?>products/pricelist?category_id=<?php echo $key; ?>&sub=1">
                    <span><?php echo $val ?></span>
                </a>
            </li>
        <?php } ?>
    </ul>
</div>