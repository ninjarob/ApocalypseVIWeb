<?php
class ApplyModsMob extends AppModel {
	var $name = 'ApplyModsMob';
	var $validate = array(
		'apply_mod_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'mob_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'ApplyMod' => array(
			'className' => 'ApplyMod',
			'foreignKey' => 'apply_mod_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Mob' => array(
			'className' => 'Mob',
			'foreignKey' => 'mob_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
