<?php
App::import('Controller', 'AdminBase');
class MobsController extends AdminBaseController {

	var $name = 'Mobs';
	var $uses = array("Zone", "Item", "Mob", "Item", "Size", "ApplyMod", "Attribute", "Gender", "Race", "CharacterClass", "AttributesMob", "Room");

	function admin_index($zone_id=null) {
		if ($zone_id == null || $zone_id == "null")
		{
			$this->set("mobs", $this->Mob->find("all"));
		}
		else if ($zone_id != null && $zone_id != "null")
		{
			$this->set("zone", $this->Zone->findById($zone_id));
			$this->set("mobs", $this->Mob->find("all", array("conditions"=>array("zone_id"=>$zone_id))));
		}
	}

	function admin_edit($id=null, $zone_id=null) {
	    $this->set('gender_id', null);
	    $this->set('race_id', null);
	    $this->set('character_class_id', null);
	    $this->set('size_id', null);
		if(!empty($this->request->data)) {
			if($this->Mob->save($this->request->data)) {
				$eal = null;
				if ($id == null)
				{
					$id = $this->Mob->id;
				}
				else
				{
					$this->AttributesMob->deleteAll(array("mob_id"=>$id), true);
				}
				if (is_numeric($this->request->data["Mob"]["str_amt"])) {$this->AttributesMob->create(); $this->AttributesMob->save(array("attribute_id"=>1, "mob_id"=>$id, "amount"=>$this->request->data["Mob"]["str_amt"]));}
				if (is_numeric($this->request->data["Mob"]["int_amt"])) {$this->AttributesMob->create(); $this->AttributesMob->save(array("attribute_id"=>2, "mob_id"=>$id, "amount"=>$this->request->data["Mob"]["int_amt"]));}
				if (is_numeric($this->request->data["Mob"]["wis_amt"])) {$this->AttributesMob->create(); $this->AttributesMob->save(array("attribute_id"=>3, "mob_id"=>$id, "amount"=>$this->request->data["Mob"]["wis_amt"]));}
				if (is_numeric($this->request->data["Mob"]["dex_amt"])) {$this->AttributesMob->create(); $this->AttributesMob->save(array("attribute_id"=>4, "mob_id"=>$id, "amount"=>$this->request->data["Mob"]["dex_amt"]));}
				if (is_numeric($this->request->data["Mob"]["con_amt"])) {$this->AttributesMob->create(); $this->AttributesMob->save(array("attribute_id"=>5, "mob_id"=>$id, "amount"=>$this->request->data["Mob"]["con_amt"]));}
				if (is_numeric($this->request->data["Mob"]["cha_amt"])) {$this->AttributesMob->create(); $this->AttributesMob->save(array("attribute_id"=>6, "mob_id"=>$id, "amount"=>$this->request->data["Mob"]["cha_amt"]));}
				if (is_numeric($this->request->data["Mob"]["hitr_amt"])) {$this->AttributesMob->create(); $this->AttributesMob->save(array("attribute_id"=>7, "mob_id"=>$id, "amount"=>$this->request->data["Mob"]["hitr_amt"]));}
				if (is_numeric($this->request->data["Mob"]["damr_amt"])) {$this->AttributesMob->create(); $this->AttributesMob->save(array("attribute_id"=>8, "mob_id"=>$id, "amount"=>$this->request->data["Mob"]["damr_amt"]));}
				if (is_numeric($this->request->data["Mob"]["hit_amt"])) {$this->AttributesMob->create(); $this->AttributesMob->save(array("attribute_id"=>9, "mob_id"=>$id, "amount"=>$this->request->data["Mob"]["hit_amt"]));}
				if (is_numeric($this->request->data["Mob"]["move_amt"])) {$this->AttributesMob->create(); $this->AttributesMob->save(array("attribute_id"=>10, "mob_id"=>$id, "amount"=>$this->request->data["Mob"]["move_amt"]));}
				if (is_numeric($this->request->data["Mob"]["mana_amt"])) {$this->AttributesMob->create(); $this->AttributesMob->save(array("attribute_id"=>11, "mob_id"=>$id, "amount"=>$this->request->data["Mob"]["mana_amt"]));}
				if (is_numeric($this->request->data["Mob"]["hitg_amt"])) {$this->AttributesMob->create(); $this->AttributesMob->save(array("attribute_id"=>12, "mob_id"=>$id, "amount"=>$this->request->data["Mob"]["hitg_amt"]));}
				if (is_numeric($this->request->data["Mob"]["moveg_amt"])) {$this->AttributesMob->create(); $this->AttributesMob->save(array("attribute_id"=>13, "mob_id"=>$id, "amount"=>$this->request->data["Mob"]["moveg_amt"]));}
				if (is_numeric($this->request->data["Mob"]["manag_amt"])) {$this->AttributesMob->create(); $this->AttributesMob->save(array("attribute_id"=>14, "mob_id"=>$id, "amount"=>$this->request->data["Mob"]["manag_amt"]));}
				if (is_numeric($this->request->data["Mob"]["age_amt"])) {$this->AttributesMob->create(); $this->AttributesMob->save(array("attribute_id"=>15, "mob_id"=>$id, "amount"=>$this->request->data["Mob"]["age_amt"]));}
				if (is_numeric($this->request->data["Mob"]["spell_amt"])) {$this->AttributesMob->create(); $this->AttributesMob->save(array("attribute_id"=>16, "mob_id"=>$id, "amount"=>$this->request->data["Mob"]["spell_amt"]));}
				if (is_numeric($this->request->data["Mob"]["para_amt"])) {$this->AttributesMob->create(); $this->AttributesMob->save(array("attribute_id"=>17, "mob_id"=>$id, "amount"=>$this->request->data["Mob"]["para_amt"]));}
				if (is_numeric($this->request->data["Mob"]["breath_amt"])) {$this->AttributesMob->create(); $this->AttributesMob->save(array("attribute_id"=>18, "mob_id"=>$id, "amount"=>$this->request->data["Mob"]["breath_amt"]));}
				if (is_numeric($this->request->data["Mob"]["sspell_amt"])) {$this->AttributesMob->create(); $this->AttributesMob->save(array("attribute_id"=>19, "mob_id"=>$id, "amount"=>$this->request->data["Mob"]["sspell_amt"]));}
				if (is_numeric($this->request->data["Mob"]["petri_amt"])) {$this->AttributesMob->create(); $this->AttributesMob->save(array("attribute_id"=>20, "mob_id"=>$id, "amount"=>$this->request->data["Mob"]["petri_amt"]));}
				if (is_numeric($this->request->data["Mob"]["rod_amt"])) {$this->AttributesMob->create(); $this->AttributesMob->save(array("attribute_id"=>21, "mob_id"=>$id, "amount"=>$this->request->data["Mob"]["rod_amt"]));}
				if (is_numeric($this->request->data["Mob"]["ap_amt"])) {$this->AttributesMob->create(); $this->AttributesMob->save(array("attribute_id"=>22, "mob_id"=>$id, "amount"=>$this->request->data["Mob"]["ap_amt"]));}
				if (is_numeric($this->request->data["Mob"]["align_amt"])) {$this->AttributesMob->create(); $this->AttributesMob->save(array("attribute_id"=>23, "mob_id"=>$id, "amount"=>$this->request->data["Mob"]["align_amt"]));}
				if (is_numeric($this->request->data["Mob"]["attack_amt"])) {$this->AttributesMob->create(); $this->AttributesMob->save(array("attribute_id"=>24, "mob_id"=>$id, "amount"=>$this->request->data["Mob"]["attack_amt"]));}
				if (is_numeric($this->request->data["Mob"]["level_amt"])) {$this->AttributesMob->create(); $this->AttributesMob->save(array("attribute_id"=>25, "mob_id"=>$id, "amount"=>$this->request->data["Mob"]["level_amt"]));}
				if (is_numeric($this->request->data["Mob"]["agr_amt"])) {$this->AttributesMob->create(); $this->AttributesMob->save(array("attribute_id"=>26, "mob_id"=>$id, "amount"=>$this->request->data["Mob"]["agr_amt"]));}
						
				$this->Session->setFlash("Item Saved!");
				$zone_id = $this->request->data["Mob"]["zone_id"];
				$this->set('gender_id', $this->request->data["Mob"]["gender_id"]);
				$this->set('race_id', $this->request->data["Mob"]["race_id"]);
				$this->set('character_class_id', $this->request->data["Mob"]["character_class_id"]);
				$this->set('size_id', $this->request->data["Mob"]["size_id"]);
				$this->redirect('/admin/mobs/edit/'.$id);
			}
		}
		$this->set("zones", $this->Zone->find("list"));
		$this->set("sizes", $this->Size->find("list"));
		$this->set("genders", $this->Gender->find("list"));
		$this->set("races", $this->Race->find("list"));
		$this->set("apply_mods", $this->ApplyMod->find("list"));
		$this->set("attributes", $this->Attribute->find("list"));
		$this->set("character_classes", $this->CharacterClass->find("list"));
		if ($id != null && $id!="null")
		{
			$this->request->data = $this->Mob->findById($id);
			$attributeMods = $this->AttributesMob->find("all", array("conditions"=>array("mob_id"=>$id)));
			foreach ($attributeMods as $value) {
				if ($value["AttributesMob"]["attribute_id"]==1) $this->request->data["Mob"]["str_amt"] = $value["AttributesMob"]["amount"];
				if ($value["AttributesMob"]["attribute_id"]==2) $this->request->data["Mob"]["int_amt"] = $value["AttributesMob"]["amount"];
				if ($value["AttributesMob"]["attribute_id"]==3) $this->request->data["Mob"]["wis_amt"] = $value["AttributesMob"]["amount"];
				if ($value["AttributesMob"]["attribute_id"]==4) $this->request->data["Mob"]["dex_amt"] = $value["AttributesMob"]["amount"];
				if ($value["AttributesMob"]["attribute_id"]==5) $this->request->data["Mob"]["con_amt"] = $value["AttributesMob"]["amount"];
				if ($value["AttributesMob"]["attribute_id"]==6) $this->request->data["Mob"]["cha_amt"] = $value["AttributesMob"]["amount"];
				if ($value["AttributesMob"]["attribute_id"]==7) $this->request->data["Mob"]["hitr_amt"] = $value["AttributesMob"]["amount"];
				if ($value["AttributesMob"]["attribute_id"]==8) $this->request->data["Mob"]["damr_amt"] = $value["AttributesMob"]["amount"];
				if ($value["AttributesMob"]["attribute_id"]==9) $this->request->data["Mob"]["hit_amt"] = $value["AttributesMob"]["amount"];
				if ($value["AttributesMob"]["attribute_id"]==10) $this->request->data["Mob"]["move_amt"] = $value["AttributesMob"]["amount"];
				if ($value["AttributesMob"]["attribute_id"]==11) $this->request->data["Mob"]["mana_amt"] = $value["AttributesMob"]["amount"];
				if ($value["AttributesMob"]["attribute_id"]==12) $this->request->data["Mob"]["hitg_amt"] = $value["AttributesMob"]["amount"];
				if ($value["AttributesMob"]["attribute_id"]==13) $this->request->data["Mob"]["moveg_amt"] = $value["AttributesMob"]["amount"];
				if ($value["AttributesMob"]["attribute_id"]==14) $this->request->data["Mob"]["manag_amt"] = $value["AttributesMob"]["amount"];
				if ($value["AttributesMob"]["attribute_id"]==15) $this->request->data["Mob"]["age_amt"] = $value["AttributesMob"]["amount"];
				if ($value["AttributesMob"]["attribute_id"]==16) $this->request->data["Mob"]["spell_amt"] = $value["AttributesMob"]["amount"];
				if ($value["AttributesMob"]["attribute_id"]==17) $this->request->data["Mob"]["para_amt"] = $value["AttributesMob"]["amount"];
				if ($value["AttributesMob"]["attribute_id"]==18) $this->request->data["Mob"]["breath_amt"] = $value["AttributesMob"]["amount"];
				if ($value["AttributesMob"]["attribute_id"]==19) $this->request->data["Mob"]["sspell_amt"] = $value["AttributesMob"]["amount"];
				if ($value["AttributesMob"]["attribute_id"]==20) $this->request->data["Mob"]["petri_amt"] = $value["AttributesMob"]["amount"];
				if ($value["AttributesMob"]["attribute_id"]==21) $this->request->data["Mob"]["rod_amt"] = $value["AttributesMob"]["amount"];
				if ($value["AttributesMob"]["attribute_id"]==22) $this->request->data["Mob"]["ap_amt"] = $value["AttributesMob"]["amount"];
				if ($value["AttributesMob"]["attribute_id"]==23) $this->request->data["Mob"]["align_amt"] = $value["AttributesMob"]["amount"];
				if ($value["AttributesMob"]["attribute_id"]==24) $this->request->data["Mob"]["attack_amt"] = $value["AttributesMob"]["amount"];
				if ($value["AttributesMob"]["attribute_id"]==25) $this->request->data["Mob"]["level_amt"] = $value["AttributesMob"]["amount"];
				if ($value["AttributesMob"]["attribute_id"]==26) $this->request->data["Mob"]["agr_amt"] = $value["AttributesMob"]["amount"];
			}
			$zone_id = $this->request->data["Mob"]["zone_id"];
		}
		$this->set("items", $this->Item->find("list", array("conditions"=>array("Item.zone_id"=>$zone_id))));
		$this->set("rooms", $this->Room->find('list', array("conditions"=>array("Room.zone_id"=>$zone_id),
											'fields'=>array('Room.id',
                                                                  'Room.name',
                                                                  'Room.name_secondary'),
											'order'=>array("Room.zone_exit", "Room.name")
																)
											)
					);
		$this->set("zone_id", $zone_id);
		if ($zone_id != null) $this->set("zone", $this->Zone->findById($zone_id));
	}
	
