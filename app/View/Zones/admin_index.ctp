<h2>Zones</h2>
<?php echo $this->Html->link('add zone', array('controller'=>'/zones/', 'action'=>'admin_edit'), array()); ?>
<table>
	<thead>
		<tr>
			<th width="70">
				Zone #
			</th>
			<th>
				Name
			</th>
			<th width="700">
				Description
			</th>
			<th>
				Authors
			</th>
			<th>
				Min Lvl
			</th>
			<th>
				Max Lvl
			</th>
			<th>
			</th>
			<th>
			</th>
			<th>
			</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($zones as $zone) { ?>
			<tr>
				<td>
					<?php echo($zone["Zone"]["zone_number"]) ?>
				</td>
				<td>
					<?php echo($zone["Zone"]["name"]) ?>
				</td>
				<td>
					<?php echo($zone["Zone"]["description"]) ?>
				</td>
				<td>
					<?php echo($zone["Zone"]["authors"]) ?>
				</td>
				<td>
					<?php if ($zone["Zone"]["min_lvl"] != null) echo("(".$zone["Zone"]["min_lvl"].")") ?>
					<?php if ($zone["Zone"]["suggested_min_lvl"]!= null) echo("(".$zone["Zone"]["suggested_min_lvl"].")")?>
				</td>
				<td>
					<?php if ($zone["Zone"]["max_lvl"] != null) echo("(".$zone["Zone"]["max_lvl"].")") ?>
					<?php if ($zone["Zone"]["suggested_max_lvl"]!= null) echo("(".$zone["Zone"]["suggested_max_lvl"].")")?>
				</td>
				<td>
					<?php echo $this->Html->link('edit', array('controller'=>'/zones/', 'action'=>'admin_edit', $zone["Zone"]["id"])); ?>
				</td>
				<td>
					<?php echo $this->Html->link('delete', array('controller'=>'/zones/', 'action'=>'admin_delete', $zone["Zone"]["id"]), array(), __('Are you sure you want to delete', true)); ?>
				</td>
				<td>
					<?php echo $this->Html->link('map', array('controller'=>'/zones/', 'action'=>'map', $zone["Zone"]["id"])); ?>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>
