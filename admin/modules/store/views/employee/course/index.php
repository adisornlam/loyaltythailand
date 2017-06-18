            <div class="row">
                <div class="col-xs-12">
                  <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Couse Search abc</h3>
                    </div>
                    <div class="box-body">
                        <form class="form-horizontal" method="post" id="form-search">
                            <div class="form-group">
                                <label for="coursecode" class="col-sm-3 control-label">Title</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="txt_search" name="txt_search">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <button type="button" id="btnSearch" class="btn btn-primary"><i class="fa fa-search"></i> Search </button>
                                </div>
                            </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Couse Listall</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-striped table-bordered table-hover" id="couse_item"></table>
                </div> 
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.dropdown-toggle').dropdown();
            var oTable = $('#couse_item').dataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": site_url + "tutor/course/listall",
                    "type": "POST",
                    "data": function (d) {
                        d.txt_search = $('#txt_search').val();
                    }
                },
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.9/i18n/Thai.json"
                },
                "aoColumns": [
                {"mData": "id","title": "", "width": "2%", "sClass": "text-center","orderable": false, "searchable": false},
                {"mData": "code_no","title": "Code", "width": "8%","orderable": false, "searchable": true},
                {"mData": "title","title": "Title", "width": "20%","orderable": false, "searchable": true},
                {"mData": "cost","title": "Cost", "width": "5%","orderable": false, "searchable": true},
                {"mData": "qty","title": "Qty", "width": "5%", "sClass": "text-center","orderable": false, "searchable": true},
                {"mData": "start_datetime","title": "Start Date", "width": "12%", "sClass": "text-center","orderable": false, "searchable": false},
                {"mData": "end_datetime","title": "End Date", "width": "12%", "sClass": "text-center","orderable": false, "searchable": false},
                {"mData": "branch","title": "Branch", "width": "15%", "sClass": "text-left","orderable": false, "searchable": false},
                {"mData": "manage","title": "", "width": "8%", "sClass": "text-center","orderable": false, "searchable": false}
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