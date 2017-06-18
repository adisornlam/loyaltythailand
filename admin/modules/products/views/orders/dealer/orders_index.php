<link href="<?php echo base_url(); ?>assets/backend/js/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">รายการสั่งซื้อ</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default borderless">
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="txtSearch" name="txtSearch" placeholder="ค้นหา เลขที่สั่งซื้อ">
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <input type="text" name="ord_from" id="ord_from" class="form-control datepicker text-center" value="<?php echo date('Y-m-d'); ?>">
                            <span class="input-group-addon">To</span>
                            <input type="text" name="ord_to" id="ord_to" class="form-control datepicker text-center" value="<?php echo date('Y-m-d'); ?>">                          
                        </div>                       
                    </div>
                    <div class="col-sm-2">
                        <?php echo form_dropdown('order_status', $order_status, null, 'class="form-control" id="order_status"'); ?>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-default btn-circle" type="button" id="btnRefresh" value="products/frontend/order"><i class="fa fa-refresh"></i>
                        </button>
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
                                <th width="2%"></th>
                                <th width="5%">เลขที่สั่งซื้อ</th>
                                <th width="7%">ยอดชำระ</th>
                                <th width="20%">ขนส่ง</th>
                                <th width="20%">ผู้รับเรื่อง</th>
                                <th width="15%">วันที่ซื้อ</th>
                                <th width="10%">สถานะ</th>
                            </tr>
                        </thead>                        
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th class="text-right">ยอดรวม:</th>
                                <th width="10%"></th>
                                <th colspan="4"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/backend/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $(function() {
        //Date Pickers
        $('.datepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        });
        $('.dropdown-toggle').dropdown();
        var oTable = $('#sample_1').dataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
            "ajax": {
                "url": base_url + index_page + "products/backend/result_order/listall",
                "type": "POST",
                "data": function(d) {
                    d.ord_from = $('#ord_from').val();
                    d.ord_to = $('#ord_to').val();
                    d.order_status = $('#order_status').val();
                }
            },
            "order": [[5, "desc"]],
            "aoColumns": [
                {"mData": "order_id"},
                {"mData": "orders_code"},
                {"mData": "sum_price", "sClass": "text-right"},
                {"mData": "shipping"},
                {"mData": "seller_id"},
                {"mData": "created_at", "sClass": "text-center", "sType": "date"},
                {"mData": "status", "sClass": "text-center"}
            ],
            "aoColumnDefs": [
                {'bSortable': false, 'aTargets': [0, 1]}
            ],
            "sDom": 'ltipr',
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api(), data;
                var colm = 2;
                var intVal = function(i) {
                    return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                };
                data = api.column(colm).data();
                total = data.length ?
                        data.reduce(function(a, b) {
                            return (intVal(a) + intVal(b)).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
                        }) :
                        0;
                data = api.column(colm, {page: 'current'}).data();
                pageTotal = data.length ?
                        data.reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }) :
                        0;
                $(api.column(colm).footer()).html(total);
            },
            "oLanguage": {
                "sProcessing": function() {
                    $('#showprocess').html('<i class="fa fa-spinner fa-spin fa-2x"></i>');
                }
            },
            "fnInitComplete": function() {
                $('#showprocess').hide();
            },
            "fnDrawCallback": function(oSettings) {
                $('#showprocess').hide();
            }
        });
        $('#txtSearch').keyup(function() {
            oTable.fnFilter($(this).val());
        });
        $('#ord_from').on('keyup change', function() {
            delay(function() {
                oTable.fnDraw();
            }, 500);
        });
        $('#ord_to').on('keyup change', function() {
            delay(function() {
                oTable.fnDraw();
            }, 500);
        });
        $('#order_status').on('change', function() {
            if ($(this).val() !== '') {
                delay(function() {
                    oTable.fnDraw();
                }, 500);
            } else {
                oTable.fnDraw();
            }
        });
    });
    $('body').on('click', '.btnPayment', function() {
        load_page();
        var data = {
            url: 'products/backend/order/transfer_add/' + $(this).attr('id'),
            title: 'แจ้งชำระเงิน'
        };
        genModal(data);
    });
</script>