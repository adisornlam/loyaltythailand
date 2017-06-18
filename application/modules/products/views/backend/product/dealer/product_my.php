<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">My Product</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default borderless">
            <div class="panel-body">
                <div class="pull-left">
                    <a href="javascript:;" id="btnAdd" class="btn btn-primary btn-sm" role="button"><li class="fa fa-plus"></li> Add Product</a>
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
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                            <tr>
                                <th width="8%" class="text-center">Code</th>
                                <th width="40%" class="text-center">Name</th>
                                <th width="20%" class="text-center">Category</th>
                                <th width="5%" class="text-center">Stock</th>
                                <th width="5%" class="text-center">Price</th>
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
        $('.dropdown-toggle').dropdown();
        var oTable = $('#sample_1').dataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
            "ajax": {
                "url": base_url + index_page + "products/backend/result_product/product_my_listall",
                "type": "POST"
            },
            "aoColumns": [
                {"mData": "product_code"},
                {"mData": "cnt_title"},
                {"mData": "cat_name"},
                {"mData": "stock", "sClass": "text-center"},
                {"mData": "price_5", "sClass": "text-right"}
            ],
            "aoColumnDefs": [
                {'bSortable': false, 'aTargets': [0, 1]}
            ],
            "sDom": 'ltipr'
        });

        $('#txtSearch').keyup(function() {
            oTable.fnFilter($(this).val());
        });

        $('#myCat').on('change', function() {
            var selectedValue = $(this).val();
            oTable.fnFilter(selectedValue, 3); //Exact value, column, reg
        });

    });
</script>