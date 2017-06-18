<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Product Edit</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <ul class="breadcrumb">
            <?php foreach ($breadcrumbs as $key => $val) { ?>
                <?php if ($val === reset($breadcrumbs)) { ?>
                    <li><a href="<?php echo base_url() . index_page() . $val; ?>"><i class="icon-home"></i> <?php echo $key; ?></a></li>
                <?php } elseif ($val === end($breadcrumbs)) { ?>
                    <li class="active"><?php echo $key; ?></li>
                <?php } else { ?>
                    <li><a href="<?php echo base_url() . index_page() . $val; ?>"> <?php echo $key; ?></a></li>
                <?php } ?>
            <?php } ?>
        </ul>
    </div>
</div>
<form class="form-horizontal" role="form" id="form-add" method="post">    
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Edit Product</strong> <?php echo $item->product_name; ?>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab_info" data-toggle="tab">Info</a>
                        </li>
                        <li>
                            <a href="#tab_description" data-toggle="tab">Description</a>
                        </li> 
                        <li>
                            <a href="#tab_option" data-toggle="tab">Option</a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab_info">
                            <div id="showerror"></div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="cat_id" class="col-sm-2 control-label">Category</label>
                                    <div class="col-sm-4">
                                        <?php
                                        echo form_dropdown('category_id[]', $category, $item->category_sub_1, 'class="form-control" id="category_id"');
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group" style="display: none;">
                                    <label for="sub1" class="col-sm-2 control-label">&nbsp;</label>
                                    <div class="col-sm-4">
                                        <select name="category_id[]" id="sub1" class="form-control">
                                            <option selected="selected" value=""></option>                            
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" style="display: none;">
                                    <label for="sub2" class="col-sm-2 control-label">&nbsp;</label>
                                    <div class="col-sm-4">
                                        <select name="category_id[]" id="sub2" class="form-control">
                                            <option selected="selected" value=""></option>                            
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="product_code" class="col-sm-2 control-label">Product Code</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="product_code" name="product_code" value="<?php echo trim($item->product_code); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="product_name" class="col-sm-2 control-label">Product Name</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo $item->product_name; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="qty" class="col-sm-2 control-label">Qty</label>
                                    <div class="col-sm-1">
                                        <input type="text" class="form-control" id="qty" name="qty" value="<?php echo $item->qty; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="qty" class="col-sm-2 control-label">Price 1</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="qty" name="qty" value="<?php echo $item->price_1; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="qty" class="col-sm-2 control-label">Price 5</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="qty" name="qty" value="<?php echo $item->price_5; ?>">
                                    </div>
                                </div>                            
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="cat_disabled" value="active"> Active
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div class="tab-pane fade" id="tab_description">
                            <div class="panel-body">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <textarea class="form-control ckeditor" name="description" id="description" rows="6"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>    
                        <div class="tab-pane fade" id="tab_option">
                            <div class="panel-body">
                                <?php
                                if (count($option_val) > 1) {
                                    foreach ($option_val as $key => $item) {
                                        $options[$item['group_id']] = $item['option_item_id'];
                                    }
                                    foreach ($option_html as $val) {
                                        echo $this->Options_model->get_option_select_html($val->id, $options);
                                    }
                                } else {
                                    if ($option_html) {
                                        foreach ($option_html as $item) {
                                            echo $this->Options_model->get_option_select_html($item->id);
                                        }
                                    } else {
                                        echo "ยังไม่ระบุ Options ให้กับ Category นี้";
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-6 --> 
        <div class="col-lg-12">
            <div class="panel-body">
                <div class="text-center">
                    <button type="button" id="btnSave" class="btn btn-success btn-lg">Finish Editing</button>                 
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="product_id" value="<?php echo $this->uri->segment(5); ?>" />
</form>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/plugins/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    $('#btnSave').click(function() {
        var data = {
            url: 'products/backend/result_product/edit',
            v: $('#form-add, select input:not(#btnDialogSave)').serializeArray()
        };
        saveData(data);
    });

    $(function() {
        CKEDITOR.replace('description');
        var edit_category = <?php echo isset($item->category_sub_1) ? $item->category_sub_1 : 0; ?>;
        var edit_sub1 = <?php echo isset($item->category_sub_2) ? $item->category_sub_2 : 0; ?>;
        var edit_sub2 = <?php echo isset($item->category_sub_3) ? $item->category_sub_3 : 0; ?>;
        var edit_sub3 = <?php echo isset($item->category_sub_4) ? $item->category_sub_4 : 0; ?>;

        if ($('#category_id').val()) {
            if (edit_sub1 > 0) {
                $('#sub1').parent().parent().show();
                $.get(base_url + index_page + 'products/backend/category/get_sub/' + edit_category,
                        function(data) {
                            var as = JSON.parse(data);
                            if (as) {
                                var sub1 = $('#sub1');
                                sub1.empty();
                                $.each(as, function(index, element) {
                                    var sub1_select = (index === '' + edit_sub1 + '' ? "selected" : "");
                                    sub1.append("<option value='" + index + "' " + sub1_select + ">" + element + "</option>");
                                });
                            }
                        });
                if (edit_sub2 > 0) {
                    $('#sub2').parent().parent().show();
                    $.get(base_url + index_page + 'products/backend/category/get_sub/' + edit_sub1,
                            function(data) {
                                var as = JSON.parse(data);
                                if (as) {
                                    var sub2 = $('#sub2');
                                    sub2.empty();
                                    $.each(as, function(index, element) {
                                        var sub2_select = (index === '' + edit_sub2 + '' ? "selected" : "");
                                        sub2.append("<option value='" + index + "' " + sub2_select + ">" + element + "</option>");
                                    });
                                }
                            });
                    if (edit_sub3 > 0) {
                        $('#sub3').parent().parent().show();
                        $.get(base_url + index_page + 'products/backend/category/get_sub/' + edit_sub2,
                                function(data) {
                                    var as = JSON.parse(data);
                                    if (as) {
                                        var sub3 = $('#sub3');
                                        sub3.empty();
                                        $.each(as, function(index, element) {
                                            var sub3_select = (index === '' + edit_sub3 + '' ? "selected" : "");
                                            sub3.append("<option value='" + index + "' " + sub3_select + ">" + element + "</option>");
                                        });
                                    }
                                });
                    }
                }
            }
        }
    });

    $('#category_id').change(function() {
        $('#sub2').parent().parent().hide();
        $('#sub2').empty();
        $.get(base_url + index_page + 'products/backend/category/get_sub/' + $(this).val(),
                function(data) {
                    var as = JSON.parse(data);
                    if (as) {
                        var sub1 = $('#sub1');
                        sub1.parent().parent().show();
                        sub1.empty();
                        sub1.append("<option value=''>Please select.</option>");
                        $.each(as, function(index, element) {
                            sub1.append("<option value='" + index + "'>" + element + "</option>");
                        });
                    }
                });
    });
    $('#sub1').change(function() {
        $('#sub2').parent().parent().hide();
        $('#sub2').empty();
        $.get(base_url + index_page + 'products/backend/category/get_sub/' + $(this).val(),
                function(data) {
                    var as = JSON.parse(data);
                    if (as) {
                        var sub2 = $('#sub2');
                        sub2.parent().parent().show();
                        sub2.empty();
                        sub2.append("<option value=''>Please select.</option>");
                        $.each(as, function(index, element) {
                            sub2.append("<option value='" + index + "'>" + element + "</option>");
                        });
                    }
                });
    });
</script>