<h2>Rooms<?php if (isset($zone)) { echo(" for "); echo $this->Html->link($zone["Zone"]["name"], array('controller'=>'/zones/', 'action'=>'admin_edit', $zone["Zone"]["id"])); } ?></h2>
<?php
if (isset($zone)) {
	echo $this->Html->link('Add Room', array('controller'=>'/rooms/', 'action'=>'admin_edit', $zone["Zone"]["id"]), array());
}
else
{
	echo $this->Html->link('Add Room', array('controller'=>'/rooms/', 'action'=>'admin_edit'), array());
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
				Short Description
			</th>
			<th>
			</th>
			<th>
			</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($rooms as $room) { ?>
			<tr>
				<td>
					<?php echo($room["Room"]["id"]) ?>
				</td>
				<td>
					<?php echo($room["Room"]["name"]) ?>
				</td>
				<td>
					<?php echo $this->Html->link($room["Zone"]["name"], array('controller'=>'/zones/', 'action'=>'admin_edit', $room["Zone"]["id"])); ?>
				</td>
				<td>
					<?php echo($room["Room"]["short_description"]) ?>
				</td>
				<td>
					<?php echo $this->Html->link('edit', array('controller'=>'/rooms/', 'action'=>'admin_edit', $room["Room"]["id"])); ?>
				</td>
				<td>
					<?php echo $this->Html->link('delete', array('controller'=>'/rooms/', 'action'=>'admin_delete', $room["Room"]["id"]), array(), __('Are you sure you want to delete', true)); ?>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>
