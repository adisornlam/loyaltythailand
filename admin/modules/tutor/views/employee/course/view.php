<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
            <form class="form-horizontal" role="form" id="form-add" method="post">
                <div class="form-group">
                    <label for="code_no" class="col-sm-2 control-label">Code</label>
                    <div class="col-sm-2">
                        <p class="form-control-static"><?php echo $item->code_no; ?></p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">Title</label>
                    <div class="col-sm-5">
                        <p class="form-control-static"><?php echo $item->title; ?></p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="branch_id" class="col-sm-2 control-label">Branch</label>
                    <div class="col-sm-3">
                    <p class="form-control-static"><?php echo $item->branch_title; ?></p>
                   </div>
               </div>
               <div class="form-group">
                <label for="desc" class="col-sm-2 control-label">Desc</label>
                <div class="col-sm-6">
                    <p class="form-control-static"><?php echo $item->desc; ?></p>
                </div>
            </div>
            <div class="form-group">
                <label for="cost" class="col-sm-2 control-label">Cost</label>
                <div class="col-sm-2">
                    <p class="form-control-static"><?php echo $item->cost; ?> บาท/คน</p>
                </div>
            </div>
            <div class="form-group">
                <label for="qty" class="col-sm-2 control-label">Qty</label>
                <div class="col-sm-2">
                    <p class="form-control-static"><?php echo $item->qty; ?> คน</p>
                </div>
            </div>
            <div class="form-group">
                <label for="start_datetime" class="col-sm-2 control-label">Start Date</label>
                <div class="col-sm-2">
                    <p class="form-control-static"><?php echo $item->start_datetime; ?></p>
                </div>
            </div>
            <div class="form-group">
                <label for="end_datetime" class="col-sm-2 control-label">End Date</label>
                <div class="col-sm-2">
                    <p class="form-control-static"><?php echo $item->end_datetime; ?></p>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                        <label>
                            <?php echo form_checkbox('disabled', 1, ($item->disabled==1?true:false)); ?> Enable
                        </label>
                    </div>
                </div>
            </div>
         </form>
     </div> 
 </div>
</div>
</div>