<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    <li class="active"><a href="#info" role="tab" data-toggle="tab">ข้อมูลส่วนตัว</a></li>
    <li><a href="#picture" role="tab" data-toggle="tab">ประวัติสั่งซื้อ</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div class="tab-pane active" id="info">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th width="30%"></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ชื่อนามสกุล</td><td><?php echo $item->first_name . " " . $item->last_name; ?></td>
                </tr>
                <tr>
                    <td>เบอร์ติดต่อ</td><td><?php echo $item->phone; ?></td>
                </tr>
                <tr>
                    <td>ที่อยู่</td><td><?php echo $this->Users_model->get_address_dealer(0, $item->id); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="tab-pane" id="picture">
        <div class="row">
            <div class="panel-body">

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

</script>