<?php
App::import('Controller', 'AdminBase');
class RoomsController extends AdminBaseController {

	var $name = 'Rooms';
	var $uses = array("Zone", "Room", "Mob", "Item", "Exite", "Direction", "ExitType", "SectorType", "RoomType", "RoomTypesRoom", "RoomCoord");

	function admin_index($zone_id=null) {
		if ($zone_id == null)
		{
			$this->set("rooms", $this->Room->find("all"));
		}
		else
		{
			$this->set("zone", $this->Zone->findById($zone_id));
			$this->set("rooms", $this->Room->find("all", array("conditions"=>array("zone_id"=>$zone_id))));
		}
	}

	function admin_edit($id=null, $zone_id=null) {
	    $this->set('sector_type_id', null);
		if(!empty($this->data)) {
			if($this->Room->save($this->data)) {
				$this->Session->setFlash("Room Saved!");
				if ($id == null) $id = $this->Room->id;
				else {
					$this->RoomCoord->deleteAll(array("room_id"=>$id));
				}
				if (isset($this->data["Room"]["x_pos"]) && isset($this->data["Room"]["y_pos"]))
				{
					$this->RoomCoord->save(array("room_id"=>$id, "x_pos"=>$this->data["Room"]["x_pos"], "y_pos"=>$this->data["Room"]["y_pos"]));
				}
				$zone_id = $this->data["Room"]["zone_id"];
				$this->set('sector_type_id', $this->request->data["Room"]["sector_type_id"]);
				$this->redirect('/admin/rooms/edit/'.$id);
			}
		}
		$this->set("zones", $this->Zone->find("list"));
		$this->set("sector_types", $this->SectorType->find("list"));
		if ($id != null && $id!="null")
		{
			$this->data = $this->Room->findById($id);
			$this->set("directions", $this->Direction->find("list"));
			$this->set("exit_types", $this->ExitType->find("list"));
			$this->set("room_types", $this->RoomType->find("list"));
			$this->set("keys", $this->Item->find('list', array('conditions'=>array('item_type_id'=>'8'),
											'fields'=>array('Item.id', 'Item.name', 'Item.zone_id'),
											'seperator'=>" --- ")));
			//$this->set("room_types_rooms", $this->RoomTypesRoom->find("all", array("conditions"=>array("room_id"=>$id), 'recursive'=>2)));
			$this->set("exite_list", $this->Exite->find("all", array("conditions"=>array("room_id"=>$id))));
			$this->set("rooms", $this->Room->find('list', array("conditions"=>"zone_id =".$this->data["Room"]["zone_id"]." OR zone_exit = true",
											'fields'=>array('Room.id', 'Room.name', 'Room.name_secondary'),
											'order'=>array("Room.zone_exit", "Room.name")
																	)
												)
						);
			//$this->set("rooms", $this->Room->find("list", array()));
			$zone_id = $this->data["Room"]["zone_id"];
		}
		if (isset($this->data["RoomCoord"][0]["x_pos"]))
		{
			$this->data["Room"]["x_pos"]=$this->data["RoomCoord"][0]["x_pos"];
			$this->data["Room"]["y_pos"]=$this->data["RoomCoord"][0]["y_pos"];
		}
		$this->set("items", $this->Item->find("list", array("conditions"=>array("Item.zone_id"=>$zone_id))));
		$this->set("mobs", $this->Mob->find("list", array("conditions"=>array("Mob.zone_id"=>$zone_id))));
		$this->set("zone_id", $zone_id);
		if ($zone_id != null) $this->set("zone", $this->Zone->findById($zone_id));
	}
	
	function admin_delete($id) {
		$this->Room->delete($id, true);
		$this->redirect('/admin/rooms/index');
	}
	
	function admin_add_exite()
	{
		$this->Exite->save($this->data);
		$this->redirect('/admin/rooms/edit/'.$this->data["Exite"]["room_id"]);
	}
	
	function admin_delete_exite($id, $room_id)
	{
		$this->Exite->delete($id, true);
		$this->redirect('/admin/rooms/edit/'.$room_id);
	}
	
	function admin_add_room_type()
	{
		$this->RoomType->save($this->data);
		$this->redirect('/admin/rooms/edit/'.$this->data["Room"]["id"]);
	}
	
	function admin_delete_room_type($room_type_id, $room_id)
	{
		$this->Room->RoomTypesRoom->deleteAll(['RoomTypesRoom.room_id'=>$room_id, 'RoomTypesRoom.room_type_id'=>$room_type_id]);
		$this->redirect('/admin/rooms/edit/'.$room_id);
	}
	
	function admin_add_mob()
	{
		$this->Mob->save($this->data);
		$this->redirect('/admin/rooms/edit/'.$this->data["Room"]["id"]);
	}
	
	function admin_delete_mob($mob_id, $room_id)
	{
	    $this->Room->MobsRoom->deleteAll(['MobsRoom.room_id'=>$room_id, 'MobsRoom.mob_id'=>$mob_id]);
		$this->redirect('/admin/rooms/edit/'.$room_id);
	}
	
	function admin_add_item()
	{
		$this->Item->save($this->data);
		$this->redirect('/admin/rooms/edit/'.$this->data["Room"]["id"]);
	}
	
	function admin_delete_item($item_id, $room_id)
	{
	    $this->Room->ItemsRoom->deleteAll(['ItemsRoom.room_id'=>$room_id, 'ItemsRoom.item_id'=>$item_id]);
		$this->redirect('/admin/rooms/edit/'.$room_id);
	}
}
