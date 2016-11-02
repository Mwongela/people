<?php
/**
 * Model for person entity. 
 * Contains methods to perform CRUD operations to access data
 */

require_once 'db/Db.php';

class Person {

	public $id;
	public $name;
	public $age;
	public $phoneNumber;

	/**
	 * Constructor function
	 *
	 * @param int $id Person ID.
	 * @param string $name Person name.
	 * @param int $age Person age.
	 * @param string $phoneNumber Person phone number.
	 */
	function __construct($id, $name, $age, $phoneNumber) {
		$this->id = $id;
		$this->name = $name;
		$this->age = $age;
		$this->phoneNumber = $phoneNumber;
	}

	/**
	 * Add new person
	 *
	 * @param string $name Person name.
	 * @param int $age Person age.
	 * @param string $phoneNumber Person phone number.
	 */
	public static function add($name, $age, $phoneNumber) {

		$name = trim($name);
		$age = trim($age);
		$phoneNumber = trim($phoneNumber);

		if(is_string($name) && is_numeric($age) && $age > 0 && is_string($phoneNumber)) {

			$db = Db::getInstance();

			$sql = "INSERT INTO `busara_interview`.`people` (`id`, `name`, `age`, `phoneNumber`) VALUES (NULL, :name, :age, :phoneNumber)";

			try {
				$results = $db->prepare($sql);
				$results->execute(array('name'=>$name, 'age'=>$age, 'phoneNumber'=> $phoneNumber));

				return array('message'=>'Added successfully', 'success'=>1, 'id'=>$db->lastInsertId());
				
			} catch(PDOException $e) {
				return array('message'=>$e->getMessage(), 'error'=>1);
			}
		} else {
			return array('message'=>'Invalid input', 'error'=>1);
		}
	}

	/**
	 * Get all person records
	 */
	public static function getall() {

		$persons = [];

		$db = Db::getInstance();

		$sql = "SELECT * FROM `people`";

		try {
			$rs = $db->query($sql);

			foreach($rs->fetchAll() as $person) {

				$persons[] = new Person($person['id'], $person['name'], $person['age'], $person['phoneNumber']);
			}

			return array('success' => 1, 'persons' => $persons);

		} catch(PDOException $e) {
			return array('message'=>$e->getMessage(), 'error'=>1);
		}

	}


	
}
