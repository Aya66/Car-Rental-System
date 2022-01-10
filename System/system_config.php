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
		$query="SELECT * FROM car";
		$result=mysqli_query($this->$conn,$query);
		return $result;
	}

	public function getCarRecordsWhere($model, $body, $brand, $color, $year, $status, $office, $min_price, $max_price) {
		$query = "	SELECT *
                    FROM car
                    WHERE price_day BETWEEN ".$min_price." AND ".$max_price."
                        AND CONCAT(`model`) LIKE '%".$model."%'
                        AND CONCAT(`body`) LIKE '%".$body."%'
                        AND CONCAT(`brand`) LIKE '%".$brand."%'
                        AND CONCAT(`color`) LIKE '%".$color."%'
                        AND CONCAT(`year`) LIKE '%".$year."%'
                        AND CONCAT(`status`) LIKE '%".$status."%'
                        AND CONCAT(`office_id`) LIKE '%".$office."%'";
		$result=mysqli_query($this->$conn,$query);
		return $result;
	}

	public function closeCon() {
		$this->$conn->close();
	}

}
?>