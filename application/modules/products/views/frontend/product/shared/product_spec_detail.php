<div class="panel panel-default">
    <div class="panel-body">        
        <a href="javascript:;" class="btn btn-danger add_cart" role="button" rel="<?php echo $item->product_id; ?>"><i class="fa fa-shopping-cart"></i> ซื้อเลย</a>
        <a href="<?php echo base_url() . index_page(); ?>products/compare/<?php echo $item->product_id; ?>" class="btn btn-warning" title="เปรียบเทียบสินค้า" role="button"><i class="fa fa-files-o"></i> เปรียบเทียบสินค้า</a>
    </div>
</div>
<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    <li class="active"><a href="#info" role="tab" data-toggle="tab">Info</a></li>
    <li><a href="#picture" role="tab" data-toggle="tab">Picture</a></li>
    <li><a href="#spec" role="tab" data-toggle="tab">Spec</a></li>
    <li><a href="#desc" role="tab" data-toggle="tab">Description</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div class="tab-pane active" id="info">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th width="20%">Item</th>
                    <th width="80%">Detail</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>รหัสสินค้า</td><td><?php echo $item->product_code; ?></td>
                </tr>
                <tr>
                    <td>ชื่อสินค้า</td><td><?php echo $item->product_name; ?></td>
                </tr>
                <tr>
                    <td>ราคา</td><td><?php echo number_format(get_price_dealer($item->product_id)); ?></td>
                </tr>
                <tr>
                    <td>ประกัน</td><td><?php echo $item->warranty; ?></td>
                </tr>
                <tr>
                    <td>สต๊อกสินค้า</td><td><button type="button" class="btn btn-warning btn-xs" id="btnCheckStock" value="<?php echo $item->product_id; ?>">ตรวจสอบจำนวนสต๊อก</button></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="tab-pane" id="picture">
        <div class="row">

            <div class="panel-body">
                <?php echo $product_gallery; ?>
            </div>

        </div>
    </div>
    <div class="tab-pane" id="spec">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Spec</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $prod_spec; ?>
            </tbody>
        </table>
    </div>
    <div class="tab-pane" id="desc">
        <div class="row">
            <div class="panel-body content">

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        $(".content").load("https://www.jib.co.th/jib_content/content/<?php echo $item->cnt_htmlfile; ?>", function(responseTxt, statusTxt, xhr) {
            if (statusTxt === "success")
                //alert("External content loaded successfully!");
                if (statusTxt === "error")
                    $(this).html('No Data.');
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
    $('.add_cart').click(function() {
        var obj = $(this);
        $.ajax({
            type: "post",
            url: base_url + index_page + 'products/result_cart/add',
            data: {product_id: obj.attr('rel'), qty: 1},
            cache: false,
            success: function(result) {
                try {
                    var obj = $.parseJSON(result);
                    if (obj.status === true) {
                        $('.navbar-nav #total_item').empty();
                        $('.navbar-nav #total_item').append(obj.total);
                        $('.navbar-nav #total_item').removeClass('hidden');
                        $.gritter.add({
                            title: 'ซื้อสินค้า',
                            text: 'เพิ่มรายการสินค้าลงตะกร้าเรียบร้อยแล้ว',
                            sticky: false,
                            time: '5000'
                        });
                    } else {
                        alert('Add cart false. !!!');
                    }
                } catch (e) {
                    alert('Exception while request..');
                }
            },
            error: function(e) {
                console.log(e);
                alert('Error while request..');
            }
        });
    });
</script>