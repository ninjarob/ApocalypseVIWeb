<?php
class LocalizedString extends AppModel {
	var $name = 'LocalizedString';
	var $validate = array(
		'text' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)
	);
	
	var $belongsTo = array(
	    'StringKey' => array(
	        'className' => 'StringKey',
	        'foreignKey' => 'string_key_id',
	        'conditions' => '',
	        'fields' => '',
	        'order' => ''
	    ));
}
