<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">รายการสินค้า</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default borderless">
            <div class="panel-body">
                <div class="pull-left">
                    <a href="<?php echo base_url(); ?>products/backend/product/add" class="btn btn-primary btn-sm" role="button" title="เพิ่มสินค้า"><li class="fa fa-plus"></li> เพิ่มสินค้า</a>
                    <a href="javascript:;" rel="products/backend/product/import" class="btn btn-primary btn-sm link_dialog" role="button" title="นำเข้าไฟล์"><li class="fa fa-upload"></li> นำเข้าไฟล์</a>
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
                        </span>
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
                                <th width="2%" class="text-center"></th>
                                <th width="8%" class="text-center">รหัส</th>
                                <th width="35%" class="text-center">ชื่อสินค้า</th>
                                <th width="20%" class="text-center">หมวดหมู่</th>
                                <th width="5%" class="text-center">สต็อก</th>
                                <th width="8%" class="text-center">ราคา</th>
                                <th width="12%" class="text-center">สถานะ</th>
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
    $(function () {
        var oTable = $('#sample_1').dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": base_url + index_page + "products/backend/result_product/listall",
                "type": "POST",
                "data": function (d) {
                    d.txtSearch = $('#txtSearch').val();
                }
            },
            "aoColumns": [
                {"mData": "id"},
                {"mData": "prod_code"},
                {"mData": "title"},
                {"mData": "cat_name"},
                {"mData": "stock", "sClass": "text-center"},
                {"mData": "price", "sClass": "text-right"},
                {"mData": "disabled", "sClass": "text-center"}
            ],
            "aoColumnDefs": [
                {'bSortable': false, 'aTargets': [0, 1, 3, 4]}
            ],
            "sDom": 'ltipr',
            "oLanguage": {
                "sProcessing": function () {
                    $('#showprocess').html('<i class="fa fa-spinner fa-spin fa-2x"></i>');
                }
            }, "fnInitComplete": function () {
                $('#showprocess').hide();
            },
            "fnDrawCallback": function (oSettings) {
                $('#showprocess').hide();
            }
        });
        $('#txtSearch').keyup(function () {
            delay(function () {
                oTable.fnDraw();
            }, 500);
        });
    });
</script>