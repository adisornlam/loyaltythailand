<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">เปรียบเทียบสินค้า</h1>
    </div>
</div>
<div class="row">
    <div class="panel-body">
        <a href="javascript:;" class="btn btn-primary" id="btnClearCompare" role="button">ลบรายการเปรียบเทียบสินค้า</a>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default borderless">
            <div class="panel-body">
                <?php echo $prod_spec; ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#btnClearCompare').click(function() {
        $.removeCookie('product_compare_id', {path: '/'});
        ajax_page(base_url + index_page + 'products/compare');
    });
</script>