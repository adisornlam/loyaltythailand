<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">สินค้า <?php echo $item->product_name; ?></h1>
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
    <div class="col-lg-9">
        <div class="panel-body">
            <div style="width: 494px; height: 409px; border: 1px solid #DFDFDF; padding: 2px; float: left;">
                <img src="//www.jib.co.th/jib_content/images/gallery/<?= $product_gallery[0]['gallery_img_url'] ?>?v=1001" width="100%" alt="" id="img_area"/>
            </div>  
            <div style="float: right; width: 150px; min-height: 405px;" align="center">
                <?php
                foreach ($product_gallery as $item_data) {
                    ?>
                    <a href="javascript:change_images('<?= $item_data['gallery_img_url'] ?>');" style="padding: 0;">
                        <img src="//www.jib.co.th/jib_content/images/gallery/<?= $item_data['gallery_img_url'] ?>?v=1001" 
                             width="140" alt="" class="img-thumbnail" style="margin: 1px 0;"/>
                    </a>
                    <div class="clear"></div> 
                    <?php
                }
                ?>
                <div class="clear"></div> 

            </div>
        </div>
        <div class="panel-body">            
            <div id="fb-root"></div>
            <div class="fb-comments" data-href="<?php echo base_url() . index_page() . uri_string(); ?>" data-numposts="5" data-colorscheme="light"></div>
        </div>
        <div class="panel-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#desc" role="tab" data-toggle="tab">รายละเอียด</a></li>
                <li><a href="#spec" role="tab" data-toggle="tab">สเปคสินค้า</a></li>

            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="desc">
                    <div class="row">
                        <div class="panel-body content">

                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="spec">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th width="30%">Spec</th>
                                <th width="70%">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php echo $prod_spec; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <?php if (isset($item->product_name)) { ?>
            <div class="panel panel-warning" style="padding: 5px; margin: 0; margin-bottom: 10px; background: #F6C715;">
                <div class="panel-heading" ><?php echo $item->product_name; ?></div>
                <div class="panel-body" style="padding: 6px; margin: 0; background: #FFF;">
                    <h4 class="text-center" style="margin: 15px 0; padding: 5px;">รับประกัน <?php echo $item->warranty; ?> ปี</h4>
                    <h5 style="padding: 0; margin: 0; color: #666;" class="text-center">
                        <s>
                            <?php
                            if (get_price_dealer($item->product_id) != get_price_dealer($item->product_id, 1)) {
                                echo number_format(get_price_dealer($item->product_id));
                            }
                            ?>
                        </s>
                    </h5>
                    <h3 style="padding: 5px; margin: 0; margin-bottom: 10px;" class="text-center">
                        ราคา <span style="color: red; font-weight: bold;"><?php echo number_format(get_price_dealer($item->product_id, 1)); ?></span> บาท
                    </h3>
                    <p class="text-center">
                        <a href="javascript:;" class="add_cart btn_shop"  rel="<?php echo $item->product_id; ?>" style="color: #FFF;">
                            <i class="fa fa-shopping-cart"></i> ซื้อเลย
                        </a>
                    </p>
                    <p style="padding: 15px 0 0 0;" align="center">รหัสสินค้า : <strong><?php echo $item->product_code; ?></strong></p>
                    <p class="text-center"><button type="button" class="btn btn-primary" id="share_button"><i class="fa fa-share"></i> แชร์เลย</button></p>
                </div>
            </div>
        <?php } ?>
        <div class="panel panel-default">
            <div class="panel-body">
                <?php
                foreach ($product_right->result() as $item_right) {
                    $img_right = 'https://www.jib.co.th/jib_content/images/content/' . $item_right->cnt_thumb_url;
                    $price = get_price_dealer($item_right->product_id);
                    $price_pro = get_price_dealer($item_right->product_id, 1);
                    ?>
                    <p>
                        <a href="<?php echo base_url() . index_page(); ?>products/<?php echo $item_right->product_id; ?>/<?php echo $item_right->cnt_title; ?>" title="<?php echo $item_right->cnt_title; ?>" class="text-center">
                            <img src="<?php echo $img_right; ?>?v=1001" class="img-responsive" alt="Loading..." />
                        </a>
                    </p>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function change_images(img) {
        var img_src = document.getElementById('img_area').src = "//www.jib.co.th/jib_content/images/gallery/" + img;
    }
    window.fbAsyncInit = function() {
        FB.init({appId: '1484920491793074', status: true, cookie: true,
            xfbml: true});
    };
    (function() {
        var e = document.createElement('script');
        e.async = true;
        e.src = document.location.protocol +
                '//connect.facebook.net/en_US/all.js';
        document.getElementById('fb-root').appendChild(e);
    }());
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&appId=1484920491793074&version=v2.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    $(function() {
        $(".content").load(protocol + "//www.jib.co.th/jib_content/content/<?php echo $item->cnt_htmlfile; ?>");

        $('#share_button').click(function(e) {
            e.preventDefault();
            FB.ui(
                    {
                        method: 'feed',
                        name: '<?php echo $item->product_name; ?>',
                        link: window.location.href,
                        picture: 'http://www.jib.co.th/jib_content/images/gallery/<?= $product_gallery[0]['gallery_img_url'] ?>',
                        description: '<?php echo $description; ?>',
                        message: ''
                    });
        });
    });
    $('#btnCheckStock').click(function() {
        $(this).attr('disabled', 'disabled');
        $('#stock_result').remove();
        $(this).after('&nbsp;<span id="btn_loading"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Loading...</span>');
        $.ajax({
            type: "post",
            url: base_url + index_page + 'products/result_products/check_stock',
            data: {product_id: $(this).val()},
            cache: false, success: function(result) {
                $('#btnCheckStock').removeAttr('disabled');
                $('#btn_loading').hide();
                try {
                    var obj = $.parseJSON(result);
                    if (obj.error.status === true) {
                        $('#btnCheckStock').after('&nbsp;<span id="stock_result"><i class="fa fa-check-circle text-success"></i> มีสินค้าในสต๊อก</span>');
                    } else {
                        $('#btnCheckStock').after('&nbsp;<span id="stock_result"><i class="fa fa-frown-o"></i> จำนวนสินค้าไม่เพียงพอสำหรับสั่งซื้อ</span>');
                    }
                } catch (e) {
                    alert('Exception while request..');
                }
            },
            error: function(e) {
                alert('Error while request..');
            }
        });
    });
</script>