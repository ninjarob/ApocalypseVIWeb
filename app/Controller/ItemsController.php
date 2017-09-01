<?php
App::import('Controller', 'AdminBase');
class ItemsController extends AdminBaseController {

	var $name = 'Items';
	var $uses = array("Zone", "Item", "Mob", "Item", "ItemType", "Position", "ItemsPosition", "Size", "Material", "ApplyMod", "ExtraMod", "Attribute", "AttributesItem", "Weapon", "Armor", "Keyword", "Room", "CharacterClass", "Spell", "Skill", "ExtraModsItem", "CharacterClassesItem", "ApplyModsItem", "ClassGroup", "ClassGroupsItem");

	function admin_index($zone_id=null, $mod_id=null) {
		if (($zone_id == null || $zone_id == "null") && ($mod_id == null || $mod_id == "null"))
		{
			$this->set("items", $this->Item->find("all"));
		}
		else if ($zone_id != null && $zone_id != "null")
		{
			$this->set("zone", $this->Zone->findById($zone_id));
			$items = $this->Item->find("all", array("conditions"=>array("zone_id"=>$zone_id)));
			$this->set("items", $items);
		}
		else if ($mod_id != null && mob_id != "null")
		{
			$this->set("mob", $this->Mob->findById($mob_iod));
			//HABTM to get items here
			//$this->set("items", $this->Item->find("all", array("conditions"=>array("mob_id"=>$zone_id))));
		}
	}

	function admin_edit($id=null, $zone_id=null, $mob_id=null) {
	    $this->set("item_type_id", null);
	    $this->set("size_id", null);
	    $this->set("material_id", null);
	    
		if(!empty($this->data)) {
			if($this->Item->save($this->data)) {
				if ($id == null)
				{
					$id = $this->Item->id;
				}
				$this->Weapon->deleteAll(array("item_id"=>$id), true);
				$this->Armor->deleteAll(array("item_id"=>$id), true);
				if ($this->data['Item']['item_type_id'] == 1) { //weapon
					$this->Weapon->save(array("item_id"=>$this->Item->id, "damage_base"=>$this->data['Item']['damage_base'], "damage_roll"=>$this->data['Item']['damage_roll']));
				}
				if ($this->data['Item']['item_type_id'] == 2)
				{
					$this->Armor->save(array("item_id"=>$this->Item->id, "armor"=>$this->data['Item']['armor']));
				}
				$this->Session->setFlash("Item Saved!");
				$zone_id = $this->data['Item']['zone_id'];
				$this->set("item_type_id", $this->data['Item']['item_type_id']);
				$this->set("size_id", $this->data['Item']['size_id']);
				$this->set("material_id", $this->data['Item']['material_id']);
				$this->redirect('/admin/items/edit/'.$id);
			}
		}
		$this->set("zones", $this->Zone->find("list"));
		$this->set("item_types", $this->ItemType->find("list"));
		$this->set("sizes", $this->Size->find("list"));
		$this->set("materials", $this->Material->find("list"));
		$this->set("restrictions", $this->CharacterClass->find("list"));
		$this->set("cg_restrictions", $this->ClassGroup->find("list"));
		$this->set("apply_mods", $this->ApplyMod->find("list"));
		$this->set("extra_mods", $this->ExtraMod->find("list"));
		$this->set("positions", $this->Position->find("list"));
		$this->set("attributes", $this->Attribute->find("list"));
		if ($id != null && $id!="null")
		{
			$this->data = $this->Item->findById($id);
			if (isset($this->data['Armor'][0]['armor']))
			{
				$this->data['Item']['armor'] = $this->data['Armor'][0]['armor'];
			}
			if (isset($this->data['Weapon'][0]['damage_base']))
			{
				$this->data['Item']['damage_base'] = $this->data['Weapon'][0]['damage_base'];
				$this->data['Item']['damage_roll'] = $this->data['Weapon'][0]['damage_roll'];
			}
			$zone_id = $this->data['Item']['zone_id'];
			$this->set("attributes_items", $this->AttributesItem->find("all", array("conditions"=>array("item_id"=>$id))));
		}
		$this->set("rooms", $this->Room->find('list', array("conditions"=>array("Room.zone_id"=>$zone_id),
											'fields'=>array('Room.id',
                                                                  'Room.name',
                                                                  'Room.name_secondary'),
											'order'=>array("Room.zone_exit", "Room.name")
																)
											)
					);
		$this->set("mobs", $this->Mob->find("list", array("conditions"=>array("Mob.zone_id"=>$zone_id))));
		$this->set("zone_id", $zone_id);
		if ($zone_id != null) $this->set("zone", $this->Zone->findById($zone_id));
	}
	
