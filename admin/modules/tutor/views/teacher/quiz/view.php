<div class="row">
  <div class="col-md-12 col-xs-12">
    <!-- Horizontal Form -->
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title">Quiz View</h3>
      </div>
      <!-- form start -->
      <form class="form-horizontal">
        <div class="box-body">
          <div class="form-group">
            <label class="col-sm-1 control-label">Branch</label>
            <p class="form-control-static"><?php echo $item->branch_title; ?></p>
          </div>
          <div class="form-group">
            <label class="col-sm-1 control-label">Course</label>
            <p class="form-control-static"><?php echo $item->course_title; ?></p>
          </div>
          <div class="form-group">
            <label class="col-sm-1 control-label">Times</label>
            <p class="form-control-static"><?php echo $item->times; ?></p>
          </div>
        </div>
        <div class="box-body no-padding">
          <table class="table table-striped">
            <thead>
              <th width="2%">No.</th>
              <th width="10%">Code</th>
              <th width="50%">Full Name</th>
              <th width="10%">Score</th>
            </thead>
            <tbody>
              <?php 
              $i=1;
              foreach($desc_result as $item2){ ?>
              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $item2->code_member; ?></td>
                <td><?php echo $item2->first_name.' '.$item2->last_name; ?></td>
                <td><?php echo $item2->score; ?></td>
              </tr>
              <?php $i++; } ?>
            </tbody>
          </table>
        </div>
      </form>
    </div>
    <!-- /.box -->
  </div>
</div>