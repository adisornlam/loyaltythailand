<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">หมวดหมู่สินค้า</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <ul class="breadcrumb">
            <?php foreach ($breadcrumbs as $key => $val) { ?>
                <?php if ($val === reset($breadcrumbs)) { ?>
                    <li><a href="<?php echo base_url() . index_page() . $val; ?>"><i class="icon-home"></i> <?php echo $key; ?></a></li>
                <?php } elseif ($val === end($breadcrumbs)) { ?>
                    <li class="active"><?php echo $key; ?></li>
                <?php } else { ?>
                    <li><a href="<?php echo base_url() . index_page() . $val; ?>"> <?php echo $key; ?></a></li>
                <?php } ?>
            <?php } ?>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default borderless">
            <div class="panel-body">
                <div class="pull-left">
                    <a href="javascript:;" rel="products/backend/category/add/<?php echo $this->uri->segment(5); ?>" class="btn btn-primary btn-sm link_dialog" role="button" title="เพิ่มหมวดหมู่"><li class="fa fa-plus"></li> เพิ่มหมวดหมู่</a>
                </div>  
                <div class="pull-right">
                    <button class="btn btn-default btn-circle" type="button" id="btnRefresh" value="products/backend/category"><i class="fa fa-refresh"></i>
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
                                <th width="20%">หัวข้อ</th>
                                <th width="40%">คำอธิบาย</th>
                                <th width="5%">ลำดับ</th>
                                <th width="10%">สถานะ</th>
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
    $(document).ready(function () {
        $('.dropdown-toggle').dropdown();
        var url = base_url + index_page + "products/backend/result_category/listall/<?php echo $this->uri->segment(5); ?>";
        $('#sample_1').dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": url,
                "type": "POST"
            },
            "aoColumns": [
                {"mData": "id", "sClass": "text-center"},
                {"mData": "title"},
                {"mData": "description"},
                {"mData": "weight", "sClass": "text-center"},
                {"mData": "disabled", "sClass": "text-center"}
            ]
        });
    });

</script>