	function admin_delete($id) {
		$this->Item->delete($id, true);
		$this->redirect('/admin/items/index');
	}
	
	function admin_add_attribute()
	{
		$this->AttributesItem->save($this->data);
		$this->redirect('/admin/items/edit/'.$this->data['AttributesItem']['item_id']);
	}
	
	function admin_delete_attribute($attributes_item_id, $item_id)
	{
		$this->AttributesItem->delete($attributes_item_id, true);
		$this->redirect('/admin/items/edit/'.$item_id);
	}
	
	function admin_add_position()
	{
		$this->Position->save($this->data);
		$this->redirect('/admin/items/edit/'.$this->data['Item']['id']);
	}
	
	function admin_delete_position($position_id, $item_id)
	{
	    $this->Item->ItemsPosition->deleteAll(['ItemsPosition.item_id'=>$item_id, 'ItemsPosition.position_id'=>$position_id]);
		$this->redirect('/admin/items/edit/'.$item_id);
	}
	
	function admin_add_apply_mod()
	{
		$this->ApplyMod->save($this->data);
		$this->redirect('/admin/items/edit/'.$this->data['Item']['id']);
	}
	
	function admin_delete_apply_mod($apply_mod_id, $item_id)
	{
	    $this->Item->ApplyModsItem->deleteAll(['ApplyModsItem.item_id'=>$item_id, 'ApplyModsItem.apply_mod_id'=>$apply_mod_id]);
	 	$this->redirect('/admin/items/edit/'.$item_id);
	}
	
	function admin_add_extra_mod()
	{
		$this->ExtraMod->save($this->data);
		$this->redirect('/admin/items/edit/'.$this->data['Item']['id']);
	}
	
	function admin_delete_extra_mod($extra_mod_id, $item_id)
	{
	    $this->Item->ExtraModsItem->deleteAll(['ExtraModsItem.item_id'=>$item_id, 'ExtraModsItem.extra_mod_id'=>$extra_mod_id]);
		$this->redirect('/admin/items/edit/'.$item_id);
	}
	
	
	function admin_add_keyword()
	{
		$this->Keyword->save($this->data);
		$this->redirect('/admin/items/edit/'.$this->data['Keyword']['item_id']);
	}
	
	function admin_delete_keyword($id, $item_id)
	{
		$this->Keyword->delete($id, true);
		$this->redirect('/admin/items/edit/'.$item_id);
	}
	
	function admin_add_room()
	{
		$this->Item->save($this->data);
		$this->redirect('/admin/items/edit/'.$this->data['Item']['id']);
	}
	
	function admin_delete_room($room_id, $item_id)
	{
	    $this->Item->ItemsRoom->deleteAll(['ItemsRoom.item_id'=>$item_id, 'ItemsRoom.room_id'=>$room_id]);
		$this->redirect('/admin/items/edit/'.$item_id);
	}
	
	function admin_add_mob()
	{
		$this->Mob->save($this->data);
		$this->redirect('/admin/items/edit/'.$this->data['Item']['id']);
	}
	
	function admin_delete_mob($mob_id, $item_id)
	{
	    $this->Item->ItemsMob->deleteAll(['ItemsMob.item_id'=>$item_id, 'ItemsMob.mob_id'=>$mob_id]);
		$this->redirect('/admin/items/edit/'.$item_id);
	}
	
	function admin_add_character_class()
	{
		$this->CharacterClass->save($this->data);
		$this->redirect('/admin/items/edit/'.$this->data['Item']['id']);
	}
	
