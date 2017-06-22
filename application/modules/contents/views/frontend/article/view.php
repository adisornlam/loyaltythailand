<div class="row blog-post-page">
    <div class="col-md-9 blog-box">
        <!-- Start Single Post Area -->
        <div class="blog-post gallery-post">
            <!-- Start Single Post Content -->
            <h2><?php echo $title; ?></h2>
            <ul class="post-meta">
                <li>By <a href="#">iThemesLab</a></li>
                <li>December 30, 2013</li>
                <li><a href="#">WordPress</a>, <a href="#">Graphic</a></li>
                <li><a href="#">4 Comments</a></li>
            </ul>
            <?php echo (isset($item->long_desc) ? $item->long_desc : NULL); ?>
            <div class="post-bottom clearfix">
                <div class="post-tags-list">
                    <a href="#">Theme</a>
                    <a href="#">Mobile</a>
                    <a href="#">Design</a>
                    <a href="#">Wordpress</a>
                    <a href="#">Jquery</a>
                </div>
                <div class="post-share">
                    <span>Share This Post:</span>
                    <a class="facebook" href="#"><i class="fa fa-facebook"></i></a>
                    <a class="twitter" href="#"><i class="fa fa-twitter"></i></a>
                    <a class="gplus" href="#"><i class="fa fa-google-plus"></i></a>
                    <a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a>
                    <a class="mail" href="#"><i class="fa fa-envelope"></i></a>
                </div>
            </div>

            <!-- End Single Post Content -->

        </div>
        <!-- End Single Post Area -->

        <!-- Start Comment Area -->
        <div id="comments">
            <h2 class="comments-title">(4) Comments</h2>
            <ol class="comments-list">
                <li>
                    <div class="comment-box clearfix">
                        <div class="avatar"><img alt="" src="<?php echo base_url(); ?>assets/frontend/images/avatar.png" /></div>
                        <div class="comment-content">
                            <div class="comment-meta">
                                <span class="comment-by">John Doe</span>
                                <span class="comment-date">February 15, 2013 at 11:39 pm</span>
                                <span class="reply-link"><a href="#">Reply</a></span>
                            </div>
                            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia desrut mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>
                        </div>
                    </div>

                    <ul>
                        <li>
                            <div class="comment-box clearfix">
                                <div class="avatar"><img alt="" src="<?php echo base_url(); ?>assets/frontend/images/avatar.png" /></div>
                                <div class="comment-content">
                                    <div class="comment-meta">
                                        <span class="comment-by">John Doe</span>
                                        <span class="comment-date">February 15, 2013 at 11:39 pm</span>
                                        <span class="reply-link"><a href="#">Reply</a></span>
                                    </div>
                                    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.</p>
                                </div>
                            </div>

                            <ul>
                                <li>
                                    <div class="comment-box clearfix">
                                        <div class="avatar"><img alt="" src="<?php echo base_url(); ?>assets/frontend/images/avatar.png" /></div>
                                        <div class="comment-content">
                                            <div class="comment-meta">
                                                <span class="comment-by">John Doe</span>
                                                <span class="comment-date">February 15, 2013 at 11:39 pm</span>
                                                <span class="reply-link"><a href="#">Reply</a></span>
                                            </div>
                                            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi.</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                        </li>
                    </ul>
                </li>

                <li>
                    <div class="comment-box clearfix">
                        <div class="avatar"><img alt="" src="<?php echo base_url(); ?>assets/frontend/images/avatar.png" /></div>
                        <div class="comment-content">
                            <div class="comment-meta">
                                <span class="comment-by">John Doe</span>
                                <span class="comment-date">February 15, 2013 at 11:39 pm</span>
                                <span class="reply-link"><a href="#">Reply</a></span>
                            </div>
                            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia desrut mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>
                        </div>
                    </div>
                </li>

            </ol>

            <!-- Start Respond Form -->
            <div id="respond">
                <h2 class="respond-title">Leave a reply</h2>
                <form action="#">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="author">Name<span class="required">*</span></label>
                            <input id="author" name="author" type="text" value="" size="30" aria-required="true">
                        </div>
                        <div class="col-md-4">
                            <label for="email">Email<span class="required">*</span></label>
                            <input id="email" name="author" type="text" value="" size="30" aria-required="true">
                        </div>
                        <div class="col-md-4">
                            <label for="url">Website<span class="required">*</span></label>
                            <input id="url" name="url" type="text" value="" size="30" aria-required="true">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="comment">Add Your Comment</label>
                            <textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
                            <input name="submit" type="submit" id="submit" value="Submit Comment">
                        </div>
                    </div>
                </form>
            </div>
            <!-- End Respond Form -->

        </div>
        <!-- End Comment Area -->

    </div>



    <!-- Sidebar -->
    <div class="col-md-3 sidebar right-sidebar">

        <!-- Search Widget -->
        <div class="widget widget-search">
            <form action="#">
                <input type="search" placeholder="Enter Keywords..." />
                <button class="search-btn" type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>

        <!-- Popular Posts widget -->
        <div class="widget widget-popular-posts">
            <h4>Popular Post <span class="head-line"></span></h4>
            <ul>
                <li>
                    <div class="widget-thumb">
                        <a href="#"><img src="images/blog-mini-01.jpg" alt="" /></a>
                    </div>
                    <div class="widget-content">
                        <h5><a href="#">How To Download The Google Fonts Catalog</a></h5>
                        <span>Jul 29 2013</span>
                    </div>
                    <div class="clearfix"></div>
                </li>
                <li>
                    <div class="widget-thumb">
                        <a href="#"><img src="images/blog-mini-02.jpg" alt="" /></a>
                    </div>
                    <div class="widget-content">
                        <h5><a href="#">How To Download The Google Fonts Catalog</a></h5>
                        <span>Jul 29 2013</span>
                    </div>
                    <div class="clearfix"></div>
                </li>
                <li>
                    <div class="widget-thumb">
                        <a href="#"><img src="images/blog-mini-03.jpg" alt="" /></a>
                    </div>
                    <div class="widget-content">
                        <h5><a href="#">How To Download The Google Fonts Catalog</a></h5>
                        <span>Jul 29 2013</span>
                    </div>
                    <div class="clearfix"></div>
                </li>
            </ul>
        </div>

        <!-- Video Widget -->
        <div class="widget">
            <h4>Video <span class="head-line"></span></h4>
            <div>
                <iframe src="http://player.vimeo.com/video/63322694?byline=0&amp;portrait=0&amp;badge=0" width="800" height="450"></iframe>
            </div>
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