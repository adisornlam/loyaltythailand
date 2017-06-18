<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-left">
        <?php
        foreach ($this->Menu_model->get_menu_auth() as $item) {
            ?>
            <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                    <?php echo $item->title; ?>
                    <?php if ($this->Menu_model->get_menu_auth($item->id)) { ?>
                        <span class="caret"></span>
                    <?php } ?>
                </a>
                <?php if ($this->Menu_model->get_menu_auth($item->id)) { ?>
                    <ul class="dropdown-menu" role="menu">
                        <?php foreach ($this->Menu_model->get_menu_auth($item->id) as $item2) { ?>
                            <?php $url = base_url() . index_page() . $item2->url; ?>
                            <li>
                                <a class="" href="<?php echo base_url() . index_page() . $item2->url; ?>"><?php echo $item2->title; ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } ?>

            </li>
        <?php } ?>
    </ul>
    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-messages">
                <li>
                    <a href="#">
                        <div>
                            <p class="text-center">ยังไม่มีรายการข้อความ</p>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>                
                <li>
                    <a class="text-center" href="#">
                        <strong>แสดงข้อความทั้งหมด</strong>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
            </ul>
            <!-- /.dropdown-messages -->
        </li>
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">
                <i class="fa fa-user fa-fw"></i> <?php echo $this->ion_auth->user()->row()->first_name . " " . $this->ion_auth->user()->row()->last_name; ?>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url() . index_page(); ?>logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
</div><!--/.nav-collapse -->
