<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Blackpi</title>
	<link rel="stylesheet" type="text/css" href="/assets/style.css">
</head>
<body>
<p id="headline">Total Balance: <strong><?php echo $get_wallet_info['balance']?></strong> BLK</p>
	<div id="container">
		<div id="body">
			<?php echo form_open('send_to');?>
				Send <?php echo form_input('amount');?> BLK to address: <?php echo form_input('to');?>
				<?php echo form_checkbox('txfee', 'setfee');?> Include fee?
				<?php echo form_submit('submit', 'Send');?>
				<?php echo form_close();?>
			<hr />
			<details>
			<summary>Addresses for this wallet</summary>
			<?php foreach($addresses as $address):?>
				<p><?php echo $address?> [<a target="_blank" href="https://node.blackcoin.io/insight/address/<?php echo $address;?>">View on Blacksight</a>]</p>
			<?php endforeach;?>
			</details>
			<details>
			<summary>Detailed wallet info</summary>
			<table>
			<?php foreach($get_wallet_info as $key => $field):?>
				<?php if(!is_array($field)):?>
				<tr><td><?php echo $key;?></td><td><?php echo $field;?></td></tr>
				<?php endif;?>
			<?php endforeach;?>
			</table>
			</details>
			<details>
			<summary>List transactions</summary>
			<table>
			<?php foreach($transactions as $num => $tx):?>
				<tr>
					<td><?php echo $num+1;?></td>
					<td><?php echo $tx['account'];?></td>
					<td><strong><?php echo $tx['amount'];?></strong> BLK</td>
					<td><?php echo $tx['category'];?></td>
				</tr>
			<?php endforeach;?>
			</table>
			</details>
		</div>
	</div>
</body>
</html>
