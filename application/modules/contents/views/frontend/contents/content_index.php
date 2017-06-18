<div class="row blog-page">
    <!-- Start Blog Posts -->
    <div class="col-md-9 blog-box">
        <?php
        foreach ($result->result() as $content_item) {
            $result_img = ($content_item->img_cover == NULL ? 'http://www.placehold.it/240x160/EFEFEF/AAAAAA&amp;text=no+image' : base_url() . $content_item->img_cover);
            $result_link = ($content_item->type == 'article' ? base_url() . index_page() . 'article/' . $content_item->id : base_url() . index_page() . 'content/' . $content_item->id );
            ?>
            <!-- Start Post -->
            <div class="blog-post image-post">
                <!-- Post Content -->
                <div class="post-content">
                    <div class="post-type">
                        <img src="<?php echo $result_img; ?>" alt="<?php echo $content_item->title; ?>" />
                    </div>
                    <h2><a href="<?php echo $result_link; ?>"><?php echo $content_item->title; ?></a></h2>
                    <ul class="post-meta">
                        <li>By <a href="#">iThemesLab</a></li>
                        <li>December 30, 2013</li>
                        <li><a href="#">WordPress</a>, <a href="#">Graphic</a></li>
                        <li><a href="#">4 Comments</a></li>
                    </ul>
                    <p><?php echo $content_item->short_desc; ?></p>
                    <a class="main-button" href="<?php echo $result_link; ?>">อ่านเพิ่มเติม <i class="fa fa-angle-right"></i></a>
                </div>
            </div>
            <!-- End Post -->
        <?php } ?>
        <!-- Start Pagination -->
        <div id="pagination">
            <span class="all-pages">Page 1 of 3</span>
            <span class="current page-num">1</span>
            <a class="page-num" href="#">2</a>
            <a class="page-num" href="#">3</a>
            <a class="next-page" href="#">Next</a>
        </div>
        <!-- End Pagination -->
    </div>
    <!-- End Blog Posts -->
    <!--Sidebar-->
    <div class="col-md-3 sidebar right-sidebar">
        <!-- Search Widget -->
        <div class="widget widget-search">
            <form action="#">
                <input type="search" placeholder="Enter Keywords..." />
                <button class="search-btn" type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <!-- Categories Widget -->
        <div class="widget widget-categories">
            <h4>Categories <span class="head-line"></span></h4>
            <ul>
                <li>
                    <a href="#">Brandign</a>
                </li>
                <li>
                    <a href="#">Design</a>
                </li>
                <li>
                    <a href="#">Development</a>
                </li>
                <li>
                    <a href="#">Graphic</a>
                </li>
            </ul>
        </div>
        <!-- Popular Posts widget -->
        <div class="widget widget-popular-posts">
            <h4>Popular Post <span class="head-line"></span></h4>
            <ul>
                <li>
                    <div class="widget-thumb">
                        <a href="#"><img src="<?php echo base_url(); ?>assets/frontend/images/blog-mini-01.jpg" alt="" /></a>
                    </div>
                    <div class="widget-content">
                        <h5><a href="#">How To Download The Google Fonts Catalog</a></h5>
                        <span>Jul 29 2013</span>
                    </div>
                    <div class="clearfix"></div>
                </li>
                <li>
                    <div class="widget-thumb">
                        <a href="#"><img src="<?php echo base_url(); ?>assets/frontend/images/blog-mini-02.jpg" alt="" /></a>
                    </div>
                    <div class="widget-content">
                        <h5><a href="#">How To Download The Google Fonts Catalog</a></h5>
                        <span>Jul 29 2013</span>
                    </div>
                    <div class="clearfix"></div>
                </li>
                <li>
                    <div class="widget-thumb">
                        <a href="#"><img src="<?php echo base_url(); ?>assets/frontend/images/blog-mini-03.jpg" alt="" /></a>
                    </div>
                    <div class="widget-content">
                        <h5><a href="#">How To Download The Google Fonts Catalog</a></h5>
                        <span>Jul 29 2013</span>
                    </div>
                    <div class="clearfix"></div>
                </li>
            </ul>
        </div>

        <!-- Tags Widget -->
        <div class="widget widget-tags">
            <h4>Tags <span class="head-line"></span></h4>
            <div class="tagcloud">
                <a href="#">Portfolio</a>
                <a href="#">Theme</a>
                <a href="#">Mobile</a>
                <a href="#">Design</a>
                <a href="#">Wordpress</a>
                <a href="#">Jquery</a>
                <a href="#">CSS</a>
                <a href="#">Modern</a>
                <a href="#">Theme</a>
                <a href="#">Icons</a>
                <a href="#">Google</a>
            </div>
        </div>

    </div>
    <!--End sidebar-->
</div>