<div>
	<table>
		<?php foreach($transactions as $num => $tx):?>
		<tr><td><?=$num+1;?></td><td><?=$tx['category'];?></td><td><?=$tx['account'].' ('.$tx['address'].')';?></td><td><?=$tx['amount'];?></td></tr>
        	<?php endforeach;?>
	</table>
</div>
