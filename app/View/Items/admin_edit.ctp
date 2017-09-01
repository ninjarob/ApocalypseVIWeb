<style>
	form div.joe {clear:none;}
	form div.adjz {float:left; clear:none; font-size:12px; padding-left:0px; padding-right:10px;}
	form div.weapon {display:none;}
	form div.armor {display:none;}
</style>
<?php echo $this->Html->script('jquery-1.6.2');?>
<?php echo $this->Html->script('jquery.selectboxes');?>
<script type="text/javascript">
	$(document).ready(function() {
		if ('<?php echo $this->data["Item"]["item_type_id"]?>' == 1)
		{
			$(".weapon").show();
		}
		if ('<?php echo $this->data["Item"]["item_type_id"]?>' == 2)
		{
			$(".armor").show();
		}
	});
	
	function changeType()
	{
		$(".armor").hide();
		$(".weapon").hide();
		var val = $("#ItemItemTypeId").selectedValues()[0];
		if (val == 1)
		{
			$(".weapon").show();
		}
		if (val == 2)
		{
			$(".armor").show();
		}
	}
</script>
<h2 style="float:left;">Item</h2>
<div style="float:left; margin-left:8px; margin-top:8px;">
	<?php if (isset($zone)) { echo(" (in Zone: "); echo $this->Html->link($zone["Zone"]["name"], array('controller'=>'/zones/', 'action'=>'admin_edit', $zone["Zone"]["id"])).")"; } ?>
	<?php echo $this->Html->link('Add Item By Text', array('controller'=>'/items/', 'action'=>'admin_add_item_by_text'), array()); ?>
</div>
<br/>
<br/>
<div style="float:left; clear:both;">
	<?php echo $this->Html->link('Items', array('controller'=>'/items/', 'action'=>'index'), array()); ?>
</div>
<br/><br/>
<?php echo $this->Form->create('Item', array('style'=>"float:left; width:500px; display:block; clear:none;")); ?>
<table style="width:100%;">
<tr>
<td>
	<table>
		<tr>
			<td>
				<?php if (isset($this->data["Item"])) {echo $this->Form->hidden('id', array('value'=>$this->data["Item"]["id"])); }?>
				<?php echo $this->Form->input('name', array('div'=>'joe', 'style'=>'width:300px;')); ?>
				<div class="joe required">
				<?php echo $this->Form->input('zone_id', array('type'=>'select', 'label'=>'Zone', 'options'=>$zones, 'default'=>$zone_id));?>
				</div>
				<br>
				<br>
				<?php echo $this->Form->input('description', array('cols'=>2, 'rows'=>'3', 'style'=>'width:380px; font-size:12px;')); ?>
				<br>
				<div style="float:left;">
					<?php echo $this->Form->input('item_type_id', array('type'=>'select', 'label'=>'Item Type', 'options'=>$item_types, 'default'=>$item_type_id,"onchange"=>"changeType()"));
					?>
				</div>
				<?php echo $this->Form->input('damage_base', array('div'=>'adjz weapon', 'style'=>'width:30px;')); ?>
				<?php echo $this->Form->input('damage_roll', array('div'=>'adjz weapon', 'style'=>'width:30px;')); ?>
				<?php echo $this->Form->input('armor', array('div'=>'adjz armor', 'style'=>'width:30px;')); ?>
				<br>
				<br>
				<div style="clear:both">
					<?php echo $this->Form->input('size_id', array('type'=>'select', 'label'=>'Size', 'options'=>$sizes, 'default'=>$size_id));?>
				</div>
				<br>
				<label for="material">Material</label>
					<?php echo $this->Form->input('material_id', array('type'=>'select', 'label'=>'Material', 'options'=>$materials, 'default'=>$material_id));?>
				<br>
				<br>
				<?php echo $this->Form->input('limit', array('div'=>'adjz', 'style'=>'width:60px;')); ?>
				<?php echo $this->Form->input('min_lvl', array('div'=>'adjz', 'style'=>'width:30px;')); ?>
				<?php echo $this->Form->input('weight', array('div'=>'adjz', 'style'=>'width:30px;')); ?>
				<?php echo $this->Form->input('rent', array('div'=>'adjz', 'style'=>'width:60px;')); ?>
				<?php echo $this->Form->input('cost', array('div'=>'adjz', 'style'=>'width:70px;')); ?>
			</td>
		</tr>
	</table>
	<?php echo $this->Form->submit(); ?>
