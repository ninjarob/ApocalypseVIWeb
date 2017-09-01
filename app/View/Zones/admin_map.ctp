<style>
.room {
	width:40px;
	height:20px;
	border:1px solid;
	position:absolute;
	text-align:center;
	font-size:9px;
}

.danger0 {
	color: #0BE02B;
}

.danger1 {
	color: #AABBCC;
}

.danger2 {
	color: #EDD118;
}

.danger3 {
	color: #F72525;
}

.room_selected {
	position:absolute;
	text-align:center;
	font-size:9px;
	width:38px;
	height:18px;
	border: 2px solid;
}

.info {
	background: white;
	display:none;
	width:500px;
	height:500px;
	border: 1px solid;
	position:fixed;
	right:0px;
	top:0px;
}

.direction {
	clear:none;
	margin:0;
	padding:0;
	width:8px;
	height:8px;
	position:absolute;
	border: 1px solid;
}

.rooms_list {
	font-size:9px;
	width:200px;
	height:250px;
	overflow: auto;
	border:1px solid;
	clear:both;
}
.mobs_list {
	font-size:9px;
	width:200px;
	height:250px;
	overflow: auto;
	border:1px solid;
}
.items_list {
	font-size:9px;
	width:200px;
	height:250px;
	overflow: auto;
	border:1px solid;
}
.map {
	float:left;
	clear:none;
	width:1250px;
	height:1100px;
	border:solid 1px;
	margin-left:20px;
}
</style>
<script type="text/javascript">
	var XSTART = 200;
	var YSTART = 200;
	function highlightRoom(id)
	{
		$("#room"+id).addClass('room_selected');
	}
	
	function unhighlightRoom(id)
	{
		$("#room"+id).removeClass('room_selected');
	}
	
	function showInfoForRoom(name, description)
	{
		$(".info").html("");
		$(".info").append("<h4>"+name+"</h4>");
		$(".info").append("<div>"+description+"</div>");
		$(".info").show();
	}
	
	function hideInfoForRoom(name, description)
	{
		$(".info").hide();
	}
	
	function showAddRoomModal()
	{
		$("#add_room").dialog();
	}
</script>
<h3><?php $zone["Zone"]["name"]?></h3>
<?php echo $this->Html->link('back to zones', array('controller'=>'/zones/', 'action'=>'index'), array()); ?>
<h2><?php echo $zone["Zone"]["name"]?></h2>
<div class="lists" style="float:left; clear:none;">
<?php echo $this->Form->create('Zone', array('url'=>'/admin/zones/change_base', 'style'=>"float:left; width:100px; display:inline; clear:none;")); ?>
	<?php echo $this->Form->hidden('id', array('value'=>$zone["Zone"]["id"]));?>
	<table class="empty" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td>
				<?php echo $this->Form->input('base_x_pos', array('label'=>'X', 'div'=>'joe', 'style'=>'width:40px; height:12px; font-size:10px; float:left;', 'value'=>$zone["Zone"]["base_x_pos"])); ?>
			</td>
			<td>
				<?php echo $this->Form->input('base_y_pos', array('label'=>'Y', 'div'=>'joe', 'style'=>'width:40px; height:12px; font-size:10px; float:left;', 'value'=>$zone["Zone"]["base_y_pos"])); ?>
			</td>
			<td>
				<div style="font-size:10px;">
					<?php echo $this->Form->submit("GO"); ?>
				</div>
			</td>
		</tr>
	</table>
<?php echo $this->Form->end(); ?>
	<div class="rooms_list">
		<h3 style='clear: none; display: block; float: left;'>Rooms</h3>
		<a href=""
			style='clear: none; display: block; float: left; margin-left: 5px;'
			onclick="showAddRoomModal(); return false;"> add room </a>
		<ul style="clear: both;">
		<?php foreach ($rooms as $room) { ?>
			<?php $roomDesc = substr(str_replace("'", " ", $room['Room']['description']), 0, 100)."..."; ?>
			<?php $roomName = str_replace("'", " ", $room['Room']['name']).' '.$room['Room']['name_secondary']; ?>
			<li
				onmouseover="showInfoForRoom('<?php echo $roomName ?>', '<?php echo $roomDesc;?>'); highlightRoom(<?php echo $room['Room']['id'] ?>);"
				onmouseout="hideInfoForRoom(); unhighlightRoom(<?php echo $room['Room']['id'] ?>);">
				<?php echo $this->Html->link($roomName, array('controller'=>'/rooms/', 'action'=>'edit', $room['Room']["id"])); ?>
			</li>
		<?php } ?>
		</ul>
	</div>
	<br/>
	<div class="mobs_list">
		<h3>Mobs</h3>
		<ul>
		<?php foreach ($mobs as $mob) { ?>
			<li>
				<?php echo $this->Html->link($mob["Mob"]["name"], array('controller'=>'/mobs/', 'action'=>'edit', $mob["Mob"]["id"]), array()); ?>
			</li>
		<?php } ?>
		</ul>
	</div>
	<br/>
	<div class="items_list">
		<h3>Items</h3>
		<ul>
		<?php foreach ($items as $item) { ?>
			<li>
				<?php echo $this->Html->link($item["Item"]["name"], array('controller'=>'/items/', 'action'=>'edit', $item["Item"]["id"]), array()); ?>
			</li>
		<?php } ?>
		</ul>
	</div>