	function admin_delete_character_class($character_class_id, $item_id)
	{
	    $this->Item->CharacterClassesItem->deleteAll(['CharacterClassesItem.item_id'=>$item_id, 'CharacterClassesItem.character_class_id'=>$character_class_id]);
		$this->redirect('/admin/items/edit/'.$item_id);
	}
	
	function admin_add_class_group()
	{
		$this->ClassGroup->save($this->data);
		$this->redirect('/admin/items/edit/'.$this->data['Item']['id']);
	}
	
	function admin_delete_class_group($class_group_id, $item_id)
	{
	    $this->Item->ClassGroupsItem->deleteAll(['ClassGroupsItem.item_id'=>$item_id, 'ClassGroupsItem.class_group_id'=>$class_group_id]);
		$this->redirect('/admin/items/edit/'.$item_id);
	}
	
	function admin_add_item_by_text()
	{
		$this->set("zones", $this->Zone->find("list"));
		if(!empty($this->data)) {
			$item_text = $this->data['Item']['item_text'];
			$nameStart = strpos($item_text, "... ")+3;
			$nameEnd = strpos($item_text, "...'");
			$keywordsStart = strpos($item_text, "Keywords: ")+10;
			$keywordsEnd = strpos($item_text, "\n", $keywordsStart);
			$sizeStart = strpos($item_text, "Size: ")+6;
			$sizeEnd = strpos($item_text, ",", $sizeStart);
			$compositionStart = strpos($item_text, "Composition: ")+13;
			$compositionEnd = strpos($item_text, ",", $compositionStart);
			$weightStart = strpos($item_text, "Weight: ")+8;
			$weightEnd = strpos($item_text, "\n", $weightStart);
			$minlevelStart = strpos($item_text, "Min Level: ")+11;
			$minlevelEnd = strpos($item_text, ",", $minlevelStart);
			$costStart = strpos($item_text, "Cost: ")+6;
			$costEnd = strpos($item_text, ",", $costStart);
			$rentStart = strpos($item_text, "Rent/day: ")+9;
			$rentEnd = strpos($item_text, "\n", $rentStart);
			$positionsStart = strpos($item_text, "Positions: ")+11;
			$positionsEnd = strpos($item_text, "\n", $positionsStart);
			$itemTypeStart = strpos($item_text, "classified as ")+14;
			$itemTypeEnd = strpos($item_text, ",", $itemTypeStart);
			$extraModsStart = strpos($item_text, "Additional Modifiers:")+22;
			$extraModsEnd = -1;
			if ($extraModsStart != 22) $extraModsEnd = strpos($item_text, "\n", $extraModsStart);
			$restrictionsStart = strpos($item_text, "Class Restrictions: ")+20;
			$restrictionsEnd = -1;
			if ($restrictionsStart != 20) $restrictionsEnd = strpos($item_text, "\n", $restrictionsStart);
			$attributesStart = strpos($item_text, "following statistics:")+21;
			$applyModsStart = strpos($item_text, "innate abilities:")+17;
			$applyModsEnd = strlen($item_text);
			if ($attributesStart != 21 && $applyModsStart != 17) $applyModsEnd = strpos($item_text, "Modifies the following statistics");
			$armorStart = strpos($item_text, "Armor Point Rating of ")+22;
			$armorEnd = -1;
			if ($armorStart != 22) $armorEnd = strpos($item_text, ".", $armorStart);
			$weaponStart = strpos($item_text, "damage dice is '")+16;
			$weaponEnd = -1;
			if ($weaponStart != 16) $weaponEnd = strpos($item_text, "'", $weaponStart);
			
			$name = substr($item_text, $nameStart, $nameEnd - $nameStart);
			$keywords = explode(" ", trim(substr($item_text, $keywordsStart, $keywordsEnd-$keywordsStart)));
			$size = substr($item_text, $sizeStart, $sizeEnd - $sizeStart);
			$composition = substr($item_text, $compositionStart, $compositionEnd - $compositionStart);
			$weight = substr($item_text, $weightStart, $weightEnd - $weightStart);
			$minlevel = substr($item_text, $minlevelStart, $minlevelEnd - $minlevelStart);
			$cost = substr($item_text, $costStart, $costEnd - $costStart);
			$rent = substr($item_text, $rentStart, $rentEnd - $rentStart);
			$item_type = substr($item_text, $itemTypeStart, $itemTypeEnd - $itemTypeStart);
			
			$this->data['Item']['item_text'] = $item_text;
			$this->set("name", $name);
			$this->set("keywords", $keywords);
			$this->set("size", $size);
			$this->set("composition", $composition);
			$this->set("weight", $weight);
			$this->set("minlevel", $minlevel);
			$this->set("cost", $cost);
			$this->set("rent", $rent);
			$this->set("item_type", $item_type);
			
			$itemType_obj = $this->ItemType->find("first", array(
				"conditions"=>array("name"=>trim($item_type)),
				"recursive"=>0));
			
			$material_obj = $this->Material->find("first", array(
				"conditions"=>array("name"=>trim($composition)),
				"recursive"=>0));

			$size_obj = $this->Size->find("first", array(
				"conditions"=>array("name"=>trim($size)),
				"recursive"=>0));

			$this->Item->save(array(
				"name"=>trim($name),
				"description"=>$this->data['Item']['description'],
				"limit"=>-1,
				"size_id"=>$size_obj['Size']['id'],
				"weight"=>trim($weight),
				"min_lvl"=>trim($minlevel),
				"cost"=>trim($cost),
				"rent"=>trim($rent),
				"zone_id"=>$this->data['Item']['zone_id'],
				"material_id"=>$material_obj['Material']['id'],
				"item_type_id"=>$itemType_obj['ItemType']['id']
			));

			
			$extra_mods = null;
			$restrictions = null;
			$attributes = null;
			$apply_mods = null;
			
			
			if ($keywordsEnd != -1)
			{
				foreach ($keywords as $keyword) {
					$this->Keyword->create();
					$this->Keyword->save(array("item_id"=>$this->Item->id, "keyword"=>$keyword));
				}
			}
			if ($positionsEnd != -1)
			{
				$positions = explode(" ", trim(substr($item_text, $positionsStart, $positionsEnd-$positionsStart)));
				$this->set("positions", $positions);
				foreach ($positions as $position) {
					$position = $this->Position->find("first", array(
									"conditions"=>array("Position.name"=>trim($position)),
									"recursive"=>0));
					if($position)
					{
						$this->ItemsPosition->create();
						$this->ItemsPosition->save(array("item_id"=>$this->Item->id, "position_id"=>$position["Position"]["id"]));
					}
				}
			}
			if ($extraModsEnd != -1)
			{
				$extra_mods = explode(" ", trim(substr($item_text, $extraModsStart, $extraModsEnd-$extraModsStart)));
				$this->set("extra_mods", $extra_mods);
				foreach ($extra_mods as $extra_mod) {
					$extraMod = $this->ExtraMod->find("first", array(
									"conditions"=>array("ExtraMod.name"=>trim($extra_mod)),
									"recursive"=>0));
					if($extraMod)
					{
						$this->ExtraModsItem->create();
						$this->ExtraModsItem->save(array("item_id"=>$this->Item->id, "extra_mod_id"=>$extraMod["ExtraMod"]["id"]));
					}
				}
			}
			if ($restrictionsEnd != -1)
			{
				$restrictions = explode(" ", trim(substr($item_text, $restrictionsStart, $restrictionsEnd-$restrictionsStart)));
				$this->set("restrictions", $restrictions);
				
				foreach ($restrictions as $restriction) {
					$characterClass = $this->CharacterClass->find("first", array(
									"conditions"=>array("CharacterClass.name"=>trim($restriction)),
									"recursive"=>0));
					if($characterClass)
					{
						$this->CharacterClassesItem->create();
						$this->CharacterClassesItem->save(array("item_id"=>$this->Item->id, "character_class_id"=>$characterClass["CharacterClass"]["id"]));
					}
					else
					{
						$classGroup = $this->ClassGroup->find("first", array(
									"conditions"=>array("ClassGroup.name"=>trim($restriction)),
									"recursive"=>0));
						if ($classGroup)
						{
							$this->ClassGroupsItem->create();
							$this->ClassGroupsItem->save(array("item_id"=>$this->Item->id, "class_group_id"=>$classGroup["ClassGroup"]["id"]));
						}
					}
				}
			}
			if ($attributesStart != 21)
			{
				$attributes = explode("\n", trim(substr($item_text, $attributesStart)));
				$this->set("attributes", $attributes);
				
				foreach ($attributes as $value) {
					$name_val = explode(" By ", $value);
					$spell_id = null;
					$skill_id = null;
					if (strpos($name_val[0], "SPELL") !== FALSE)
					{
						$spellStart = strpos($name_val[0], "(")+1;
						$spellEnd = strpos($name_val[0], ")");
						$spellName = substr($name_val[0], $spellStart, $spellEnd-$spellStart);
						$spell = $this->Spell->find("first", array(
											"conditions"=>array("Spell.name"=>trim($spellName)),
											"recursive"=>0));
						$skill = $this->Skill->find("first", array(
											"conditions"=>array("Skill.name"=>trim($spellName)),
											"recursive"=>0));
						if ($spell) $spell_id = $spell["Spell"]["id"];
						if ($skill) $skill_id = $skill["Skill"]["id"];
						$name_val[0] = "SPELL";
					}
					$attribute = $this->Attribute->find("first", array(
										"conditions"=>array("name"=>trim($name_val[0])),
										"recursive"=>0));
					if ($attribute){
						$this->AttributesItem->create();
						$this->AttributesItem->save(array(
													"attribute_id"=>$attribute["Attribute"]["id"],
													"item_id"=>$this->Item->id,
													"amount"=>trim($name_val[1]),
													"spell_id"=>$spell_id,
													"skill_id"=>$skill_id
						));
					}
				}
				
			}
			
			if ($applyModsStart != 17)
			{
				$apply_mods = trim(substr($item_text, $applyModsStart, $applyModsEnd-$applyModsStart));
				if (strpos($apply_mods, "\n") === FALSE)
				{
					$group_mods = explode(": ", $apply_mods);
					$mods = explode(" ", $group_mods[1]);
					foreach ($mods as $mod) {
						$apply_mod = $this->ApplyMod->find("first", array(
											"conditions"=>array("ApplyMod.name"=>trim($mod)),
											"recursive"=>0));
						if ($apply_mod){
							$this->ApplyModsItem->create();
							$this->ApplyModsItem->save(array(
														"apply_mod_id"=>$apply_mod["ApplyMod"]["id"],
														"item_id"=>$this->Item->id
							));
						}
					}
				}
				else if (strpos($apply_mods, "\n") !== FALSE)
				{
					$apply_mods = explode("\n", $apply_mods);
					foreach ($apply_mods as $value) {
						$group_mods = explode(": ", $value);
						$mods = explode(" ", $group_mods[1]);
						foreach ($mods as $mod) {
							$apply_mod = $this->ApplyMod->find("first", array(
												"conditions"=>array("ApplyMod.name"=>trim($mod)),
												"recursive"=>0));
							if ($apply_mod){
								$this->ApplyModsItem->create();
								$this->ApplyModsItem->save(array(
															"apply_mod_id"=>$apply_mod["ApplyMod"]["id"],
															"item_id"=>$this->Item->id
								));
							}
						}
					}
				}
				$this->set("apply_mods", $apply_mods);
			}
			if ($armorEnd != -1)
			{
				$armor = substr($item_text, $armorStart, $armorEnd - $armorStart);
				$this->set("armor", $armor);
				$this->Armor->save(array("item_id"=>$this->Item->id, "armor"=>$armor));
			}
			if ($weaponEnd != -1)
			{
				$weapon = substr($item_text, $weaponStart, $weaponEnd - $weaponStart);
				$this->set("weapon", $weapon);
				$weapon_parts = explode("D", $weapon);
				$this->Weapon->save(array("item_id"=>$this->Item->id, "damage_base"=>$weapon_parts[0], "damage_roll"=>$weapon_parts[1]));
			}
			
			$this->redirect('/admin/items/edit/'.$this->Item->id);
		}
	}
	
}
