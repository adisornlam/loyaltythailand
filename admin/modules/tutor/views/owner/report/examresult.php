<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
            <h3 class="box-title">Student Search</h3>
        </div>
        <div class="box-body">
            <form class="form-horizontal" method="post" id="form-search" action="<?php echo base_url().index_page(); ?>tutor/report/examresult_export">
                <div class="form-group">
                    <label for="branch_id" class="col-sm-3 control-label">Branch</label>
                    <div class="col-sm-3">
                     <?php
                     echo form_dropdown('branch_id', $ddl_branch, null, 'class="form-control" id="branch_id"');
                     ?>
                 </div>
             </div>
             <div class="form-group">
                 <label for="course_id" class="col-sm-3 control-label">Course</label>
                 <div class="col-sm-6">
                    <select name="course_id" id="course_id" class="form-control required">
                        <option selected="selected" value=""></option>                            
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="button" id="btnSearch" class="btn btn-primary"><i class="fa fa-search"></i> Search </button>
                    <button type="submit" name="btnExport" class="btn btn-success" value="excel"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Excel</button>
                    <button type="submit" name="btnExport" class="btn btn-warning" value="pdf"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Export PDF</button>
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
            <h3 class="box-title">Examresult Listall</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-striped table-bordered table-hover" id="examresult_listall"></table>
        </div> 
    </div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#branch_id').change(function () {
            $.get(site_url + 'common/get_course_ddl/', {branch_id: $(this).val()},
                function (data) {
                    var as = JSON.parse(data);
                    if (as) {
                        var course_id = $('#course_id');
                        course_id.empty();
                        $.each(as, function (index, element) {
                            course_id.append("<option value='" + index + "'>" + element + "</option>");
                        });
                    }
                });
        });
        var oTable = $('#examresult_listall').dataTable({
            "processing": true,
            "serverSide": true,
            "deferLoading": 0,
            "paging": false,
            "pageLength": 5,
            "ajax": {
                "url": site_url + "tutor/report/examresult_listall",
                "type": "POST",
                "data": function (d) {
                    d.course_id = $('#course_id').val();
                    d.branch_id = $('#branch_id').val();
                }
            },
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.9/i18n/Thai.json"
            },
            "aoColumns": [
            {"mData": "code_member","title": "Code", "width": "8%","orderable": false, "searchable": false},
            {"mData": "full_name","title": "Full Name", "width": "50%","orderable": false, "searchable": false},
            {"mData": "total_score","title": "Score", "width": "10%","orderable": true, "searchable": false}
            ],
            "sDom": 'ltipr',
            "order": [[ 2, "desc" ]]
        });

        $('#btnSearch').click(function () {
            if ($("#form-search").valid()) {
                oTable.fnDraw();
            }
        });
    });
</script>