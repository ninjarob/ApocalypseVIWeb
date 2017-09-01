<style>
	form div.joe {float:left; clear:none;}
	form div.adjz {float:left; clear:none;}
</style>

<h2>Zone</h2>
<?php echo $this->Html->link('Back to Zones', array('controller'=>'/zones/', 'action'=>'index'), array()); ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php if (isset($this->data["Zone"])) {
	echo $this->Html->link('Zone Map', array('controller'=>'/zones/', 'action'=>'map',$this->data["Zone"]["id"]));
}?>
<br/><br/>
<?php echo $this->Form->create('Zone', array('style'=>"float:left; width:850px; display:block; clear:none;")); ?>
	<?php if (isset($this->data["Zone"])) {echo $this->Form->hidden('id', array('value'=>$this->data["Zone"]["id"])); }?>
	<?php echo $this->Form->input('name', array('div'=>'joe', 'style'=>'width:300px;')); ?>
	<?php echo $this->Form->input('zone_number', array('label'=>'Zone Number', 'div'=>'joe', 'style'=>'width:40px;')); ?>
	<?php echo $this->Form->input('description', array('cols'=>2, 'rows'=>'6', 'style'=>'width:800px; font-size:12px;')); ?>
	<?php echo $this->Form->input('authors', array('style'=>'width:800px; font-size:12px;')); ?>
	<?php echo $this->Form->input('min_lvl', array('div'=>'joe', 'style'=>'width:40px; font-size:12px;')); ?>
	<?php echo $this->Form->input('max_lvl', array('div'=>'joe', 'style'=>'width:40px; font-size:12px;')); ?>
	<?php echo $this->Form->input('suggested_min_lvl', array('div'=>'joe', 'style'=>'width:40px; font-size:12px;')); ?>
	<?php echo $this->Form->input('suggested_max_lvl', array('div'=>'joe', 'style'=>'width:40px; font-size:12px;')); ?>
	<?php echo $this->Form->submit(); ?>
<?php echo $this->Form->end(); ?>
<?php if (isset($this->data["Zone"])) { ?>
	<?php if (isset($adjacent_zones)) { ?>
	<table style="float:left; width:500px; display:block; clear:none; margin-left:60px;">
		<tr>
			<td>
				<h3>Adjacent Zones</h3>
				<table>
				<?php foreach ($adjacent_zones as $adjz) { ?>
					<tr>
						<td>
							<?php echo $this->Html->link($adjz['Zone']['name'], array('controller'=>'/zones/', 'action'=>'edit', $adjz['AdjacentZone']['adjacent_zone_id'])); ?>
						</td>
						<td>
							<?php echo $this->Html->link("Delete", array('controller'=>'/zones/', 'action'=>'admin_delete_adjacent_zone', $adjz['AdjacentZone']['id'], $adjz['AdjacentZone']['zone_id']), array(), __('Are you sure you want to delete this as an Adjacent Zone?', true)); ?>
						</td>
					</tr>
				<?php } ?>
				</table>
				<br/>
				<?php echo $this->Form->create('AdjacentZone', array('url'=>'/admin/zones/add_adjacent_zone')); ?>
					<div style="float:left;">
						<?php echo $this->Form->select('adjacent_zone_id', $zones); ?>
					</div>
					<?php echo $this->Form->hidden('zone_id', array('value'=>$this->data["Zone"]["id"])); ?>
					<?php echo $this->Form->submit("Add Adjacent Zone", array("div"=>"adjz")); ?>
				<?php echo $this->Form->end(); ?>
			</td>
		</tr>
	</table>
	<?php } ?>
	<table style="margin-top:60px;">
		<tr>
			<td style="width:300px; padding-right:40px;">
				<h3>Rooms</h3>
				<?php if (isset($this->data["Room"])) { ?>
					<table>
						<thead>
							<tr>
								<th width="200">Room Name</th>
								<th width="40"></th>
							</tr>
						</thead>
						</tbody>
							<?php foreach ($this->data['Room'] as $room) { ?>
								<tr>
									<td>
										<?php echo $this->Html->link($room['name']." ".$room['name_secondary'], array('controller'=>'/rooms/', 'action'=>'edit', $room['id'])); ?>
									</td>
									<td>
										<?php echo $this->Html->link("Delete", array('controller'=>'/zones/', 'action'=>'admin_delete_room', $room['id'], $this->data["Zone"]["id"]), array(), __('Are you sure you want to delete this Room?', true)); ?>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				<?php } ?>
				<br/>
				<?php echo $this->Html->link('Add Room',['controller'=>'/rooms/', 'action'=>'edit', '?'=>['id'=>null,'zone_id'=>$this->data["Zone"]["id"]]]); ?>				
			</td>
			<td>
				<h3>Mobs</h3>
				<?php if (isset($this->data["Mob"])) { ?>
					<table>
						<thead>
							<tr>
								<th width="200">Mob Name</th>
								<th width="40"></th>
							</tr>
						</thead>
						</tbody>
							<?php foreach ($this->data['Mob'] as $mob) { ?>
								<tr>
									<td>
										<?php echo $this->Html->link($mob['name'], array('controller'=>'/mobs/', 'action'=>'edit', $mob['id'])); ?>
									</td>
									<td>
										<?php echo $this->Html->link("Delete", array('controller'=>'/zones/', 'action'=>'admin_delete_mob', $mob['id']), array(), __('Are you sure you want to delete this Mob?', true)); ?>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				<?php } ?>
				<br/>
			    <?php echo $this->Html->link('Add Mob', ['controller'=>'/mobs/', 'action'=>'edit', '?'=>['id'=>null,'zone_id'=>$this->data["Zone"]["id"]]]); ?>
			</td>
			<td>
				<h3>Items</h3>
				<?php if (isset($this->data["Item"])) { ?>
					<table>
						<thead>
							<tr>
								<th width="200">Item Name</th>
								<th width="40"></th>
							</tr>
						</thead>
						</tbody>
							<?php foreach ($this->data['Item'] as $item) { ?>
								<tr>
									<td>
										<?php echo $this->Html->link($item['name'], array('controller'=>'/items/', 'action'=>'edit', $item['id'])); ?>
									</td>
									<td>
										<?php echo $this->Html->link("Delete", array('controller'=>'/zones/', 'action'=>'admin_delete_item', $item['id']), array(), __('Are you sure you want to delete this Item?', true)); ?>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				<?php } ?>
				<br/>
				<?php echo $this->Html->link('Add Item', ['controller'=>'/items/', 'action'=>'edit', '?'=>['id'=>null,'zone_id'=>$this->data["Zone"]["id"],'mob_id'=>null]]); ?>
			</td>
		</tr>
	</table>
<?php } ?>