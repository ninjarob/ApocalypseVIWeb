<?php
class Exite extends AppModel {
	var $name = 'Exite';
	var $validate = array(
		'direction_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'room_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'exit_room_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'exit_type_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
		'ExitType' => array(
			'className' => 'ExitType',
			'foreignKey' => 'exit_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Direction' => array(
			'className' => 'Direction',
			'foreignKey' => 'direction_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Room' => array(
			'className' => 'Room',
			'foreignKey' => 'room_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Destination' => array(
			'className' => 'Room',
			'foreignKey' => 'exit_room_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Key' => array(
			'className' => 'Item',
			'foreignKey' => 'key_id',
			'conditions' => '',
			'fields' => '', 
			'order' => ''
		)
	);
}
