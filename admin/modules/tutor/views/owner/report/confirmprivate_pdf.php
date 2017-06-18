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
	<div style="text-align: center;;"><h2>รายชื่อนักเรียน Private</h2></div>
	<table width="100%" cellspacing="0" cellpadding="1" border="1">
		<tr>
			<th style="text-align: center;;">No.</th>
			<th style="text-align: center;;">Code</th>
			<th style="text-align: left;;">Full Name</th>
			<th style="text-align: left;;">Nick Name</th>
			<th style="text-align: left;;">School Name</th>
			<th style="text-align: left;;">School Province</th>
			<th style="text-align: left;;">Parent Name</th>
			<th style="text-align: left;;">Email</th>
			<th style="text-align: center;;">Phone</th>
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
					<td><?php echo $item->nick_name; ?></td>
					<td><?php echo $item->school_name ; ?></td>
					<td><?php echo $item->school_provine_title; ?></td>
					<td><?php echo $item->parent_first_name.' '.$item->parent_last_name; ?></td>
					<td><?php echo $item->parent_email; ?></td>
					<td><?php echo $item->parent_phone; ?></td>
				</tr>
				<?php 
				$i++; 
			} ?>
		</tbody>
	</table>
</body>
</html>