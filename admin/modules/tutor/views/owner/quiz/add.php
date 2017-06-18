<div class="row">
  <div class="col-md-12 col-xs-12">
    <!-- Horizontal Form -->
    <div class="box box-info">
      <!-- form start -->
      <form class="form-horizontal" name="form-add" id="form-add" method="post">
        <div class="box-body">
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
           <div class="col-sm-3">
            <select name="course_id" id="course_id" class="form-control required">
              <option selected="selected" value=""></option>                            
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="course_sub_id" class="col-sm-3 control-label">Sub Course</label>
          <div class="col-sm-3">
            <select name="course_sub_id" id="course_sub_id" class="form-control required">
              <option selected="selected" value=""></option>                            
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="quiz_time" class="col-sm-3 control-label">ครั้งที่</label>
          <div class="col-sm-1">
           <?php
           echo form_dropdown('quiz_time', array(1=>1,2=>2), null, 'class="form-control required" id="quiz_time"');
           ?>
         </div>
       </div>
       <div class="form-group">
        <label for="full_score" class="col-sm-3 control-label">คะแนนเต็ม</label>
        <div class="col-sm-1">
          <?php echo form_input('full_score', NULL, 'class="form-control required" id="full_score"'); ?>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
          <button type="button" id="btnSearch" class="btn btn-primary"><i class="fa fa-random"></i> Load Student </button>
        </div>
      </div>
    </div>
<!--   </form>
  <form class="form-horizontal" name="form-add" id="form-add" method="post"> -->
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <div class="row">
              <div class="col-lg-6">
                <h3 class="box-title">Student Listall</h3>
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
    <!-- /.box-body -->
    <div class="box-footer">
      <div class="col-sm-offset-3 col-sm-9">
        <button type="button" class="btn btn-info pull-left" id="btnSave"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
      </div>
    </div>
    <!-- /.box-footer -->
  </form>
</div>
<!-- /.box -->
</div>
</div>
<script type="text/javascript">
  $(function(){
    $('#branch_id').change(function () {
      $.get(site_url + 'common/get_course_ddl/', {branch_id: $(this).val()},
        function (data) {
          var as = JSON.parse(data);
          if (as) {
            var course_id = $('#course_id');
            course_id.empty();
            course_id.append('<option value="">Please select</option>');
            $.each(as, function (index, element) {
              course_id.append("<option value='" + index + "'>" + element + "</option>");
            });
          }
        });
    });

    $('#course_id').change(function () {
      $.get(site_url + 'common/get_course_sub_ddl/', {course_id: $(this).val()},
        function (data) {
          var as = JSON.parse(data);
          if (as) {
            var course_sub_id = $('#course_sub_id');
            course_sub_id.empty();
            course_sub_id.append('<option value="">Please select</option>');
            $.each(as, function (index, element) {
              course_sub_id.append("<option value='" + index + "'>" + element + "</option>");
            });
          }
        });
    });

    var oTable = $('#student_listall').dataTable({
      "processing": true,
      "serverSide": true,
      "deferLoading": 0,
      "paging":false,
      "info":false,
      "ajax": {
        "url": site_url + "tutor/quiz/load_student_listall",
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
      {"mData": "code_member","title": "Code", "width": "10%","orderable": false, "searchable": false},
      {"mData": "full_name","title": "Full Name", "width": "40%","orderable": false, "searchable": false},
      {"mData": "score_input","title": "Score", "width": "10%", "sClass": "text-center","orderable": false, "searchable": false}
      ],
      "sDom": 'ltipr'
    });

    $('#btnSearch').click(function () {
      if ($("#form-add").valid()) {
        oTable.fnDraw();
      }
    });

    var options = {
      url: site_url + 'tutor/quiz/save/add',
      // data : {quiz_time:$('#form-search #quiz_time').val(), full_score:$('#form-search #full_score').val()},
      success: showResponse
    };
    $('#btnSave').click(function () {
      if ($("#form-add").valid()) {
        $(this).addClass('disabled');
        $('#form-add').ajaxSubmit(options);
        return false;
      }
    });
  });

  function showResponse(response, statusText, xhr, $form) {
    var as = JSON.parse(response);
    if (as.error.status === false) {
      $('#btnSave').removeClass('disabled');
      alert(as.error.message_info);
    }else{
      window.location.href = site_url+as.error.redirect;
    }
  }
</script>