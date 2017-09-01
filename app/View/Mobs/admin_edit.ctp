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
		if ('<?php echo $this->data["Mob"]["mob_type_id"]?>' == 1)
		{
			$(".weapon").show();
		}
		if ('<?php echo $this->data["Mob"]["mob_type_id"]?>' == 2)
		{
			$(".armor").show();
		}
	});
	
	function changeType()
	{
		$(".armor").hide();
		$(".weapon").hide();
		var val = $("#MobMobTypeId").selectedValues()[0];
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
<h2 style="float:left;">Mob</h2>
<div style="float:left; margin-left:8px; margin-top:8px;">
	<?php if (isset($zone)) { echo(" (in Zone: "); echo $this->Html->link($zone["Zone"]["name"], array('controller'=>'/zones/', 'action'=>'admin_edit', $zone["Zone"]["id"])).")"; } ?>
</div>
<br/>
<br/>
<div style="float:left; clear:both;">
	<?php echo $this->Html->link('Mobs', array('controller'=>'/mobs/', 'action'=>'index'), array()); ?>
</div>
<br/><br/>
<?php echo $this->Form->create('Mob', array('style'=>"float:left; width:1060px; display:block; clear:none;")); ?>
	<table style="clear:none; float:left; width:500px;">
		<tr>
			<td>
				<?php if (isset($this->data["Mob"])) {echo $this->Form->hidden('id', array('value'=>$this->data["Mob"]["id"])); }?>
				<?php echo $this->Form->input('name', array('div'=>'joe', 'style'=>'width:300px;')); ?>
				<?php echo $this->Form->input('description', array('cols'=>2, 'rows'=>'3', 'style'=>'width:450px; font-size:12px;')); ?>
				<br>
				<div class="joe required">
				<?php echo $this->Form->input('zone_id', array('type'=>'select', 'label'=>'Zone', 'options'=>$zones, 'default'=>$zone_id));?>
				</div>
				<br>
				<br>
				<div class="adjz required">
				<?php echo $this->Form->input('gender_id', array('type'=>'select', 'label'=>'Gender', 'options'=>$genders, 'default'=>$gender_id));?>
				</div>
				<div class="adjz required">
				<?php echo $this->Form->input('race_id', array('type'=>'select', 'label'=>'Race', 'options'=>$genders, 'default'=>$race_id));?>
				</div>
				<div class="adjz required">
				<?php echo $this->Form->input('character_class_id', array('type'=>'select', 'label'=>'Character Class', 'options'=>$character_classes, 'default'=>$character_class_id));?>
				</div>
				<div class="adjz">
				<?php echo $this->Form->input('size_id', array('type'=>'select', 'label'=>'Size', 'options'=>$sizes, 'default'=>$size_id));?>
				</div>
			</td>
		</tr>
	</table>
	<div style="float:left; width:410px; display:block; clear:none; margin-left:60px;">
		<h3>Attributes</h3>
		<table>
			<tr>
				<td>
					<?php echo $this->Form->input("str_amt", array('label'=>'Str:', 'style'=>'font-size:12px; width:40px;')); ?>
				</td>
				<td>
					<?php echo $this->Form->input("int_amt", array('label'=>'Int:', 'style'=>'font-size:12px; width:40px;')); ?>
				</td>
				<td>
					<?php echo $this->Form->input("wis_amt", array('label'=>'Wis:', 'style'=>'font-size:12px; width:40px;')); ?>
				</td>
				<td>
					<?php echo $this->Form->input("dex_amt", array('label'=>'Dex:', 'style'=>'font-size:12px; width:40px;')); ?>
				</td>
				<td>
					<?php echo $this->Form->input("con_amt", array('label'=>'Con:', 'style'=>'font-size:12px; width:40px;')); ?>
				</td>
				<td>
					<?php echo $this->Form->input("cha_amt", array('label'=>'Cha:', 'style'=>'font-size:12px; width:40px;')); ?>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo $this->Form->input("level_amt", array('label'=>'Level:', 'style'=>'font-size:12px; width:40px;')); ?>
				</td>
				<td>
					<?php echo $this->Form->input("hit_amt", array('label'=>'Hit:', 'style'=>'font-size:12px; width:40px;')); ?>
				</td>
				<td>
					<?php echo $this->Form->input("mana_amt", array('label'=>'Mana:', 'style'=>'font-size:12px; width:40px;')); ?>
				</td>
				<td>
					<?php echo $this->Form->input("move_amt", array('label'=>'Move:', 'style'=>'font-size:12px; width:40px;')); ?>
				</td>
				<td>
					<?php echo $this->Form->input("ap_amt", array('label'=>'AP:', 'style'=>'font-size:12px; width:40px;')); ?>
				</td>
				<td>
					<?php echo $this->Form->input("attack_amt", array('label'=>'Attacks:', 'style'=>'font-size:12px; width:40px;')); ?>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo $this->Form->input("para_amt", array('label'=>'Para:', 'style'=>'font-size:12px; width:40px;')); ?>
				</td>
				<td>
					<?php echo $this->Form->input("rod_amt", array('label'=>'Rod:', 'style'=>'font-size:12px; width:40px;')); ?>
				</td>
				<td>
					<?php echo $this->Form->input("petri_amt", array('label'=>'Petri:', 'style'=>'font-size:12px; width:40px;')); ?>
				</td>
				<td>
					<?php echo $this->Form->input("breath_amt", array('label'=>'Breath:', 'style'=>'font-size:12px; width:40px;')); ?>
				</td>
				<td>
					<?php echo $this->Form->input("sspell_amt", array('label'=>'Spell:', 'style'=>'font-size:12px; width:40px;')); ?>
				</td>
				<td>
					<?php echo $this->Form->input("align_amt", array('label'=>'Align:', 'style'=>'font-size:12px; width:40px;')); ?>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo $this->Form->input("agr_amt", array('label'=>'Agro:', 'style'=>'font-size:12px; width:40px;')); ?>
				</td>
				<td>
					<?php echo $this->Form->input("age_amt", array('label'=>'Age:', 'style'=>'font-size:12px; width:40px;')); ?>
				</td>
				<td>
					<?php echo $this->Form->input("hitr_amt", array('label'=>'Hitroll:', 'style'=>'font-size:12px; width:40px;')); ?>
				</td>
				<td>
					<?php echo $this->Form->input("damr_amt", array('label'=>'Damroll:', 'style'=>'font-size:12px; width:40px;')); ?>
				</td>
				<td>
					<?php echo $this->Form->input("hitg_amt", array('label'=>'HGain:', 'style'=>'font-size:12px; width:40px;')); ?>
				</td>
				<td>
					<?php echo $this->Form->input("manag_amt", array('label'=>'MGain:', 'style'=>'font-size:12px; width:40px;')); ?>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo $this->Form->input("moveg_amt", array('label'=>'MoGain:', 'style'=>'font-size:12px; width:40px;')); ?>
				</td>
				<td>
					<?php echo $this->Form->input("spell_amt", array('label'=>'Spell:', 'style'=>'font-size:12px; width:40px;')); ?>
				</td>
			</tr>
		</table>
	</div>
	<?php echo $this->Form->submit(); ?>
<?php echo $this->Form->end(); ?>
<?php if (isset($this->data["Mob"])) { ?>
	<div style="float:left; width:450px; display:block; clear:none; margin-left:60px;">
		<h3>Apply Mods</h3>
		<?php echo $this->Form->create('ApplyMod', array('url'=>'/admin/mobs/add_apply_mod')); ?>
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
							<?php echo $this->Html->link("Delete", array('controller'=>'/mobs/', 'action'=>'admin_delete_apply_mod', $am['id'], $this->data["Mob"]["id"]), array(), __('Are you sure you want to delete this Apply Mod?', true)); ?>
						</td>
					</tr>
				<?php } ?>
				<tr>
					<td>
						<?php echo $this->Form->input('ApplyMod.id', array('type'=>'select', 'options'=>$apply_mods, 'label'=>''),array("style"=>"width:120px;"));?>
					</td>
					<td>
						<?php echo $this->Form->hidden('Mob.id', array('value'=>$this->data["Mob"]["id"])); ?>
						<?php echo $this->Form->submit("Add Apply Mod", array("div"=>"adjz")); ?>
					</td>
				</tr>
			</tbody>
		</table>
		<?php echo $this->Form->end(); ?>
	</div>
	<div style="float:left; width:450px; display:block; clear:none; margin-left:60px;">
		<h3>Items</h3>
		<?php echo $this->Form->create('Item', array('url'=>'/admin/mobs/add_item')); ?>
		<table>
			<thead>
				<tr>
					<th>
						Name
					</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($this->data["Item"] as $am) { ?>
					<tr>
						<td>
							<?php echo $this->Html->link($am['name'], array('controller'=>'/items/', 'action'=>'admin_edit', $am['id']));?>
						</td>
						<td>
							<?php echo $this->Html->link("Delete", array('controller'=>'/mobs/', 'action'=>'admin_delete_item', $am['id'], $this->data["Mob"]["id"]), array(), __('Are you sure you want to delete this Item?', true)); ?>
						</td>
					</tr>
				<?php } ?>
				<tr>
					<td>
						<?php echo $this->Form->input('Item.id', array('type'=>'select', 'options'=>$items, 'label'=>''),array("style"=>"width:120px;"));?>
					</td>
					<td>
						<?php echo $this->Form->hidden('Mob.id', array('value'=>$this->data["Mob"]["id"])); ?>
						<?php echo $this->Form->submit("Add Item", array("div"=>"adjz")); ?>
					</td>
				</tr>
			</tbody>
		</table>
		<?php echo $this->Form->end(); ?>
	</div>
	<div style="float:left; width:450px; display:block; clear:none; margin-left:60px;">
		<h3>Rooms</h3>
		<?php echo $this->Form->create('Room', array('url'=>'/admin/mobs/add_room')); ?>
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
							<?php echo $this->Html->link("Delete", array('controller'=>'/mobs/', 'action'=>'admin_delete_room', $am['id'], $this->data["Mob"]["id"]), array(), __('Are you sure you want to delete this Room?', true)); ?>
						</td>
					</tr>
				<?php } ?>
				<tr>
					<td>
						<?php echo $this->Form->input('Room.id', array('type'=>'select', 'options'=>$rooms, 'label'=>''),array("style"=>"width:120px;"));?>
					</td>
					<td>
						<?php echo $this->Form->hidden('Mob.id', array('value'=>$this->data["Mob"]["id"])); ?>
						<?php echo $this->Form->submit("Add Room", array("div"=>"adjz")); ?>
					</td>
				</tr>
			</tbody>
		</table>
		<?php echo $this->Form->end(); ?>
	</div>
<?php } ?>