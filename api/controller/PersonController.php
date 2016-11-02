<?php
/**
 * Person controller
 * Acts as a link between the Person model and http client
 */

require_once 'model/Person.php';

class PersonController {

	private $response = array('success' => 0, 'error' => 0);

	/**
	 * Gets http params and passes them to Person model
	 */
	public function add() {

		if(isset($_POST['name']) && isset($_POST['age']) && $_POST['phoneNumber']) {

			$name = $_POST['name'];
			$age = $_POST['age'];
			$phoneNumber = $_POST['phoneNumber'];

			$results = Person::add($name, $age, $phoneNumber);

			echo json_encode(array_merge($this->response, $results));
		} else {
			echo json_encode(array_merge($this->response, array('error' => 1, 'message' => 'Please provide all request')));
		}
	}

	/**
	 * Get all persons from person model
	 */
	public function getall() {

		echo json_encode(array_merge($this->response, Person::getall()));

	}

}