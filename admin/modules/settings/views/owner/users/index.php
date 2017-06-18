            <div class="row">
                <div class="col-xs-12">
                  <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">User Search</h3>
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
                            <h3 class="box-title">User Listall</h3>
                        </div>
                        <div class="col-lg-6">
                            <div class="pull-right">
                                <a href="javascript:;" class="btn btn-primary link_dialog" role="button" rel="settings/users/users_add" title="Add User"><li class="fa fa-plus"></li> Add User</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-striped table-bordered table-hover" id="uers_item"></table>
                </div> 
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.dropdown-toggle').dropdown();
            var oTable = $('#uers_item').dataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": base_url + index_page + "settings/users/users_listall",
                    "type": "POST"
                },
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.9/i18n/Thai.json"
                },
                "aoColumns": [
                {"mData": "id","title": "", "width": "2%", "sClass": "text-center","orderable": false, "searchable": false},
                {"mData": "full_name","title": "Full Name", "width": "15%","orderable": false, "searchable": true},
                {"mData": "email","title": "Email", "width": "20%","orderable": false, "searchable": true},
                {"mData": "group_name","title": "Group", "width": "8%", "sClass": "text-center","orderable": false, "searchable": true},
                {"mData": "branch_title","title": "Branch", "width": "20%", "sClass": "text-left","orderable": false, "searchable": false},
                {"mData": "last_login","title": "Last Login", "width": "12%", "sClass": "text-center","orderable": false, "searchable": false},
                {"mData": "active","title": "Active", "width": "5%", "sClass": "text-center","orderable": false, "searchable": false}
                ],
                "sDom": 'ltipr'
            });
        });
    </script>