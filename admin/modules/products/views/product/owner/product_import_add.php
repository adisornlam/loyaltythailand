<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">รายการสินค้าไฟล์นำเข้า</h1>
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
        <div class="panel panel-default">
            <div class="panel-body">
                <form class="form-horizontal" role="form" id="form-add" method="post">
                    <div class="table-responsive">
                        <span id="showprocess"></span>
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                                <tr>
                                    <th width="2%" class="text-center"></th>
                                    <th width="8%" class="text-center">รหัสสินค้า</th>
                                    <th width="35%" class="text-center">ชื่อสินค้า</th>
                                    <th width="20%" class="text-center">หมวดหมู่</th>
                                    <th width="5%" class="text-center">สต็อก</th>
                                    <th width="8%" class="text-center">ราคา</th>
                                </tr>
                            </thead>                        
                            <tbody>
                            </tbody>                        
                        </table>
                    </div>                    
                    <div class="col-lg-12">
                        <div class="panel-body">
                            <div class="text-center">
                                <button type="button" id="btnSave" class="btn btn-primary btn-lg"> บันทึกการเปลี่ยนแปลง </button>                 
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>    
</div>
<script src="<?php echo base_url(); ?>assets/backend/js/jquery.form.js"></script>
<script type="text/javascript">
    $(function () {
        $('#sample_1').dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": base_url + index_page + "products/backend/result_product/product_import_listall",
                "type": "POST"
            },
            "aoColumns": [
                {"mData": "id"},
                {"mData": "product_code"},
                {"mData": "title"},
                {"mData": "cat_name"},
                {"mData": "stock", "sClass": "text-center"},
                {"mData": "price", "sClass": "text-right"}
            ],
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

        var options = {
            url: base_url + index_page + 'products/backend/result_product/add_import',
            success: showResponse
        };
        $('#btnSave').click(function () {
            $(this).attr('disabled', 'disabled');
            $(this).after('&nbsp;<span id="spinner_loading"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Loading...</span>');
            $('#form-add').ajaxSubmit(options);
            return false;
        });
    });

    function showResponse(response, statusText, xhr, $form) {
        var as = JSON.parse(response);
        window.location.href = base_url + index_page + as.error.redirect;
    }
</script>