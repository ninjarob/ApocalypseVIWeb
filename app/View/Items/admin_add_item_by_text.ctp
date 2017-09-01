<style>
form div.joe {
	clear: none;
}

form div.adjz {
	float: left;
	clear: none;
	font-size: 12px;
	padding-left: 0px;
	padding-right: 10px;
}

form div.weapon {
	display: none;
}

form div.armor {
	display: none;
}
</style>
<h2 style="float: left;">Item</h2>
<div style="float: left; clear: both;">
	<?php echo $this->Html->link('Items', array('controller'=>'/items/', 'action'=>'index'), array()); ?>
</div>
<br />
<br />
<?php echo $this->Form->create('Item', array('style'=>"float:left; display:block; clear:none;")); ?>
<?php echo $this->Form->textarea('item_text', array('cols'=>'40', 'rows'=>'14')); ?>
<?php echo $this->Form->textarea('description', array('cols'=>40, 'rows'=>'2')); ?>
<div class="joe required">
<label for="zone">Zone</label>
<?php echo $this->Form->select('zone_id', $zones, null, array("label"=>"Zone")); ?>
</div>
<?php echo $this->Form->submit(); ?>
<?php echo $this->Form->end(); ?>

<table>
	<?php if (isset($name)) { ?>
		<tr>
			<td>name</td>
			<td><?php echo $name ?></td>
		</tr>
	<?php } ?>
	<?php if (isset($keywords)) { ?>
		<tr>
			<td>keywords</td>
			<td><?php print_r($keywords) ?></td>
		</tr>
	<?php } ?>
	<?php if (isset($size)) { ?>
		<tr>
			<td>size</td>
			<td><?php print_r($size) ?></td>
		</tr>
	<?php } ?>
	<?php if (isset($composition)) { ?>
		<tr>
			<td>composition</td>
			<td><?php print_r($composition) ?></td>
		</tr>
	<?php } ?>
	<?php if (isset($weight)) { ?>
		<tr>
			<td>weight</td>
			<td><?php print_r($weight) ?></td>
		</tr>
	<?php } ?>
	<?php if (isset($minlevel)) { ?>
		<tr>
			<td>minlevel</td>
			<td><?php print_r($minlevel) ?></td>
		</tr>
	<?php } ?>
	<?php if (isset($cost)) { ?>
		<tr>
			<td>cost</td>
			<td><?php print_r($cost) ?></td>
		</tr>
	<?php } ?>
	<?php if (isset($rent)) { ?>
		<tr>
			<td>rent</td>
			<td><?php print_r($rent) ?></td>
		</tr>
	<?php } ?>
	<?php if (isset($positions)) { ?>
		<tr>
			<td>positions</td>
			<td><?php print_r($positions) ?></td>
		</tr>
	<?php } ?>
	<?php if (isset($item_type)) { ?>
		<tr>
			<td>Item Type</td>
			<td><?php print_r($item_type) ?></td>
		</tr>
	<?php } ?>
	<?php if (isset($extra_mods)) { ?>
		<tr>
			<td>Extra Mods</td>
			<td><?php print_r($extra_mods) ?></td>
		</tr>
	<?php } ?>
	<?php if (isset($restrictions)) { ?>
		<tr>
			<td>Restrictions</td>
			<td><?php print_r($restrictions) ?></td>
		</tr>
	<?php } ?>
	<?php if (isset($attributes)) { ?>
		<tr>
			<td>Attributes</td>
			<td><?php print_r($attributes) ?></td>
		</tr>
	<?php } ?>
	<?php if (isset($apply_mods)) { ?>
		<tr>
			<td>Apply Mods</td>
			<td><?php print_r($apply_mods) ?></td>
		</tr>
	<?php } ?>
	<?php if (isset($armor)) { ?>
		<tr>
			<td>Armor</td>
			<td><?php print_r($armor) ?></td>
		</tr>
	<?php } ?>
	<?php if (isset($weapon)) { ?>
		<tr>
			<td>Weapon</td>
			<td><?php print_r($weapon) ?></td>
		</tr>
	<?php } ?>
</table>