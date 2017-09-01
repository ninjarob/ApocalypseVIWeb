<style>
	form div.joe {clear:none;}
	form div.adjz {float:left; clear:none;}
</style>
<h2 style="float:left;">Room</h2>
<div style="float:left; margin-left:8px; margin-top:8px;">
	<?php if (isset($zone)) { echo(" (in Zone: "); echo $this->Html->link($zone["Zone"]["name"], array('controller'=>'/zones/', 'action'=>'admin_edit', $zone["Zone"]["id"])).")"; } ?>
</div>
<br/>
<br/>
<div style="float:left; clear:both;">
	<?php echo $this->Html->link('Rooms', array('controller'=>'/rooms/', 'action'=>'index'), array()); ?>
</div>
<br/><br/>
<?php echo $this->Form->create('Room', array('style'=>"float:left; width:550px; display:block; clear:none;")); ?>
	<?php if (isset($this->data["Room"])) {echo $this->Form->hidden('id', array('value'=>$this->data["Room"]["id"])); }?>
	<?php echo $this->Form->input('name', array('div'=>'adjz', 'style'=>'width:300px;')); ?>
	<?php echo $this->Form->input('name_secondary', array('div'=>'joe', 'style'=>'width:120px; font-size:10px;')); ?>
	<br/>
	<?php echo $this->Form->input('zone_id', array('type'=>'select', 'label'=>'Zone', 'options'=>$zones, 'default'=>$zone_id));?>
	<br/>
	<br/>
	<?php echo $this->Form->input('notes', array('cols'=>2, 'rows'=>'2', 'style'=>'width:500px; font-size:12px;')); ?>
	<?php echo $this->Form->input('description', array('cols'=>2, 'rows'=>'6', 'style'=>'width:500px; font-size:12px;')); ?>
	<?php echo $this->Form->input('sector_type_id', array('type'=>'select', 'label'=>'Sector Type', 'options'=>$sector_types, 'default'=>$sector_type_id));?>
	<br/>
	<br/>
	<label for="zone_exit">Zone Exit?</label>
	<?php echo $this->Form->checkbox('zone_exit'); ?>
	<br/>
	<br/>
	<?php echo $this->Form->input('x_pos', array('div'=>'adjz', 'style'=>'width:100px; font-size:10px;')); ?>
	<?php echo $this->Form->input('y_pos', array('div'=>'adjz', 'style'=>'width:100px; font-size:10px;')); ?>
	<?php echo $this->Form->input('danger_level', array('default'=>0, 'div'=>'adjz', 'style'=>'width:30px; font-size:10px;')); ?>
	<?php echo $this->Form->submit(); ?>
