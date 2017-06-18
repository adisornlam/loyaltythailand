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
  </div>
</form>