<?php echo $this->Form->end(); ?>
</td>
<?php if (isset($this->data["Item"])) { ?>
<td style="width:900px;">
	<div style="float:left; width:300px; display:block; clear:none; margin-left:60px;">
		<h3>Apply Mods</h3>
		<?php echo $this->Form->create('ApplyMod', array('url'=>'/admin/items/add_apply_mod')); ?>
		<table>
			<thead>
				<tr>
					<th>
						Name
					</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($this->data["ApplyMod"] as $am) { ?>
					<tr>
						<td>
							<?php echo $am['name']; ?>
						</td>
						<td>
							<?php echo $this->Html->link("Delete", array('controller'=>'/items/', 'action'=>'admin_delete_apply_mod', $am['id'], $this->data["Item"]["id"]), array(), __('Are you sure you want to delete this Apply Mod?', true)); ?>
						</td>
					</tr>
				<?php } ?>
				<tr>
					<td>
						<?php echo $this->Form->select('ApplyMod.id', $apply_mods); ?>
					</td>
					<td>
						<?php echo $this->Form->hidden('Item.id', array('value'=>$this->data["Item"]["id"])); ?>
						<?php echo $this->Form->submit("Add", array("div"=>"adjz")); ?>
					</td>
				</tr>
			</tbody>
		</table>
		<?php echo $this->Form->end(); ?>
	</div>
	<div style="float:left; width:300px; display:block; clear:none; margin-left:60px;">
		<h3>Attributes</h3>
		<?php echo $this->Form->create('AttributesItem', array('url'=>'/admin/items/add_attribute')); ?>
		<table>
			<thead>
				<tr>
					<th>
						Name
					</th>
					<th>
						Amount
					</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($attributes_items as $am) { ?>
					<tr>
						<td>
							<?php echo $am['Attribute']['name']; ?>
						</td>
						<td>
							<?php echo $am['AttributesItem']['amount']; ?>
						</td>
						<td>
							<?php echo $this->Html->link("Delete", array('controller'=>'/items/', 'action'=>'admin_delete_attribute', $am['AttributesItem']['id'], $this->data["Item"]["id"]), array(), __('Are you sure you want to delete this Attribute?', true)); ?>
						</td>
					</tr>
				<?php } ?>
				<tr>
					<td>
						<?php echo $this->Form->select('attribute_id', $attributes); ?>
					</td>
					<td>
						<?php echo $this->Form->input('amount', array('div'=>'adjz', 'style'=>'width:30px;', 'label'=>false)); ?>
					</td>
					<td>
						<?php echo $this->Form->hidden('item_id', array('value'=>$this->data["Item"]["id"])); ?>
						<?php echo $this->Form->submit("Add", array("div"=>"adjz")); ?>
					</td>
				</tr>
			</tbody>
		</table>
		<?php echo $this->Form->end(); ?>
	</div>
	<div style="float:left; width:300px; display:block; clear:none; margin-left:60px;">
		<h3>Positions</h3>
		<?php echo $this->Form->create('Position', array('url'=>'/admin/items/add_position')); ?>
		<table>
			<thead>
				<tr>
					<th>
						Name
					</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($this->data["Position"] as $am) { ?>
					<tr>
						<td>
							<?php echo $am['name']; ?>
						</td>
						<td>
							<?php echo $this->Html->link("Delete", array('controller'=>'/items/', 'action'=>'admin_delete_position', $am['id'], $this->data["Item"]["id"]), array(), __('Are you sure you want to delete this Position?', true)); ?>
						</td>
					</tr>
				<?php } ?>
				<tr>
					<td>
						<?php echo $this->Form->select('Position.id', $positions); ?>
					</td>
					<td>
						<?php echo $this->Form->hidden('Item.id', array('value'=>$this->data["Item"]["id"])); ?>
						<?php echo $this->Form->submit("Add", array("div"=>"adjz")); ?>
					</td>
				</tr>
			</tbody>
		</table>
		<?php echo $this->Form->end(); ?>
	</div>
	</td>
	<td>
	<div style="float:left; width:300px; display:block; clear:none; margin-left:60px;">
		<h3>Extra Mods</h3>
		<?php echo $this->Form->create('ExtraMod', array('url'=>'/admin/items/add_extra_mod')); ?>
		<table>
			<thead>
				<tr>
					<th>
						Name
					</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($this->data["ExtraMod"] as $am) { ?>
					<tr>
						<td>
							<?php echo $am['name']; ?>
						</td>
						<td>
							<?php echo $this->Html->link("Delete", array('controller'=>'/items/', 'action'=>'admin_delete_extra_mod', $am['id'], $this->data["Item"]["id"]), array(), __('Are you sure you want to delete this Extra Mod?', true)); ?>
						</td>
					</tr>
				<?php } ?>
				<tr>
					<td>
						<?php echo $this->Form->select('ExtraMod.id', $extra_mods); ?>
					</td>
					<td>
						<?php echo $this->Form->hidden('Item.id', array('value'=>$this->data["Item"]["id"])); ?>
						<?php echo $this->Form->submit("Add", array("div"=>"adjz")); ?>
					</td>
				</tr>
			</tbody>
		</table>
		<?php echo $this->Form->end(); ?>
	</div>
	<div style="float:left; width:300px; display:block; clear:none; margin-left:60px;">
		<h3>Keywords</h3>
		<?php echo $this->Form->create('Keyword', array('url'=>'/admin/items/add_keyword')); ?>
		<table>
			<thead>
				<tr>
					<th>
						Name
					</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($this->data["Keyword"] as $am) { ?>
					<tr>
						<td>
							<?php echo $am['keyword']; ?>
						</td>
						<td>
							<?php echo $this->Html->link("Delete", array('controller'=>'/items/', 'action'=>'admin_delete_keyword', $am['id'], $this->data["Item"]["id"]), array(), __('Are you sure you want to delete this Keyword?', true)); ?>
						</td>
					</tr>
				<?php } ?>
				<tr>
					<td>
						<?php echo $this->Form->input('keyword'); ?>
					</td>
					<td>
						<?php echo $this->Form->hidden('item_id', array('value'=>$this->data["Item"]["id"])); ?>
						<?php echo $this->Form->submit("Add", array("div"=>"adjz")); ?>
					</td>
				</tr>
			</tbody>
		</table>
		<?php echo $this->Form->end(); ?>
	</div>
	<div style="float:left; width:300px; display:block; clear:none; margin-left:60px;">
		<h3>Rooms</h3>
		<?php echo $this->Form->create('Room', array('url'=>'/admin/items/add_room')); ?>
		<table>
			<thead>
				<tr>
					<th>
						Name
					</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($this->data["Room"] as $am) { ?>
					<tr>
						<td>
							<?php echo $this->Html->link($am['name'], array('controller'=>'/rooms/', 'action'=>'admin_edit', $am['id']));?>
						</td>
						<td>
							<?php echo $this->Html->link("Delete", array('controller'=>'/items/', 'action'=>'admin_delete_room', $am['id'], $this->data["Item"]["id"]), array(), __('Are you sure you want to delete this Room?', true)); ?>
						</td>
					</tr>
				<?php } ?>
				<tr>
					<td>
						<?php echo $this->Form->select('Room.id', $rooms); ?>
					</td>
					<td>
						<?php echo $this->Form->hidden('Item.id', array('value'=>$this->data["Item"]["id"])); ?>
						<?php echo $this->Form->submit("Add", array("div"=>"adjz")); ?>
					</td>
				</tr>
			</tbody>
		</table>
		<?php echo $this->Form->end(); ?>
	</div>
	</td>
	<td>
	<div style="float:left; width:300px; display:block; clear:none; margin-left:60px;">
		<h3>Mobs</h3>
		<?php echo $this->Form->create('Mob', array('url'=>'/admin/items/add_mob')); ?>
		<table>
			<thead>
				<tr>
					<th>
						Name
					</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($this->data["Mob"] as $am) { ?>
					<tr>
						<td>
							<?php echo $this->Html->link($am['name'], array('controller'=>'/mobs/', 'action'=>'admin_edit', $am['id']));?>
						</td>
						<td>
							<?php echo $this->Html->link("Delete", array('controller'=>'/items/', 'action'=>'admin_delete_mob', $am['id'], $this->data["Item"]["id"]), array(), __('Are you sure you want to delete this Mob?', true)); ?>
						</td>
					</tr>
				<?php } ?>
				<tr>
					<td>
						<?php echo $this->Form->select('Mob.id', $mobs); ?>
					</td>
					<td>
						<?php echo $this->Form->hidden('Item.id', array('value'=>$this->data["Item"]["id"])); ?>
						<?php echo $this->Form->submit("Add", array("div"=>"adjz")); ?>
					</td>
				</tr>
			</tbody>
		</table>
		<?php echo $this->Form->end(); ?>
	</div>
	<div style="float:left; width:300px; display:block; clear:none; margin-left:60px;">
		<h3>Restrictions</h3>
		<?php echo $this->Form->create('CharacterClass', array('url'=>'/admin/items/add_character_class')); ?>
		<table>
			<thead>
				<tr>
					<th>
						Class Name
					</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($this->data["CharacterClass"] as $am) { ?>
					<tr>
						<td>
							<?php echo $this->Html->link($am['name'], array('controller'=>'/character_classs/', 'action'=>'admin_edit', $am['id']));?>
						</td>
						<td>
							<?php echo $this->Html->link("Delete", array('controller'=>'/items/', 'action'=>'admin_delete_character_class', $am['id'], $this->data["Item"]["id"]), array(), __('Are you sure you want to delete this Restriction?', true)); ?>
						</td>
					</tr>
				<?php } ?>
				<tr>
					<td>
						<?php echo $this->Form->select('CharacterClass.id', $restrictions); ?>
					</td>
					<td>
						<?php echo $this->Form->hidden('Item.id', array('value'=>$this->data["Item"]["id"])); ?>
						<?php echo $this->Form->submit("Add", array("div"=>"adjz")); ?>
					</td>
				</tr>
			</tbody>
		</table>
		<?php echo $this->Form->end(); ?>
	</div>
	<div style="float:left; width:300px; display:block; clear:none; margin-left:60px;">
		<h3>Class Group Restrictions</h3>
		<?php echo $this->Form->create('ClassGroup', array('url'=>'/admin/items/add_class_group')); ?>
		<table>
			<thead>
				<tr>
					<th>
						Group Name
					</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($this->data["ClassGroup"] as $am) { ?>
					<tr>
						<td>
							<?php echo $this->Html->link($am['name'], array('controller'=>'/class_groups/', 'action'=>'admin_edit', $am['id']));?>
						</td>
						<td>
							<?php echo $this->Html->link("Delete", array('controller'=>'/items/', 'action'=>'admin_delete_class_group', $am['id'], $this->data["Item"]["id"]), array(), __('Are you sure you want to delete this Restriction?', true)); ?>
						</td>
					</tr>
				<?php } ?>
				<tr>
					<td>
						<?php echo $this->Form->select('ClassGroup.id', $cg_restrictions); ?>
					</td>
					<td>
						<?php echo $this->Form->hidden('Item.id', array('value'=>$this->data["Item"]["id"])); ?>
						<?php echo $this->Form->submit("Add", array("div"=>"adjz")); ?>
					</td>
				</tr>
			<?php } ?>	
			</tbody>
		</table>
		<?php echo $this->Form->end(); ?>
	</div>
</tr>
</table>