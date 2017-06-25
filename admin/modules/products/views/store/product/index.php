<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default borderless">
            <div class="panel-body">
                <div class="pull-left">
                    <a href="<?php echo site_url(); ?>products/add" class="btn btn-primary btn-sm" role="button" title="เพิ่มสินค้า"><li class="fa fa-plus"></li> เพิ่มสินค้า</a>
                    <a href="javascript:;" rel="products/import" class="btn btn-primary btn-sm link_dialog" role="button" title="นำเข้าไฟล์"><li class="fa fa-upload"></li> นำเข้าไฟล์</a>
                </div>  
                <div class="pull-right">
                    <button class="btn btn-default btn-circle" type="button" id="btnRefresh" value="products"><i class="fa fa-refresh"></i>
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
                <table class="table table-striped table-bordered table-hover" id="product_listall"></table>
            </div>
        </div>
    </div>    
</div>
<script type="text/javascript">
    $(function () {
        $('.dropdown-toggle').dropdown();
        var oTable = $('#product_listall').dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": site_url + "products/listall",
                "type": "POST",
                "data": function (d) {
                    d.text_search = $('#text_search').val();
                }
            },
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.9/i18n/Thai.json"
            },
            "aoColumns": [
                {"mData": "id", "title": "", "width": "2%", "sClass": "text-center", "orderable": false, "searchable": false},
                {"mData": "code_no", "title": "Code", "width": "10%", "orderable": false, "searchable": true},
                {"mData": "product_title", "title": "Title", "width": "60%", "orderable": false, "searchable": true},
                {"mData": "unit_price", "title": "Unit Price", "width": "10%", "orderable": false, "searchable": true},
                {"mData": "disabled", "title": "Active", "width": "5%", "sClass": "text-center", "orderable": false, "searchable": false}
            ],
            "sDom": 'ltipr'
        });

        $('#btnSearch').click(function () {
            if ($("#form-search").valid()) {
                oTable.fnDraw();
            }
        });
    });
</script>