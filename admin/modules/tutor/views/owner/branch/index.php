            <div class="row">
                <div class="col-xs-12">
                  <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Branch Search</h3>
                    </div>
                    <div class="box-body">
                        <form class="form-horizontal" method="post" id="form-search">
                            <div class="form-group">
                                <label for="coursecode" class="col-sm-3 control-label">Name</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="search_text" name="search_text">
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
                    <div class="row">
                        <div class="col-lg-6">
                            <h3 class="box-title">Branch Listall</h3>
                        </div>
                        <div class="col-lg-6">
                            <div class="pull-right">
                                <a href="javascript:;" rel="tutor/branch/add" class="link_dialog btn btn-primary" role="button" title="Add Branch"><li class="fa fa-plus"></li> Add Branch</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-striped table-bordered table-hover" id="branch_listall"></table>
                </div> 
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.dropdown-toggle').dropdown();
            var oTable = $('#branch_listall').dataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": site_url + "tutor/branch/listall",
                    "type": "POST",
                    "data": function (d) {
                        d.search_text = $('#search_text').val();
                    }
                },
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.9/i18n/Thai.json"
                },
                "aoColumns": [
                {"mData": "id","title": "", "width": "2%", "sClass": "text-center","orderable": false, "searchable": false},
                {"mData": "code_no","title": "Code", "width": "5%", "sClass": "text-center","orderable": false, "searchable": true},
                {"mData": "title","title": "Title", "width": "50%","orderable": false, "searchable": true},
                {"mData": "disabled","title": "Active", "width": "8%", "sClass": "text-center","orderable": false, "searchable": true},
                {"mData": "manage","title": "", "width": "12%", "sClass": "text-center","orderable": false, "searchable": true}
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