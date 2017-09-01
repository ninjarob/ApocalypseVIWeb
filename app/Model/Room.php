<?php
class Room extends AppModel {
	var $name = 'Room';
	//var $actsAs = 'ExtendAssociations';
	var $displayField = 'name';
	var $order = "Room.name";
	var $validate = array(
		'name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'description' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'SectorType' => array(
			'className' => 'SectorType',
			'foreignKey' => 'sector_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Zone' => array(
			'className' => 'Zone',
			'foreignKey' => 'zone_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Character' => array(
			'className' => 'Character',
			'foreignKey' => 'room_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Exite' => array(
			'className' => 'Exite',
			'foreignKey' => 'room_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'RoomExamine' => array(
			'className' => 'RoomExamine',
			'foreignKey' => 'room_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'RoomCoord' => array(
			'className' => 'RoomCoord',
			'foreignKey' => 'room_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);


	var $hasAndBelongsToMany = array(
		'RoomType' => array(
			'className' => 'RoomType',
			'joinTable' => 'room_types_rooms',
			'foreignKey' => 'room_id',
			'associationForeignKey' => 'room_type_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'Mob' => array(
			'className' => 'Mob',
			'joinTable' => 'mobs_rooms',
			'foreignKey' => 'room_id',
			'associationForeignKey' => 'mob_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'Item' => array(
			'className' => 'Item',
			'joinTable' => 'items_rooms',
			'foreignKey' => 'room_id',
			'associationForeignKey' => 'item_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);


	/*function find($type, $options = array()) {
        switch ($type) {
            case 'superlist':
                if(!isset($options['fields']) || count($options['fields']) < 3) {
                    return parent::find('list', $options);
                }

                if(!isset($options['separator'])) {
                    $options['separator'] = ' ';
                }

                $options['recursive'] = -1;
                $list = parent::find('all', $options);
                for($i = 1; $i <= 2; $i++) {
                    $field[$i] = str_replace($this->alias.'.', '', $options['fields'][$i]);
                }
                return Set::combine($list, '{n}.'.$this->alias.'.'.$this->primaryKey,
                                 array('%s'.$options['separator'].'%s',
                                       '{n}.'.$this->alias.'.'.$field[1],
                                       '{n}.'.$this->alias.'.'.$field[2]));
            break;

            default:
                return parent::find($type, $options);
            break;
        }
    }*/
}