<?php echo $this->Form->end(); ?>
<?php if (isset($this->data["Room"])) { ?>
	<?php if (isset($directions)) { ?>
	<div style="float:left; width:50%; display:block; clear:none; margin-left:60px;">
		<h3>Exits</h3>
		<?php echo $this->Form->create('Exite', array('url'=>'/admin/rooms/add_exite')); ?>
		<table>
			<thead>
				<tr>
					<th>
						Direction
					</th>
					<th>
						Destination
					</th>
					<th>
						Type
					</th>
					<th>
						Key
					</th>
					<th>
						Look Description
					</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($exite_list as $exite) { ?>
					<tr>
						<td>
							<?php echo $exite['Direction']['long_name']; ?>
						</td>
						<td>
							<?php echo $this->Html->link($exite['Destination']['name'].' '.$exite['Destination']['name_secondary'], array('controller'=>'/rooms/', 'action'=>'edit', $exite['Destination']['id'])); ?>
						</td>
						<td>
							<?php echo $exite['ExitType']['name'] ?>
						</td>
						<td>
							<?php echo $exite['Key']['name'] ?>
						</td>
						<td>
							<?php echo $exite['Exite']['look_description'] ?>
						</td>
						<td>
							<?php echo $this->Html->link("Delete", array('controller'=>'/rooms/', 'action'=>'admin_delete_exite', $exite['Exite']['id'], $exite['Room']['id']), array(), __('Are you sure you want to delete this Exit?', true)); ?>
						</td>
					</tr>
				<?php } ?>
				<tr>
					<td>
						<?php echo $this->Form->select('direction_id', $directions); ?>
					</td>
					<td>
						<?php echo $this->Form->select('exit_room_id', $rooms); ?>
					</td>
					<td>
						<?php echo $this->Form->select('exit_type_id', $exit_types); ?>
					</td>
					<td>
						<?php echo $this->Form->select('key_id', $keys); ?>
					</td>
					<td>
						<?php echo $this->Form->input('look_description', array('label'=>false, 'div'=>'adjz', 'style'=>'width:100px; font-size:10px;')); ?>
					</td>
					<td>
						<?php echo $this->Form->hidden('room_id', array('value'=>$this->data["Room"]["id"])); ?>
						<?php echo $this->Form->submit("Add Exit", array("div"=>"adjz")); ?>
					</td>
				</tr>
			</tbody>
		</table>
		<?php echo $this->Form->end(); ?>
	</div>
	<?php } ?>
	<div style="float:left; width:50%; display:block; clear:none; margin-left:60px;">
		<h3>Room Types</h3>
		<?php echo $this->Form->create('RoomType', array('url'=>'/admin/rooms/add_room_type')); ?>
		<table>
			<thead>
				<tr>
					<th>
						Type
					</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($this->data["RoomType"] as $rt) { ?>
					<tr>
						<td>
							<?php echo $rt['name']; ?>
						</td>
						<td>
							<?php echo $this->Html->link("Delete", array('controller'=>'/rooms/', 'action'=>'admin_delete_room_type', $rt['id'], $this->data["Room"]["id"]), array(), __('Are you sure you want to delete this Room Type?', true)); ?>
						</td>
					</tr>
				<?php } ?>
				<tr>
					<td>
						<?php echo $this->Form->select('RoomType.id', $room_types); ?>
					</td>
					<td>
						<?php echo $this->Form->hidden('Room.id', array('value'=>$this->data["Room"]["id"])); ?>
						<?php echo $this->Form->submit("Add Room Type", array("div"=>"adjz")); ?>
					</td>
				</tr>
			</tbody>
		</table>
		<?php echo $this->Form->end(); ?>
	</div>
	<div style="float:left; width:50%; display:block; clear:none; margin-left:60px;">
		<h3>Mobs</h3>
		<?php echo $this->Form->create('Mob', array('url'=>'/admin/rooms/add_mob')); ?>
		<table>
			<thead>
				<tr>
					<th>
						Name
					</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($this->data["Mob"] as $rt) { ?>
					<tr>
						<td>
							<?php echo $this->Html->link($rt['name'], array('controller'=>'/mobs/', 'action'=>'admin_edit', $rt['id']));?>
						</td>
						<td>
							<?php echo $this->Html->link("Delete", array('controller'=>'/rooms/', 'action'=>'admin_delete_mob', $rt['id'], $this->data["Room"]["id"]), array(), __('Are you sure you want to delete this Mob?', true)); ?>
						</td>
					</tr>
				<?php } ?>
				<tr>
					<td>
						<?php echo $this->Form->select('Mob.id', $mobs); ?>
					</td>
					<td>
						<?php echo $this->Form->hidden('Room.id', array('value'=>$this->data["Room"]["id"])); ?>
						<?php echo $this->Form->submit("Add Mob", array("div"=>"adjz")); ?>
					</td>
				</tr>
			</tbody>
		</table>
		<?php echo $this->Form->end(); ?>
	</div>
	<div style="float:left; width:50%; display:block; clear:none; margin-left:60px;">
		<h3>Items</h3>
		<?php echo $this->Form->create('Item', array('url'=>'/admin/rooms/add_item')); ?>
		<table>
			<thead>
				<tr>
					<th>
						Name
					</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($this->data["Item"] as $rt) { ?>
					<tr>
						<td>
							<?php echo $this->Html->link($rt['name'], array('controller'=>'/items/', 'action'=>'admin_edit', $rt['id']));?>
						</td>
						<td>
							<?php echo $this->Html->link("Delete", array('controller'=>'/rooms/', 'action'=>'admin_delete_item', $rt['id'], $this->data["Room"]["id"]), array(), __('Are you sure you want to delete this Item?', true)); ?>
						</td>
					</tr>
				<?php } ?>
				<tr>
					<td>
						<?php echo $this->Form->select('Item.id', $items); ?>
					</td>
					<td>
						<?php echo $this->Form->hidden('Room.id', array('value'=>$this->data["Room"]["id"])); ?>
						<?php echo $this->Form->submit("Add Item", array("div"=>"adjz")); ?>
					</td>
				</tr>
			</tbody>
		</table>
		<?php echo $this->Form->end(); ?>
	</div>
<?php } ?>