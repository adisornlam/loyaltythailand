<div class="row">
  <div class="col-md-12 col-xs-12">
    <!-- Horizontal Form -->
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Student Comment</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal" name="form-add" id="form-add" method="post">
        <div class="box-body">
          <div class="form-group">
            <label for="code_member" class="col-sm-3 control-label">เนื้อหาที่ได้เรียน</label>
            <div class="col-sm-9"><p class="form-control-static"><?php echo $item->private_content; ?></p>
            </div>
          </div>
          <div class="form-group">
            <label for="first_name" class="col-sm-3 control-label">ความรู้และทักษะที่ได้</label>
            <div class="col-sm-9">
              <p class="form-control-static"><?php echo $item->private_skill; ?></p>
            </div>
          </div>
          <div class="form-group">
            <label for="first_name" class="col-sm-3 control-label">เสนอแนะนักเรียน</label>
            <div class="col-sm-9">
              <p class="form-control-static"><?php echo $item->private_recomment; ?></p>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
              <a class="btn btn-default" href="<?php echo site_url(); ?>tutor/student/add_comment/<?php echo $item->id; ?>" role="button">Add Comment</a>
            </div>
          </div>
        </div>
      </form>
    </div>
    <!-- /.box -->
  </div>
</div>