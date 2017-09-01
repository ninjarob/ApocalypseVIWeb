<?php
class Help extends AppModel {
	var $name = 'Help';
	var $validate = array(
		'key' => array(
			'notempty' => array(
				'rule' => array('notempty'),
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
	        'foreignKey' => 'string_key',
	        'conditions' => '',
	        'fields' => '',
	        'order' => ''
	    ));
}
