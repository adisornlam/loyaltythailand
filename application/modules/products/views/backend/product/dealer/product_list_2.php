<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">รายการสินค้า</h1>
    </div>
</div>
<div class="row">
    <div class="panel panel-default panel-success">
        <div class="panel-heading">ค้นหาสินค้า</div>
        <div class="panel-body">
            <div class="form-group">
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="txtSearch" name="txtSearch" placeholder="ค้นหา Produce Code/Product Name/Category">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="panel panel-default panel-primary">
        <div class="panel-heading">รายการสินค้า</div>
        <div class="panel-body">
            <?php foreach ($product as $item) { ?>
                <div class="col-sm-3">
                    <div class="col-item">
                        <div class="photo">
                            <img src="//www.jib.co.th/jib_content/images/gallery/<?php echo $item->gallery_img_url ?>" class="img-responsive" alt="a" />
                        </div>
                        <div class="info">
                            <div class="row">
                                <div class="price col-md-12">
                                    <h5><?php echo $item->cnt_title; ?></h5>
                                    <h5 class="price-text-color">ราคา <?php echo number_format($item->price_1); ?> บาท</h5>
                                </div>
                            </div>
                            <div class="separator clear-left">
                                <p class="btn-add">
                                    <i class="fa fa-shopping-cart"></i><a href="javascript:;" class="hidden-sm">ซื้อเลย</a></p>
                                <p class="btn-details">
                                    <i class="fa fa-list"></i><a href="javascript:;" class="hidden-sm link_dialog" rel="products/backend/product/spec/<?php echo $item->product_id; ?>">รายละเอียด</a></p>
                            </div>
                            <div class="clearfix">
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>