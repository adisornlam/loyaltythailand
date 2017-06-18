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
	<div style="text-align: center;;"><h1>ใบสรุปเวลาเข้าเรียน</h1></div>
	<table width="100%" cellspacing="0" cellpadding="1" border="1">
		<tr>
			<th width="8%" style="text-align: center;;">No.</th>
			<th width="20%" style="text-align: center;;">Code</th>
			<th width="30%" style="text-align: center;;">Full Name</th>
			<th width="25%" style="text-align: center;;">First Time</th>
			<th width="25%" style="text-align: center;;">Last Time</th>
		</tr>
		<tbody>
			<?php
			$i=1;
			foreach ($result->result() as $item) {
				?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $item->code_member; ?></td>
					<td><?php echo $item->first_name.' '.$item->last_name; ?></td>
					<td><?php echo $item->first_time; ?></td>
					<td><?php echo $item->last_time; ?></td>
				</tr>
				<?php 
				$i++; 
			} ?>
		</tbody>
	</table>
</body>
</html>