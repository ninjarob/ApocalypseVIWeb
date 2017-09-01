<?php
App::import('Controller', 'AdminBase');
class ZonesController extends AdminBaseController {

	var $name = 'Zones';
	var $uses = array("Zone", "AdjacentZone", "Mob", "Item", "Room");

	function admin_index() {
		$this->set("zones", $this->Zone->find("all", array("order"=>"zone_number")));
	}

	function admin_edit($id=null) {
		$this->set("zones", $this->Zone->find("list", array("order"=>"zone_number")));
		if(!empty($this->data)) {
		    if (!isset($this->request->data["Zone"]["base_x_pos"]))$this->request->data["Zone"]["base_x_pos"] = 0;
		    if (!isset($this->request->data["Zone"]["base_y_pos"]))$this->request->data["Zone"]["base_y_pos"] = 0; 
		    if($this->Zone->save($this->request->data)) {
				$this->Session->setFlash("Zone Saved!");
				if ($id == null) $id = $this->Zone->id;
				$this->redirect('/admin/zones/edit/'.$id);
			}
		}
		if ($id != null && $id != "null")
		{
			$this->set("rooms", $this->Room->find("all", ["conditions"=>["zone_id", $id]]));
			$this->set("adjacent_zones", $this->AdjacentZone->find("all", array("conditions"=>array("zone_id"=>$id))));
			$this->request->data = $this->Zone->findById($id);
		}
	}

	function admin_delete($id) {
		$this->Zone->delete($id, true);
		$this->redirect('/admin/zones/index');
	}

	
	function admin_add_adjacent_zone()
	{
		if(!empty($this->data)) {
			if($this->AdjacentZone->save($this->data)) {
				$this->Session->setFlash("Adjacent Zone Saved!");
				$this->redirect('/admin/zones/edit/'.$this->data['AdjacentZone']['zone_id']);
			}
		}
		$this->redirect('/admin/zones/index');
	}
	
	function admin_delete_adjacent_zone($id, $zone_id)
	{
		$this->AdjacentZone->delete($id, true);
		$this->redirect('/admin/zones/edit/'.$zone_id);
	}
	
	function admin_delete_room($id, $zone_id) {
		$this->Room->delete($id, true);
		$this->redirect('/admin/zones/edit/'.$zone_id);
	}
	
	function admin_map($id)
	{
		$zone=$this->Zone->find("first", array('conditions'=>array("id"=>$id), 'recursive'=>0));
		$this->set("zone", $zone);
		$this->set("basex", $zone['Zone']['base_x_pos']);
		$this->set("basey", $zone['Zone']['base_y_pos']);
		$this->set("rooms", $this->Room->find("all", ['conditions'=>['Room.zone_id'=>$id], 'recursion'=>1]));
		$this->set("mobs", $this->Mob->find("all", ['conditions'=>['Mob.zone_id'=>$id], 'recursion'=>1]));
		$this->set("items", $this->Item->find("all", ['conditions'=>['Item.zone_id'=>$id], 'recursion'=>1]));
	}
	
	function map($id)
	{
	    $zone=$this->Zone->find("first", array('conditions'=>array("id"=>$id), 'recursive'=>0));
	    $this->set("zone", $zone);
	    $this->set("basex", $zone['Zone']['base_x_pos']);
	    $this->set("basey", $zone['Zone']['base_y_pos']);
	    $this->set("rooms", $this->Room->find("all", array('conditions'=>array('Room.zone_id'=>$id), 'recursion'=>1)));
	    $this->set("mobs", $this->Mob->find("all", array('conditions'=>array('Mob.zone_id'=>$id), 'recursion'=>1)));
	    $this->set("items", $this->Item->find("all", array('conditions'=>array('Item.zone_id'=>$id), 'recursion'=>1)));
	}
	
	function admin_change_base()
	{
		if($this->Zone->save($this->data)) {
			$this->redirect('/admin/zones/map/'.$this->data["Zone"]["id"]);
		}
	}
}