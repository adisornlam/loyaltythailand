<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default borderless">
            <div class="panel-body">
                <div class="pull-left">
                    <a href="javascript:;" rel="products/category/add" class="btn btn-primary btn-sm link_dialog" role="button" title="เพิ่มหมวดหมู่"><li class="fa fa-plus"></li> เพิ่มหมวดหมู่</a>
                </div>  
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover" id="category_listall"></table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('.dropdown-toggle').dropdown();
        var oTable = $('#category_listall').dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": site_url + "products/category/listall",
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
                {"mData": "title", "title": "Title", "width": "40%", "orderable": false, "searchable": true},
                {"mData": "description", "title": "Description", "width": "30%", "orderable": false, "searchable": true},
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