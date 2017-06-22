<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Promotion List</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default borderless">
            <div class="panel-body">
                <div class="pull-left">
                    <a href="<?php echo base_url() . index_page(); ?>contents/backend/promotion/add" class="btn btn-primary btn-sm" role="button"><li class="fa fa-plus"></li> Add Promotion</a>
                </div>  
                <div class="pull-right">
                    <button class="btn btn-default btn-circle" type="button" id="btnRefresh" value="contents/backend/promotion"><i class="fa fa-refresh"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                            <tr>
                                <th width="2%">&nbsp;</th>
                                <th width="50%" class="text-center">หัวข้อ</th>
                                <th width="8%" class="text-center">ตำแหน่ง</th>
                                <th width="10%" class="text-center">วันที่เริ่ม</th>
                                <th width="10%" class="text-center">วันที่สิ้นสุด</th>
                                <th width="10%" class="text-center">วันที่สร้าง</th>
                                <th width="6%">สถานะ</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.dropdown-toggle').dropdown();
        $('#sample_1').dataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "All"]],
            "ajax": {
                "url": base_url + index_page + "contents/backend/result_promotion/listall",
                "type": "POST"
            },
            "aoColumns": [
                {"mData": "id", "sClass": "text-center"},
                {"mData": "title"},
                {"mData": "position", "sClass": "text-center"},
                {"mData": "start"},
                {"mData": "finish"},
                {"mData": "created_at"},
                {"mData": "disabled", "sClass": "text-center"}
            ],
            "order": [[4, "asc"]],
        });
    });

</script>