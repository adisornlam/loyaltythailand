
<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="report_student.xls"');
?>
<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
<HTML>
    <HEAD>
        <meta http-equiv="Content-type" content="text/html;charset=utf-8" />
    </HEAD>
    <BODY>
        <table width="100%" x:str BORDER="1">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Code</th>
                    <th>Full Name</th>
                    <th>Nick Name</th>
                    <th>Degree</th>
                    <th>School Name</th>
                    <th>School Province</th>
                    <th>Parent Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i=1;
                foreach($result as $item): ?>
                <tr>
                    <td style="text-align:center;"><?php echo $i; ?></td>
                    <td style="text-align:center;"><?php echo $item->code_member; ?></td>
                    <td style="text-align:left;"><?php echo $item->first_name.' '.$item->last_name; ?></td>
                    <td style="text-align:left;"><?php echo $item->nick_name; ?></td>
                    <td style="text-align:left;"><?php echo $item->degree_title; ?></td>
                    <td style="text-align:left;"><?php echo $item->school_name; ?></td>
                    <td style="text-align:left;"><?php echo $item->school_provine_title; ?></td>
                    <td style="text-align:left;"><?php echo $item->parent_first_name.' '.$item->parent_last_name; ?></td>
                    <td style="text-align:left;"><?php echo $item->parent_email; ?></td>
                    <td style="text-align:center;"><?php echo $item->parent_phone; ?></td>
                    <td style="text-align:left;"><?php echo $item->parent_address; ?></td>
                </tr>
                <?php
                $i++;
                endforeach; ?>
            </tbody>
        </table>
    </BODY>
</HTML>