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
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                            <tr>
                                <th width="2%"></th>
                                <th width="8%">Code</th>
                                <th width="40%">Name</th>
                                <th width="20%">Category</th>
                                <th width="5%">Qty</th>
                                <th width="10%">Price 1</th>
                                <th width="10%">Price 5</th>
                                <th width="8%">Active</th>
                            </tr>
                        </thead>                        
                        <tbody>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th width="2%"></th>
                                <th width="8%">Code</th>
                                <th width="40%">Name</th>
                                <th width="20%">Category</th>
                                <th width="5%">Qty</th>
                                <th width="10%">Price 1</th>
                                <th width="10%">Price 5</th>
                                <th width="8%">Active</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        $('.dropdown-toggle').dropdown();
        $('#sample_1').dataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
            "ajax": {
                "url": base_url + index_page + "products/backend/result_product/listall",
                "type": "POST"
            },
            "aoColumns": [
                {"mData": "product_id", "sClass": "text-center"},
                {"mData": "product_code"},
                {"mData": "cnt_title"},
                {"mData": "cat_name"},
                {"mData": "stock_qty", "sClass": "text-center"},
                {"mData": "price_1", "sClass": "text-right"},
                {"mData": "price_5", "sClass": "text-right"},
                {"mData": "prod_active", "sClass": "text-center"}
            ],
            "aoColumnDefs": [
                {'bSortable': false, 'aTargets': [0, 1, 4, 7]}
            ]
        });

    });
</script>