<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Product List</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default borderless">
            <div class="panel-body">
                <div class="pull-left">
                </div>  
                <div class="pull-right">
                    <button class="btn btn-default btn-circle" type="button" id="btnRefresh" value="products/backend/product"><i class="fa fa-refresh"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default borderless">
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="txtSearch" name="txtSearch" placeholder="ค้นหา Produce Code/Product Name/Category">
                    </div>
                    <div class="col-sm-3">
                        <select name="myCat" id="myCat" class="form-control">
                            <option value="">Please select category.</option>
                            <?php foreach ($search_category as $key => $val) { ?>
                                <optgroup label="<?php echo $val ?>">
                                    <?php foreach ($this->Category_model->get_stk_category($key) as $key2 => $val2) { ?>
                                        <option value="<?php echo $key2; ?>"><?php echo $val2; ?></option>
                                    <?php } ?>
                                </optgroup>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="table-responsive">
                    <span id="showprocess"></span>
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                            <tr>
                                <th width="2%"></th>
                                <th width="8%">รหัสสินค้า</th>
                                <th width="25%">ชื่อสินค้า</th>
                                <th width="12%">หมวดหมู่</th>
                                <th width="5%">สต็อค</th>
                                <th width="5%">ประกัน</th>
                                <th width="6%">ราคาปลีก</th>
                                <th width="6%">ราคาส่ง</th>
                                <th width="5%">Recomm</th>
                                <th width="5%">New</th>
                                <th width="5%">Prom</th>
                                <th width="5%">Sale</th>
                                <th width="8%">By Order</th>
                                <th width="8%">Active</th>
                            </tr>
                        </thead>                        
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        $('body').on('change', '.prod_chk', function() {
            if ($(this).is(":checked")) {
                $.ajax({
                    url: base_url + index_page + 'products/backend/result_product/update_status',
                    type: 'POST',
                    data: {product_id: $(this).attr('name'), id: $(this).val(), strState: "Y"}
                });
            } else {
                $.ajax({
                    url: base_url + index_page + 'products/backend/result_product/update_status',
                    type: 'POST',
                    data: {product_id: $(this).attr('name'), id: $(this).val(), strState: "N"}
                });
            }
        });

        $('body').on('change', '.prod_recommend', function() {
            var str = $(this).attr('name');
            var res = str.split("_");
            if ($(this).is(":checked")) {
                $.ajax({
                    url: base_url + index_page + 'products/backend/result_product/update_status_recommend',
                    type: 'POST',
                    data: {product_id: res[1], id: $(this).val(), strState: "1"}
                });
            } else {
                $.ajax({
                    url: base_url + index_page + 'products/backend/result_product/update_status_recommend',
                    type: 'POST',
                    data: {product_id: res[1], id: $(this).val(), strState: "0"}
                });
            }
        });

        $('body').on('change', '.prod_new', function() {
            var str = $(this).attr('name');
            var res = str.split("_");
            if ($(this).is(":checked")) {
                $.ajax({
                    url: base_url + index_page + 'products/backend/result_product/update_status_new',
                    type: 'POST',
                    data: {product_id: res[1], id: $(this).val(), strState: "1"}
                });
            } else {
                $.ajax({
                    url: base_url + index_page + 'products/backend/result_product/update_status_new',
                    type: 'POST',
                    data: {product_id: res[1], id: $(this).val(), strState: "0"}
                });
            }
        });

        $('body').on('change', '.prod_promotion', function() {
            var str = $(this).attr('name');
            var res = str.split("_");
            if ($(this).is(":checked")) {
                $.ajax({
                    url: base_url + index_page + 'products/backend/result_product/update_status_promotion',
                    type: 'POST',
                    data: {product_id: res[1], id: $(this).val(), strState: "1"}
                });
            } else {
                $.ajax({
                    url: base_url + index_page + 'products/backend/result_product/update_status_promotion',
                    type: 'POST',
                    data: {product_id: res[1], id: $(this).val(), strState: "0"}
                });
            }
        });

        $('body').on('change', '.prod_sale', function() {
            var str = $(this).attr('name');
            var res = str.split("_");
            if ($(this).is(":checked")) {
                $.ajax({
                    url: base_url + index_page + 'products/backend/result_product/update_status_sale',
                    type: 'POST',
                    data: {product_id: res[1], id: $(this).val(), strState: "1"}
                });
            } else {
                $.ajax({
                    url: base_url + index_page + 'products/backend/result_product/update_status_sale',
                    type: 'POST',
                    data: {product_id: res[1], id: $(this).val(), strState: "0"}
                });
            }
        });

        $('body').on('change', '.prod_by_order', function() {
            var str = $(this).attr('name');
            var res = str.split("_");
            if ($(this).is(":checked")) {
                $.ajax({
                    url: base_url + index_page + 'products/backend/result_product/update_status_by_order',
                    type: 'POST',
                    data: {product_id: res[1], id: $(this).val(), strState: "1"}
                });
            } else {
                $.ajax({
                    url: base_url + index_page + 'products/backend/result_product/update_status_by_order',
                    type: 'POST',
                    data: {product_id: res[1], id: $(this).val(), strState: "0"}
                });
            }
        });

        $('.dropdown-toggle').dropdown();
        var oTable = $('#sample_1').dataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            "ajax": {
                "url": base_url + index_page + "contents/backend/result_promotion/listall",
                "type": "POST",
                "data": function(d) {
                    d.txtSearch = $('#txtSearch').val();
                }
            },
            "aoColumns": [
                {"mData": "prod_id", "sClass": "text-center"},
                {"mData": "prod_code"},
                {"mData": "prod_title"},
                {"mData": "prod_cat_name"},
                {"mData": "prod_qty", "sClass": "text-center"},
                {"mData": "prod_warranty", "sClass": "text-center"},
                {"mData": "prod_price_1", "sClass": "text-right"},
                {"mData": "prod_price_5", "sClass": "text-right"},
                {"mData": "prod_recommend", "sClass": "text-center"},
                {"mData": "prod_new", "sClass": "text-center"},
                {"mData": "prod_promotion", "sClass": "text-center"},
                {"mData": "prod_sale", "sClass": "text-center"},
                {"mData": "prod_by_order", "sClass": "text-center"},
                {"mData": "prod_act", "sClass": "text-center"}
            ],
            "aoColumnDefs": [
                {'bSortable': false, 'aTargets': [0, 1, 5, 8, 9, 10, 11, 12, 13]}
            ],
            "scrollX": "100%",
//            "sDom": 'ltipr',
            "oLanguage": {
                "sProcessing": function() {
                    $('#showprocess').html('<i class="fa fa-spinner fa-spin fa-2x"></i>');
                }
            },
            "fnInitComplete": function() {
                $('#showprocess').hide();
            },
            "fnDrawCallback": function(oSettings) {
                $('#showprocess').hide();
            }
        });

        $('#txtSearch').keyup(function() {
            delay(function() {
                oTable.fnDraw();
            }, 500);
        });

        $('#myCat').on('change', function() {
            var selectedValue = $(this).val();
            oTable.fnFilter(selectedValue, 3); //Exact value, column, reg
        });

    });
</script>