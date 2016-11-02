<?php
/**
 * Routing middleware
 */

header('Content-type: application/json'); //  Our API to return only json

if(isset($_REQUEST['action'])) {

	switch($_REQUEST['action']) {

		case 'add_person': 
			call('PersonController', 'add');
			break;

		case 'get_all_persons': 
			call('PersonController', 'getall');
			break;

		default: 
			echo json_encode(array(
				'success' => 0,
				'error'   => 1,
				'message' => 'Invalid action provided'
			));
	}

} else {

	echo json_encode(array(
		'success' => 0,
		'error'   => 1,
		'message' => 'Invalid request'
	));
}

/**
 * Utility function 
 */
function call($controller, $action) {
    require_once('controller/' . $controller . '.php');

	switch($controller) {
		case 'PersonController':
			$controller = new PersonController();
			break;
	}

    $controller->{ $action }();
}