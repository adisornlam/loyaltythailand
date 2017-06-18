<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<style type="text/css">
		body {
			font-family: angsa;
			font-size: 14pt;
			margin: 0;
			padding : 0;
		}
	</style>
</head>
<body>
	<div style="text-align: center;;"><h1>รายการนักเรียนทั้งหมด</h1></div>
	<table width="100%" cellspacing="0" cellpadding="1" border="1">
		<tr>
			<th width="5%" style="text-align: center;;">No.</th>
			<th width="30%" style="text-align: center;;">Full Name</th>
			<th width="15%" style="text-align: center;;">Nick Name</th>
			<th width="15%" style="text-align: center;;">Phone</th>
			<th width="20%" style="text-align: center;;">Signature</th>
			<th width="20%" style="text-align: center;;">Remark</th>
		</tr>
		<tbody>
			<?php
			$i=1;
			foreach ($result->result() as $item) {
				?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $item->first_name.' '.$item->last_name; ?></td>
					<td><?php echo $item->nick_name; ?></td>
					<td><?php echo $item->parent_phone; ?></td>
					<td></td>
					<td></td>
				</tr>
				<?php 
				$i++; 
			} ?>
		</tbody>
	</table>
</body>
</html>