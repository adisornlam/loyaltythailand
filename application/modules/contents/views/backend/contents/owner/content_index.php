<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?php echo $title; ?></h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default borderless">
            <div class="panel-body">
                <div class="pull-left">
                    <a href="<?php echo base_url() . index_page(); ?>contents/backend/content/add" class="btn btn-primary btn-sm" role="button"><li class="fa fa-plus"></li> เพิ่มเนื้อหา</a>
                </div>  
                <div class="pull-right">
                    <button class="btn btn-default btn-circle" type="button" id="btnRefresh" value="contents/backend/content"><i class="fa fa-refresh"></i>
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
                                <th width="2%">&nbsp;</th>
                                <th width="40%">หัวข้อ</th>
                                <th width="20%">หมวดหมู่</th>
                                <th width="15%">วันที่สร้าง</th>
                                <th width="15%">วันที่แก้ไข</th>
                                <th width="6%">สถานะ</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
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
                "url": base_url + index_page + "contents/backend/result_content/listall",
                "type": "POST"
            },
            "aoColumns": [
                {"mData": "id", "sClass": "text-center"},
                {"mData": "title"},
                {"mData": "group_title"},                
                {"mData": "created_at"},
                {"mData": "updated_at"},
                {"mData": "disabled", "sClass": "text-center"}
            ]
        });
    });
</script>