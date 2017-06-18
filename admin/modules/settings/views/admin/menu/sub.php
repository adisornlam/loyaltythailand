            <div class="row">
                <div class="col-xs-12">
                  <div class="box">
                    <div class="box-header">
                    <h3 class="box-title">Sub Menu Search</h3>
                    </div>
                    <div class="box-body">
                        <form class="form-horizontal" method="post" id="form-search">
                            <div class="form-group">
                                <label for="coursecode" class="col-sm-3 control-label">Title</label>
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
                    <h3 class="box-title">Sub Menu Listall</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-striped table-bordered table-hover" id="menu_item"></table>
                </div> 
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.dropdown-toggle').dropdown();
            var oTable = $('#menu_item').dataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": site_url + "settings/menu/listall/<?php echo $this->uri->segment(4); ?>",
                    "type": "POST"
                },
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.9/i18n/Thai.json"
                },
                "aoColumns": [
                {"mData": "id","title": "", "width": "2%", "sClass": "text-center","orderable": false, "searchable": false},
                {"mData": "title","title": "Title", "width": "20%","orderable": false, "searchable": false},
                {"mData": "type","title": "Type", "width": "10%","orderable": false, "searchable": false},
                {"mData": "description","title": "Desc", "width": "20%", "sClass": "text-center","orderable": false, "searchable": false},
                {"mData": "url","title": "Url", "width": "20%", "sClass": "text-center","orderable": false, "searchable": false},
                {"mData": "icon","title": "Icon", "width": "10%", "sClass": "text-center","orderable": false, "searchable": false},
                {"mData": "modules","title": "Module", "width": "15%", "sClass": "text-left","orderable": false, "searchable": false},
                {"mData": "weight","title": "Weight", "width": "15%", "sClass": "text-left","orderable": false, "searchable": false}
                ],
                "sDom": 'ltipr'
            });
        });
    </script>