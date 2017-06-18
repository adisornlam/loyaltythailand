<form class="form-horizontal" role="form" id="form-add" method="post">    
    <div id="showerror"></div>
    <div class="form-group">
        <label for="cat_code" class="col-sm-3 control-label">Category Parent</label>
        <div class="col-sm-9">
            <select name="new_cat_id" class="form-control">
                <option value="" selected="selected">Please Select Category.</option>
                <?php foreach ($result as $key => $value) { ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                    <?php
                    $query1 = $this->db->query("SELECT * FROM `categories` WHERE EXISTS ( SELECT 1 FROM `category_hierarchy` WHERE categories.cat_id = category_hierarchy.cath_category_id AND `category_hierarchy`.`cath_category_parent_id` = " . $key . ") AND `cat_type` = 'product' ORDER BY `cat_weight` ASC");
                    if ($query1->num_rows() > 0) {
                        foreach ($query1->result() as $item1) {
                            ?>
                            <option value="<?php echo $item1->cat_id; ?>">&nbsp;&nbsp;&nbsp;- <?php echo $item1->cat_title; ?></option>
                            <?php
                            $query2 = $this->db->query("SELECT * FROM `categories` WHERE EXISTS ( SELECT 1 FROM `category_hierarchy` WHERE categories.cat_id = category_hierarchy.cath_category_id AND `category_hierarchy`.`cath_category_parent_id` = " . $item1->cat_id . ") AND `cat_type` = 'product' ORDER BY `cat_weight` ASC");
                            if ($query2->num_rows() > 0) {
                                foreach ($query2->result() as $item2) {
                                    ?>
                                    <option value="<?php echo $item2->cat_id; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&RightTriangle; <?php echo $item2->cat_title; ?></option>
                                    <?php
                                }
                            }
                            ?>
                            <?php
                        }
                    }
                    ?>
                <?php } ?>
            </select>
        </div>
    </div>    
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <button type="button" id="btnDialogSave" class="btn btn-default">Save</button>
        </div>
    </div>
    <input type="hidden" value="<?php echo $this->uri->segment(5); ?>" name="cat_id" />
</form>
<script type="text/javascript">
    $('#btnDialogSave').click(function() {
        $(this).attr('disabled', 'disabled');
        loading_button();
        var data = {
            url: 'products/backend/result_category/move',
            v: $('#form-add, select input:not(#btnDialogSave)').serializeArray()
        };
        saveData(data);
    });
</script>