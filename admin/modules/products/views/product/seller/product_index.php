<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">รายการสินค้า</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default borderless">
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="txtSearch" name="txtSearch" placeholder="ค้นหา Produce Code/Product Name/Category">
                        </span>
                    </div>
                    <div class="col-sm-3">
                        <select name="myCat" id="myCat" class="form-control">
                            <option value="">Please select category.</option>
                            <?php foreach ($search_category as $key => $val) { ?>
                                <optgroup label="<?php echo $val ?>">
                                    <?php foreach ($this->Category_model->get_stk_category_sub($key) as $key2 => $val2) { ?>
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
                                <th width="8%" class="text-center">รหัส</th>
                                <th width="35%" class="text-center">ชื่อสินค้า</th>
                                <th width="20%" class="text-center">หมวดหมู่</th>
                                <th width="5%" class="text-center">สต็อก</th>
                                <th width="5%" class="text-center">ประกัน</th>
                                <th width="8%" class="text-center">ราคาปลีก</th>
                                <th width="8%" class="text-center">ราคาส่ง</th>
                                <th width="12%" class="text-center">Active</th>
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
        var oTable = $('#sample_1').dataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
            "ajax": {
                "url": base_url + index_page + "products/backend/result_product/listall",
                "type": "POST",
                "data": function(d) {
                    d.txtSearch = $('#txtSearch').val();
                    d.myCat = $('#myCat').val();
                }
            },
            "aoColumns": [
                {"mData": "product_code"},
                {"mData": "cnt_title"}, {"mData": "cat_name"},
                {"mData": "stock_qty", "sClass": "text-center"},
                {"mData": "warranty", "sClass": "text-center"},
                {"mData": "price_1", "sClass": "text-right"},
                {"mData": "price_5", "sClass": "text-right"},
                {"mData": "prod_active", "sClass": "text-center"}
            ],
            "aoColumnDefs": [
                {'bSortable': false, 'aTargets': [0, 1, 3, 4]}
            ],
            "sDom": 'ltipr',
            "oLanguage": {
                "sProcessing": function() {
                    $('#showprocess').html('<i class="fa fa-spinner fa-spin fa-2x"></i>');
                }
            }, "fnInitComplete": function() {
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
            oTable.fnFilter(selectedValue, 3);
        });
    });

    $('body').on('keypress', '.add_cart', function() {
        var obj = $(this);
        delay(function() {
            $.ajax({
                type: "post",
                url: base_url + index_page + 'products/backend/result_cart/add',
                data: {product_id: obj.attr('id'), qty: obj.val()},
                cache: false,
                success: function(result) {
                    try {
                        var obj = $.parseJSON(result);
                        if (obj.status === true) {
                            $('#cart_msg_popup').tooltip('show');
                            setTimeout(function() {
                                $('#cart_msg_popup').tooltip('hide');
                                window.location.href = document.URL;
                            }, 1000);
                        } else {
                            alert('Add cart false. !!!');
                        }
                    } catch (e) {
                        alert('Exception while request..');
                    }
                },
                error: function(e) {
                    alert('Error while request..');
                }
            });
        }, 500);
    });
</script>