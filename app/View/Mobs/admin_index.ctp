<h2>Mobs<?php if (isset($zone)) { echo(" for "); echo $this->Html->link($zone["Zone"]["name"], array('controller'=>'/zones/', 'action'=>'admin_edit', $zone["Zone"]["id"])); } ?></h2>
<?php
if (isset($zone)) {
	echo $this->Html->link('Add Mob', array('controller'=>'/mobs/', 'action'=>'admin_edit', $zone["Zone"]["id"]), array());
}
else
{
	echo $this->Html->link('Add Mob', array('controller'=>'/mobs/', 'action'=>'admin_edit'), array());
}
?>
<table>
	<thead>
		<tr>
			<th>
				Id
			</th>
			<th>
				Name
			</th>
			<th>
				Zone
			</th>
			<th>
				Description
			</th>
			<th>
			</th>
			<th>
			</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($mobs as $mob) { ?>
			<tr>
				<td>
					<?php echo($mob["Mob"]["id"]) ?>
				</td>
				<td>
					<?php echo($mob["Mob"]["name"]) ?>
				</td>
				<td>
					<?php if (isset($mob["Zone"]["name"])) {echo $this->Html->link($mob["Zone"]["name"], array('controller'=>'/zones/', 'action'=>'admin_edit', $mob["Zone"]["id"]));} ?>
				</td>
				<td>
					<?php echo($mob["Mob"]["description"]) ?>
				</td>
				<td>
					<?php echo $this->Html->link('edit', array('controller'=>'/mobs/', 'action'=>'admin_edit', $mob["Mob"]["id"])); ?>
				</td>
				<td>
					<?php echo $this->Html->link('delete', array('controller'=>'/mobs/', 'action'=>'admin_delete', $mob["Mob"]["id"]), array(), __('Are you sure you want to delete this Mob?', true)); ?>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>
