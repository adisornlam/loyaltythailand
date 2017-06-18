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
	<div style="text-align: center;;"><h1>ใบประกาศผลสอบ</h1></div>
	<table width="100%" cellspacing="0" cellpadding="1" border="1">
		<tr>
			<th width="10%" style="text-align: center;;">Code</th>
			<th width="50%" style="text-align: center;;">Full Name</th>
			<th width="10%" style="text-align: center;;">Score</th>
		</tr>
		<tbody>
			<?php
			$i=1;
			foreach ($result->result() as $item) {
				?>
				<tr>
					<td><?php echo $item->code_member; ?></td>
					<td><?php echo $item->first_name.' '.$item->last_name; ?></td>
					<td><?php echo $item->total_score; ?></td>
				</tr>
				<?php 
				$i++; 
			} ?>
		</tbody>
	</table>
</body>
</html>