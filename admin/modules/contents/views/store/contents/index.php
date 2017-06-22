<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Content Search</h3>
            </div>
            <div class="box-body">
                <form class="form-horizontal" method="post" id="form-search" action="<?php echo base_url().index_page(); ?>tutor/student/export/excel">
                    <div class="form-group">
                        <label for="text_search" class="col-sm-3 control-label">Title</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="text_search" name="text_search">
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
                        <h3 class="box-title">Content Listall</h3>
                    </div>
                    <div class="col-lg-6">
                        <div class="pull-right">
                            <a href="<?php echo site_url(); ?>contents/add" class="btn btn-primary" role="button" title="Add Content"><li class="fa fa-plus"></li> Add Content</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-striped table-bordered table-hover" id="content_listall"></table>
            </div> 
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        $('.dropdown-toggle').dropdown();
        var oTable = $('#content_listall').dataTable({
            "processing": true,
            "serverSide": true,
            // "deferLoading": 0,
            "ajax": {
                "url": site_url + "contents/listall",
                "type": "POST",
                "data": function (d) {
                    d.text_search = $('#text_search').val();
                }
            },
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.9/i18n/Thai.json"
            },
            "aoColumns": [
            {"mData": "id","title": "", "width": "2%", "sClass": "text-center","orderable": false, "searchable": false},
            {"mData": "title","title": "Title", "width": "60%","orderable": false, "searchable": true},
            {"mData": "created_at","title": "Created Date", "width": "10%","orderable": false, "searchable": true},
            {"mData": "disabled","title": "Active", "width": "5%", "sClass": "text-center","orderable": false, "searchable": false}
            ],
            "sDom": 'ltipr'
        });

        $('#btnSearch').click(function () {
            if ($("#form-search").valid()) {
                oTable.fnDraw();
            }
        });

        $('#myModal').on('hidden.bs.modal', function () {
            oTable.api().ajax.reload();
        });
    });
</script>