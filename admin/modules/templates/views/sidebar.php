<div class="sidebar-nav navbar-collapse">
    <ul class="nav" id="side-menu">
        <li>
            <a class="" href="<?php echo base_url() . index_page(); ?>backend"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
        </li>
        <?php
        $this->db->select('*');
        $this->db->from('menu');
        $this->db->join('menu_hierarchy', 'menu_hierarchy.menu_id = menu.id');
        $this->db->where('menu_hierarchy.menu_parent_id', 0);
        $query = $this->db->get();
        foreach ($query->result() as $item) {
            $query1 = $this->db->query("SELECT * FROM `menu` WHERE EXISTS ( SELECT 1 FROM `menu_hierarchy` WHERE menu.id = menu_hierarchy.menu_id AND `menu_hierarchy`.`menu_parent_id` = " . $item->id . ") AND `type` = 'backend' ORDER BY `weight` ASC");
            ?>
            <li class="<?php echo ($this->uri->segment(1) === $item->modules ? 'active' : '') ?>">
                <a href="javascript:;">
                    <i class="<?php echo $item->icon; ?> fa-fw"></i> 
                    <?php echo $item->title; ?>
                    <?php if ($query1->num_rows() > 0) { ?>
                        <span class="fa arrow"></span>
                    <?php } ?>
                </a>
                <?php
                if ($query1->num_rows() > 0) {
                    ?>
                    <ul class="nav nav-second-level">
                        <?php foreach ($query1->result() as $item2) { ?>
                            <?php $url = base_url() . index_page() . $item2->url; ?>
                            <li>
                                <a class="" href="javascript:;" rel="<?php echo $item2->url; ?>"><?php echo $item2->title; ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } ?>

            </li>
        <?php } ?>
    </ul>
</div>