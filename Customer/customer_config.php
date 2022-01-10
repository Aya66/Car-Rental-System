<?php

error_reporting(0);
class db {
    
	var $conn;

	public function __construct() {

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "carrentalsystem";
        
        // Create connection
        $this->$conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($this->$conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        else {
            $this->db = $this->$conn;
        }
	}

	public function getCarRecords() {
		$query ="SELECT C.plate_id, C.model, C.body, C.brand, C.color, C.year, C.status,C.price_day, OF.country, OF.city
					 FROM car C, office OF
					 WHERE C.office_id = OF.office_id AND C.plate_id NOT IN (SELECT plate_id FROM reservation)
					 ORDER BY C.plate_id";
		$result=mysqli_query($this->$conn,$query);
		return $result;
	}

	public function getCarRecordsWhere($model, $body, $brand, $color, $year, $status, $country, $city) {
		$query = "SELECT `plate_id`, `model`, `body`, `brand`, `color`, `year`, `status`, `country`, `city`,`price_day` FROM `car`,`office` WHERE 
			car.office_id = office.office_id 
			AND CONCAT(`plate_id`, `model`, `body`, `brand`, `color`, `year`, `status`, `country`, `city`) LIKE '%".$model."%'
			AND CONCAT(`plate_id`, `model`, `body`, `brand`, `color`, `year`, `status`, `country`, `city`) LIKE '%".$body."%'
			AND CONCAT(`plate_id`, `model`, `body`, `brand`, `color`, `year`, `status`, `country`, `city`) LIKE '%".$brand."%'
			AND CONCAT(`plate_id`, `model`, `body`, `brand`, `color`, `year`, `status`, `country`, `city`) LIKE '%".$color."%'
			AND CONCAT(`plate_id`, `model`, `body`, `brand`, `color`, `year`, `status`, `country`, `city`) LIKE '%".$year."%'
			AND CONCAT(`plate_id`, `model`, `body`, `brand`, `color`, `year`, `status`, `country`, `city`) LIKE '%".$status."%'
			AND CONCAT(`plate_id`, `model`, `body`, `brand`, `color`, `year`, `status`, `country`, `city`) LIKE '%".$country."%'
			AND CONCAT(`plate_id`, `model`, `body`, `brand`, `color`, `year`, `status`, `country`, `city`) LIKE '%".$city."%'
			AND car.plate_id NOT IN (SELECT plate_id FROM reservation)";
		$result=mysqli_query($this->$conn,$query);
		return $result;
	}

	public function closeCon() {
		$this->$conn->close();
	}

}
?>