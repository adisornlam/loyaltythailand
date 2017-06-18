<div class="basecamp">
    <img src="<?php echo base_url(); ?>assets/frontend/images/ic-home.png"><a href="<?php echo base_url(); ?>">หน้าแรก</a> > <a href="<?php echo base_url(); ?>products">สินค้าทั้งหมด</a> > <a href="javascript:;"><?php echo $title; ?></a>
</div>

<div class="clear"></div>
<div class="cl-left">

    <div class="cat-box">
        <div class="top"><img src="<?php echo base_url(); ?>assets/frontend/images/insite-producttitle.png"></div>
        <div class="mid">
            <div class="gd-bg">
                <ul class="lt-menu">
                    <?php foreach ($this->Category_owner_model->get_list()->result() as $cat_content) { ?>
                        <li><a href="<?php echo base_url(); ?>products/categories/<?php echo $cat_content->id; ?>"><?php echo $cat_content->title; ?></a></li>
                    <?php } ?>
                </ul>
                <div class="val">
                    <a href="" class="viewall">ดูสินค้าทั้งหมด</a>
                </div>
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
                <h3 class="title size18"><?php echo $title; ?></h3>
                <img src="<?php echo base_url(); ?>assets/frontend/images/line.png">
                <div class="dcrp">
                </div>
                <div class="detail-content">
                    <div class="bold size14">Detail:</div>
                    <div class="dtl-prd"><?php echo $item->long_desc; ?></div>
                    <br>
                    <div class="bold size14">Sample Image:</div>
                    <div class="gl-prd">
                        <?php
                        if ($item->photo1 != NULL) {
                            echo '<a href="' . base_url() . $item->photo1 . '" class="thm-gal" rel="gall">' . img(array('src' => $item->photo1, 'width' => 173)) . '</a>';
                        }
                        if ($item->photo2 != NULL) {
                            echo '<a href="' . base_url() . $item->photo2 . '" class="thm-gal" rel="gall">' . img(array('src' => $item->photo2, 'width' => 173)) . '</a>';
                        }
                        if ($item->photo3 != NULL) {
                            echo '<a href="' . base_url() . $item->photo3 . '" class="thm-gal" rel="gall">' . img(array('src' => $item->photo3, 'width' => 173)) . '</a>';
                        }
                        if ($item->photo4 != NULL) {
                            echo '<a href="' . base_url() . $item->photo4 . '" class="thm-gal" rel="gall">' . img(array('src' => $item->photo4, 'width' => 173)) . '</a>';
                        }
                        if ($item->photo5 != NULL) {
                            echo '<a href="' . base_url() . $item->photo5 . '" class="thm-gal" rel="gall">' . img(array('src' => $item->photo5, 'width' => 173)) . '</a>';
                        }
                        ?>
                    </div>
                    <div class="clear"></div>
                    <div class="price-tag">ราคา : <?php echo number_format($item->price); ?> บาท</div>
                </div>
                <div class="clear"></div>

                <div class="related">
                    <div class="size12 head">Related Products</div>
                    <img src="<?php echo base_url(); ?>assets/frontend/images/line.png">
                    <div class="bx-pr r2">
                        <div class="desc">
                            <h4><a href="">Epson EB-1910</a></h4>
                            <a href="" title="LG เผยภาพแท็บเล็ตรุ่นใหม่ในตระกูล">
                                รายละข่าวสาร Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s ...
                            </a>
                            <div class="price">Price : 1,200 Baht.</div>
                        </div>
                    </div>
                    <div class="bx-pr r1">
                        <div class="desc">
                            <h4><a href="">Epson EB-1910</a></h4>
                            <a href="" title="LG เผยภาพแท็บเล็ตรุ่นใหม่ในตระกูล">
                                รายละข่าวสาร Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s ...
                            </a>
                            <div class="price">Price : 1,200 Baht.</div>
                        </div>
                    </div>
                    <div class="bx-pr r2">
                        <div class="desc">
                            <h4><a href="">Epson EB-1910</a></h4>
                            <a href="" title="LG เผยภาพแท็บเล็ตรุ่นใหม่ในตระกูล">
                                รายละข่าวสาร Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s ...
                            </a>
                            <div class="price">Price : 1,200 Baht.</div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="pagNav" style="margin-top:5px;">						
                        <div><a href="" class="backpage">< ย้อนกลับ</a></div>
                        <div class="clear"></div>
                    </div>
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
        <?php echo $banner_botton; ?>
    </div>		
</div>
<div class="clear"></div>