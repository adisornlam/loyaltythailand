<link href="<?php echo base_url(); ?>assets/frontend/js/plugins/jquery-fancybox/jquery.fancybox.css" rel="stylesheet" />
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
                    <i class="fa fa-list fa-2x"></i> 
                    <a href="javascript:;" class="ajax_page" rel="<?php echo base_url() . index_page(); ?>products/change_view?view_type=grid" title="แสดงรายการสินค้าแบบตาราง"><i class="fa fa-th fa-2x"></i></a>
                    <a href="javascript:;" class="ajax_page" rel="<?php echo base_url() . index_page(); ?>products/compare" title="แสดงรายการเปรียบเทียบสินค้า"><i class="fa fa-files-o fa-2x"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
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
            $i = 1;
            foreach ($result as $item) {
                $img = 'https://www.jib.co.th/jib_content/images/content/' . $item->cnt_thumb_url;
                $price = get_price_dealer($item->product_id);
                ?>
                <div class="col-lg-12">
                    <div class="col-lg-2 text-center">

                        <a href="javascript:;" rel="<?php echo base_url() . index_page(); ?>products/view/<?php echo $item->product_id; ?>" class="ajax_page" title="<?php echo $item->cnt_title; ?>" id="<?php echo $item->product_id; ?>"><img src="<?php echo $img; ?>" class="img-responsive" alt="Loading..." /></a>
                        <br />
                        <p class="text-center"><a href="javascript:;" class="btn btn-danger add_cart btn_shop" role="button" rel="<?php echo $item->product_id; ?>"><i class="fa fa-shopping-cart"></i> สั่งซื้อเลย</a></p>
                    </div>
                    <div class="col-lg-10">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="active"><a href="#info_<?php echo $i; ?>" role="tab" data-toggle="tab">Info</a></li>
                            <li><a href="#spec_<?php echo $i; ?>" role="tab" data-toggle="tab">Spec</a></li>
                            <li><a href="#photo_<?php echo $i; ?>" role="tab" data-toggle="tab">Photo</a></li>
                            <li><a href="#price_<?php echo $i; ?>" role="tab" data-toggle="tab">Price</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="info_<?php echo $i; ?>">
                                <br />
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td width="10%"><strong><?php echo $item->product_code; ?></strong></td><td><strong><?php echo $item->cnt_title; ?></strong> ประกัน <strong><?php echo $item->warranty; ?></strong> ปี</td>
                                        </tr>
                                        <tr>
                                            <td width="10%" colspan="2" valign="middle" class=" vert-align">
                                                ราคา 
                                                <span class="badge alert-success" style="font-size:18pt; color: red; font-weight: bold;">
                                                    <?php
                                                    $price = get_price_dealer($item->product_id);
                                                    $price_pro = get_price_dealer($item->product_id, 1);
                                                    ?>
                                                    <?php echo number_format($price_pro); ?>
                                                </span>
                                                บาท
                                                <?php
                                                if ($price != $price_pro) {
                                                    echo '<em style="color:#999;">จากราคาปกติขาย <s>' . $price . '</s> บาท</em>';
                                                }
                                                ?>
                                            </td>                                            
                                        </tr>
                                        <tr>
                                            <td colspan="2" >
                                                <label><?php echo form_checkbox('product_compare', $item->product_id, $this->Products_model->get_array_compare($this->input->cookie('product_compare_id'), $item->product_id), 'class="compare"'); ?> เปรียบเทียบสินค้า</label>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>         
                            </div>
                            <div class="tab-pane" id="spec_<?php echo $i; ?>">
                                <br />
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th width="20%">Spec</th>
                                            <th width="80%">Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php echo $this->Products_model->get_spec_html($item->product_id); ?>
                                    </tbody>
                                </table>  
                            </div>
                            <div class="tab-pane" id="photo_<?php echo $i; ?>">
                                <br />
                                <?php
                                $img = "";
                                $str = '';
                                $img = $this->Products_model->get_galler_list($item->product_id);
                                foreach ($img as $itemdata) {
                                    $str .= '<div class="col-xs-6 col-md-4">';
                                    $str .= '<a href="//www.jib.co.th/jib_content/images/gallery/' . $itemdata['gallery_img_url'] . '" class="thumbnail fancybox" title="' . $itemdata['cnt_title'] . '" data-gallery rel="group_' . $item->product_id . '">';
                                    $str .='<img class="img-responsive" src="//www.jib.co.th/jib_content/images/gallery/' . $itemdata['gallery_img_url'] . '" alt="Loading..." height="200" />';
                                    $str .='</a>';
                                    $str .='</div>';
                                    echo $str;
                                }
                                ?>
                                <?php //echo $this->Products_model->get_galler_list($item->product_id); ?> 
                            </div>
                            <div class="tab-pane" id="price_<?php echo $i; ?>">
                                <br />
                                <div class="col-lg-5">
                                    <?php echo $this->Products_model->get_price_html($item->product_id); ?> 
                                </div>
                            </div>
                        </div>
                    </div>  
                    <div class="col-lg-12">
                        <hr class="divider">
                    </div>
                </div>
                <?php
                $i++;
            }
            ?>
        </div>
        <div class="row">
            <div class="col-lg-6 text-left">
            </div> 
            <div class="col-lg-6 text-right">
                <?php echo $links; ?>
            </div>            
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/frontend/js/plugins/jquery-fancybox/jquery.fancybox.js"></script>
<script type="text/javascript">
    $(function () {
        $(".fancybox").fancybox();
        var my_array = [];
        $(".compare").click(function () {
            var val = $(this).val();
            if ($(this).is(":checked")) {
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
            } else {
                var i;
                var newFilter = $.cookie('product_compare_id');
                var ArrayData = $.map(newFilter.split(','), function (value) {
                    return parseInt(value, 10);
                });
                $.each(ArrayData, function (index, value) {
                    if (value.toString() === val) {
                        i = index;
                        return false;
                    }
                });
                ArrayData.splice(i, 1);
                $.cookie('product_compare_id', ArrayData, {expires: 1, path: '/'});
                $.gritter.add({
                    title: 'แจ้งเตือน',
                    text: 'ลบรายการเปรียบเทียบสินค้าแล้ว',
                    sticky: false,
                    time: '3000'
                });
            }
        });
    });
</script>