</div>
<div class="map">
	<?php foreach ($rooms as $room) { ?>
		<?php if (isset($room['RoomCoord'][0]['x_pos'])) { ?>
			
			<?php $roomDesc = substr(str_replace("'", " ", $room['Room']['description']), 0, 100)."..."; ?>
			<?php $roomName = str_replace("'", " ", $room['Room']['name']).' '.$room['Room']['name_secondary']; ?>
			<div class="room danger<?php echo($room['Room']['danger_level'])?>" style="left:<?php echo($room['RoomCoord'][0]['x_pos']+$basex) ?>px; top:<?php echo($room['RoomCoord'][0]['y_pos']+$basey)?>px;" id="room<?php echo $room['Room']['id']?>"
						onmouseover="showInfoForRoom('<?php echo $roomName ?>', '<?php echo $roomDesc;?>')" onmouseout="hideInfoForRoom();">

			</div>
			<?php foreach ($room["Exite"] as $exit) { ?>
				<?php if ($exit['direction_id'] == 1 /*north*/) { ?>
					<div class="direction" style="left:<?php echo($room['RoomCoord'][0]['x_pos']+$basex+16) ?>px; top:<?php echo($room['RoomCoord'][0]['y_pos']+$basey-9)?>px;"
					     onmouseover="highlightRoom(<?php echo($exit['exit_room_id'])?>)" onmouseout="unhighlightRoom(<?php echo($exit['exit_room_id'])?>)">
						
					</div>
				<?php } ?>
				<?php if ($exit['direction_id'] == 2 /*south*/) { ?>
					<div class="direction" style="left:<?php echo($room['RoomCoord'][0]['x_pos']+$basex+16) ?>px; top:<?php echo($room['RoomCoord'][0]['y_pos']+$basey+21)?>px;"
					onmouseover="highlightRoom(<?php echo($exit['exit_room_id'])?>)" onmouseout="unhighlightRoom(<?php echo($exit['exit_room_id'])?>)">
						
					</div>
				<?php } ?>
				<?php if ($exit['direction_id'] == 3 /*east*/) { ?>
					<div class="direction" style="left:<?php echo($room['RoomCoord'][0]['x_pos']+$basex+41) ?>px; top:<?php echo($room['RoomCoord'][0]['y_pos']+$basey+6)?>px;"
					onmouseover="highlightRoom(<?php echo($exit['exit_room_id'])?>)" onmouseout="unhighlightRoom(<?php echo($exit['exit_room_id'])?>)">
						
					</div>
				<?php } ?>
				<?php if ($exit['direction_id'] == 4 /*west*/) { ?>
					<div class="direction" style="left:<?php echo($room['RoomCoord'][0]['x_pos']+$basex-9) ?>px; top:<?php echo($room['RoomCoord'][0]['y_pos']+$basey+6)?>px;"
					onmouseover="highlightRoom(<?php echo($exit['exit_room_id'])?>)" onmouseout="unhighlightRoom(<?php echo($exit['exit_room_id'])?>)">
						
					</div>
				<?php } ?>
				<?php if ($exit['direction_id'] == 5 /*up*/) { ?>
					<div class="direction" style="left:<?php echo($room['RoomCoord'][0]['x_pos']+$basex+32) ?>px; top:<?php echo($room['RoomCoord'][0]['y_pos']+$basey-9)?>px;"
					onmouseover="highlightRoom(<?php echo($exit['exit_room_id'])?>)" onmouseout="unhighlightRoom(<?php echo($exit['exit_room_id'])?>)">						
					</div>
				<?php } ?>
				<?php if ($exit['direction_id'] == 6 /*down*/) { ?>
					<div class="direction" style="left:<?php echo($room['RoomCoord'][0]['x_pos']+$basex) ?>px; top:<?php echo($room['RoomCoord'][0]['y_pos']+$basey+21)?>px;"
					onmouseover="highlightRoom(<?php echo($exit['exit_room_id'])?>)" onmouseout="unhighlightRoom(<?php echo($exit['exit_room_id'])?>)">
						
					</div>
				<?php } ?>
			<?php } ?>
		<?php } ?>
	<?php } ?>
</div>
<div class="info">
	
</div>
<div id="add_room" style="display:none;">
	
</div>