	function admin_delete($id) {
		$this->Mob->delete($id, true);
		$this->redirect('/admin/mobs/index');
	}
    
	function admin_add_apply_mod()
	{
		$this->ApplyMod->save($this->request->data);
		$this->redirect('/admin/mobs/edit/'.$this->request->data["Mob"]["id"]);
	}
	
	function admin_delete_apply_mod($apply_mod_id, $mob_id)
	{
	    $this->Mob->MobsApplyMod->deleteAll(['MobsApplyMod.mob_id'=>$mob_id, 'MobsApplyMod.apply_mod_id'=>$apply_mod_id]);
		$this->redirect('/admin/mobs/edit/'.$mob_id);
	}
	
	function admin_add_item()
	{
		$this->Item->save($this->request->data);
		$this->redirect('/admin/mobs/edit/'.$this->request->data["Mob"]["id"]);
	}
	
	function admin_delete_item($item_id, $mob_id)
	{
	    $this->Mob->ItemsMob->deleteAll(['ItemsMob.mob_id'=>$mob_id, 'ItemsMob.item_id'=>$item_id]);
		$this->redirect('/admin/mobs/edit/'.$mob_id);
	}
	
	function admin_add_room()
	{
		$this->Room->save($this->request->data);
		$this->redirect('/admin/mobs/edit/'.$this->request->data["Mob"]["id"]);
	}
	
	function admin_delete_room($room_id, $mob_id)
	{
		$this->Mob->MobsRoom->deleteAll(['MobsRoom.mob_id'=>$room_id, 'MobsRoom.room_id'=>$room_id]);
		$this->redirect('/admin/mobs/edit/'.$mob_id);
	}
	
}
