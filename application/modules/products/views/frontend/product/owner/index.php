<div class="basecamp">
    <img src="<?php echo  base_url(); ?>assets/frontend/images/ic-home.png"><a href="<?php echo base_url(); ?>">หน้าแรก</a> > <a href="javascript:;">สินค้าทั้งหมด</a>
</div>

<div class="clear"></div>
<div class="cl-left">		
    <div class="cat-box">
        <div class="top"><img src="<?php echo  base_url(); ?>assets/frontend/images/insite-producttitle.png"></div>
        <div class="mid">
            <div class="gd-bg">
                <ul class="lt-menu">
                    <?php foreach ($category->result() as $cat) { ?>
                        <li><a href="<?php echo base_url(); ?>products/categories/<?php echo $cat->id; ?>"><?php echo $cat->title; ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="bot"></div>
    </div>
</div>
<div class="cl-right">
    <div class="list-box">
        <div class="top"></div>
        <div class="mid">
            <div style="padding:10px 30px 5px;">
                <div class="sorting">
                    <div class="brand">
                        <?php echo form_dropdown('cat_id', $cat_list, NULL, 'id="cat_id"'); ?>
                    </div>
                    <div class="series">
                        <select name="cat_sub_1" id="cat_sub_1">
                            <option selected="selected" value=""></option>                            
                        </select>
                    </div>
                    <a href="" class="accept"></a>
                </div>
                <h3 class="title">หลอดไฟโปรเจคเตอร์</h3>
                <img src="<?php echo  base_url(); ?>assets/frontend/images/line.png">
                <div class="dcrp lh-14">
                    รายละเอียดหมวดสินค้า Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the 
                    industry's standard dummy text ever since the 1500s,
                </div>
                <?php foreach ($result as $item) { ?>
                    <div class="bx-pr">
                        <div class="desc">
                            <h4><a href="<?php echo base_url(); ?>products/<?php echo $item->id; ?>"><?php echo $item->title; ?></a></h4>
                            <a href="<?php echo base_url(); ?>products/<?php echo $item->id; ?>" title="<?php echo $item->title; ?>"><?php echo $item->short_desc; ?></a>
                            <div class="price">ราคา <?php echo $item->price; ?> บาท</div>
                        </div>
                    </div>
                <?php } ?>

                <div class="clear"></div>
                <div class="pagNav">
                    <div class="f-right">
                        <?php echo $links; ?>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="bot"></div>
    </div>
</div>
<div class="clear"></div>
<div class="row">
    <div class="bannerM1">
        <a href="" class="bn">
            <img src="<?php echo  base_url(); ?>assets/frontend/images/banner-bottom.png">
        </a>
        <a href="" class="bn">
            <img src="<?php echo  base_url(); ?>assets/frontend/images/banner-bottom.png">
        </a>
        <a href="" class="bn">
            <img src="<?php echo  base_url(); ?>assets/frontend/images/banner-bottom.png">
        </a>
    </div>		
</div>
<div class="clear"></div>
<script type="text/javascript">
    $('#cat_id').change(function () {
        $('#cat_sub_1').empty();
        $.get(base_url + index_page + 'products/category/get_sub/' + $(this).val(),
                function (data) {
                    var as = JSON.parse(data);
                    if (as) {
                        var sub1 = $('#cat_sub_1');
                        sub1.empty();
                        sub1.append("<option value=''>เลือกรายการย่อย</option>");
                        $.each(as, function (index, element) {
                            sub1.append("<option value='" + index + "'>" + element + "</option>");
                        });
                    }
                });
    });
</script>