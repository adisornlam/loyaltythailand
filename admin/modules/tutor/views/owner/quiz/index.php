<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
            <h3 class="box-title">Quiz Search</h3>
        </div>
        <div class="box-body">
            <form class="form-horizontal" method="post" id="form-search" action="<?php echo base_url().index_page(); ?>tutor/quiz/viewscore">
                <div class="form-group">
                    <label for="branch_id" class="col-sm-3 control-label">Branch</label>
                    <div class="col-sm-3">
                       <?php
                       echo form_dropdown('branch_id', $ddl_branch, null, 'class="form-control required" id="branch_id"');
                       ?>
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
                    <h3 class="box-title">Quiz Listall</h3>
                </div>
                <div class="col-lg-6">
                    <div class="pull-right">
                        <a href="<?php echo base_url().index_page(); ?>tutor/quiz/add" class="btn btn-primary" role="button" title="Add Quiz"><li class="fa fa-plus"></li> บันทึกคะแนนสอบ</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-striped table-bordered table-hover" id="student_listall"></table>
        </div> 
    </div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var oTable = $('#student_listall').dataTable({
            "processing": true,
            "serverSide": true,
            "deferLoading": 0,
            "ajax": {
                "url": site_url + "tutor/quiz/listall",
                "type": "POST",
                "data": function (d) {
                    d.branch_id = $('#branch_id').val();
                }
            },
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.9/i18n/Thai.json"
            },
            "aoColumns": [
            {"mData": "code_no","title": "Code", "width": "8%","orderable": false, "searchable": true},
            {"mData": "title","title": "Course", "width": "60%","orderable": false, "searchable": true},
            {"mData": "manage","title": "", "width": "15%", "sClass": "text-center","orderable": false, "searchable": false}
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