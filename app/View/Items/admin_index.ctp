<script type="text/javascript">
$(document).ready(function(){
		 $("#demotable").dataTable(); 
	});
</script>

<h2>Items<?php if (isset($zone)) { echo(" for "); echo $this->Html->link($zone["Zone"]["name"], array('controller'=>'/zones/', 'action'=>'admin_edit', $zone["Zone"]["id"])); } ?></h2>
<?php

if (isset($zone)) {
	echo $this->Html->link('Add Item', array('controller'=>'/items/', 'action'=>'admin_edit', $zone["Zone"]["id"]), array());
}
else
{
	echo $this->Html->link('Add Item', array('controller'=>'/items/', 'action'=>'admin_edit'), array());
}
?>
<br/>
<?php echo $this->Html->link('Add Item By Text', array('controller'=>'/items/', 'action'=>'admin_add_item_by_text'), array()); ?>
<table id="demotable">
	<thead>
		<tr>
			<th class="joe">
				Id
			</th>
			<th id="name_header">
				Name
			</th>
			<th>
				Zone
			</th>
			<th id="type_header">
				Type
			</th>
			<th>
				Apply Mod
			</th>
			<th>
				Attributes
			</th>
			<th>
				Extra Mods
			</th>
			<th>
				Positions
			</th>
			<th>
				Keywords
			</th>
			<th>
				Mobs
			</th>
			<th>
			</th>
			<th>
			</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($items as $item) { ?>
			<tr>
				<td>
					<?php echo($item["Item"]["id"]) ?>
				</td>
				<td>
					<?php echo($item["Item"]["name"]) ?>
				</td>
				<td>
					<?php if (isset($item["Zone"]["name"])) {echo $this->Html->link($item["Zone"]["name"], array('controller'=>'/zones/', 'action'=>'admin_edit', $item["Zone"]["id"]));} ?>
				</td>
				<td style="font-size:9px;">
					<?php echo $item['ItemType']['name']; ?>
				</td>
				<td style="font-size:9px;">
					<?php foreach ($item["ApplyMod"] as $am) {
							echo $am['name'].'<br/>';
						} 
					?>
				</td>
				<td style="font-size:9px;">
					<?php if (isset($item["Atribute"])) {
							foreach ($item["Atribute"] as $a) {
								echo $a['name'].' '.$a['AttributesItem']['amount'].'<br/>';
							} 
						}
					?>
				</td>
				<td style="font-size:9px;">
					<?php foreach ($item["ExtraMod"] as $em) {
							echo $em['name'].' ';
					}
					?>
				</td>
				<td style="font-size:9px;">
					<?php foreach ($item["Position"] as $em) {
							echo $em['name'].' ';
					}
					?>
				</td>
				<td style="font-size:9px;">
					<?php foreach ($item["Keyword"] as $keyword) {
							echo $keyword['keyword']." ";
						}
					?>
				</td>
				<td style="font-size:9px;">
					<?php foreach ($item["Mob"] as $mob) {
							echo($this->Html->link($mob['name'], array('controller'=>'/mobs/', 'action'=>'admin_edit', $mob['id']), array()));
						}
					?>
				</td>
				<td>
					<?php echo $this->Html->link('edit', array('controller'=>'/items/', 'action'=>'admin_edit', $item["Item"]["id"])); ?>
				</td>
				<td>
					<?php echo $this->Html->link('delete', array('controller'=>'/items/', 'action'=>'admin_delete', $item["Item"]["id"]), array(), __('Are you sure you want to delete this Item?', true)); ?>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>
