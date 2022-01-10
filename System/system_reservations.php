<html>
<head>

	<title>Reservations</title>
	<!--Style sheets-->
	<link rel="stylesheet" href="/Car-Rental-System/Styles/colours.css">
    <link rel="stylesheet" href="/Car-Rental-System/Styles/location-size.css">
    <link rel="stylesheet" href="/Car-Rental-System/Styles/fonts.css">

</head>

<body>

	<nav class="nav-bar black-background">

		<a href="system_cars.php">
        	<h2 class="font26 navbar-first white-colour">Cars</h2>
		</a>

        <a href="system_users.php">
        	<h2 class="font26 navbar-second white-colour">Customers</h2>
		</a>

        <a href="system_reservations.php">
        	<h2 class="font26 navbar-third white-colour">Reservations</h2>
		</a>

		<a href="system_offices.php">
        	<h2 class="font26 navbar-fourth white-colour">Offices</h2>
		</a>

		<a href="/Car-Rental-System/logout.php">
        	<h2 class="font26 logout-margins white-colour">Logout</h2>
		</a>
    
    </nav>

	<section class="white-colour font20 scrollbar">

		<?php

		if (isset($_POST["search"])) {
			$searchedValUser = $_POST["searchedValUser"];
			$searchedValCar = $_POST["searchedValCar"];
			$searchedValDateMin = $_POST["searchedValDateMin"];
			$searchedValDateMax = $_POST["searchedValDateMax"];
			if ($searchedValDateMin == ""){
				$searchedValDateMin = '1900-01-01';
			}
			if ($searchedValDateMax == ""){
				$searchedValDateMax = '2050-1-1';
			}
			
			$query = "	SELECT *, U.country AS user_country, U.city AS user_city, O.country AS office_country, O.city AS office_city
						FROM reservation R, user U, car C, office O
						WHERE R.user_id=U.user_id AND R.plate_id=C.plate_id AND R.office_id=O.office_id
							AND CONCAT(R.`user_id`) LIKE '%".$searchedValUser."%'
							AND CONCAT(R.`plate_id`) LIKE '%".$searchedValCar."%'
							AND R.`reservation_date` BETWEEN '".$searchedValDateMin."' AND '".$searchedValDateMax."'
						ORDER BY R.reservation_id";
			$searchResults = getQueryResults($query);
		}
		else {
			$query = "	SELECT *, U.country AS user_country, U.city AS user_city, O.country AS office_country, O.city AS office_city
						FROM reservation R, user U, car C, office O
						WHERE R.user_id=U.user_id AND R.plate_id=C.plate_id AND R.office_id=O.office_id
						ORDER BY R.reservation_id";
			$searchResults = getQueryResults($query);
		}

		function getQueryResults($query) {
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "carrentalsystem";
			$conn = mysqli_connect($servername, $username, $password, $dbname);  //creates the connection
			$filteredResult = mysqli_query($conn, $query);
			return $filteredResult;
		}

		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "carrentalsystem";
		$conn = new mysqli($servername, $username, $password, $dbname);  //creates the connection
		if ($conn->connect_error) {        //checks the connection
			die("Connection failed: " . $conn->connect_error);
		}
		
		$sql = "SELECT *
				FROM user
				WHERE is_admin = 0
				ORDER BY user_id";
		
		$resultUser = $conn->query($sql);  //gets the data of the user with the given inputs

		$sql = "SELECT *
				FROM car
				ORDER BY plate_id";
		
		$resultCar = $conn->query($sql);  //gets the data of the user with the given inputs
		
		$userArray = array();
		$carArray = array();
		
		if ($resultUser->num_rows > 0) {

			while ($row = $resultUser->fetch_assoc()) {  // check if the data exists
				$userArray[] = $row["user_id"];
			}
			
		}
		else {  //if data does not exit, sends error to login page
			echo "no users exist";
		}

		if ($resultCar->num_rows > 0) {

			while ($row = $resultCar->fetch_assoc()) {  // check if the data exists
				$carArray[] = $row["plate_id"];
			}
			
		}
		else {  //if data does not exit, sends error to login page
			echo "no cars exist";
		}

		$userArray = array_unique($userArray);
		$carArray = array_unique($carArray);

		?>

		<form action="system_reservations.php" method="POST">

			<br>
			
			<label>UserID:</label>
			<select name="searchedValUser">
				<option selected="selected"></option>
				<?php
				foreach($userArray as $item){
					echo '<option value=' .$item. '>' .$item. '</option>';
				}
				?>
			</select>

			<label>PlateID:</label>
			<select name="searchedValCar">
				<option selected="selected"></option>
				<?php
				foreach($carArray as $item){
					echo '<option value=' .$item. '>' .$item. '</option>';
				}
				?>
			</select>

			<label>From:</label>
			<input type="date" id="searchedValDateMin" name="searchedValDateMin">
			<label>To:</label>
			<input type="date" id="searchedValDateMax" name="searchedValDateMax">

			<input type="submit" name="search" value="Filter">
			<br>

			<br>
			<table class="white-colour font20 black-background cool-table">

				<tr>
					<th colspan="6">Reservation</th>
					<th colspan="8">Customer</th>
					<th colspan="8">Car</th>
					<th colspan="3">Office</th>
				</tr>
			
				<tr>
					<th>ID</th>
					<th>ReservationDate</th>
					<th>RentalDate</th>
					<th>ReturnDate</th>
					<th>Paid</th>
					<th>RentDays</th>
					
					<th>UserID</th>
					<th>FirstName</th>
					<th>LastName</th>
					<th>Email</th>
					<th>Birthdate</th>
					<th>Gender</th>
					<th>Country</th>
					<th>City</th>
					
					<th>PlateID</th>
					<th>Model</th>
					<th>Body</th>
					<th>Brand</th>
					<th>Color</th>
					<th>Year</th>
					<th>Status</th>
					<th>Price/Day</th>
					
					<th>OfficeID</th>
					<th>Country</th>
					<th>City</th>
				</tr>
				<?php while($row = mysqli_fetch_array($searchResults)):?>
				<tr>
                    <td><?php echo $row["reservation_id"];?></td>
					<td><?php echo $row["reservation_date"];?></td>
					<td><?php echo $row["rental_date"];?></td>
					<td><?php echo $row["return_date"];?></td>
					<td><?php echo $row["paid"];?></td>
					<td><?php echo $row["rent_days"];?></td>
                    
					<td><?php echo $row["user_id"];?></td>
					<td><?php echo $row["first_name"];?></td>
					<td><?php echo $row["last_name"];?></td>
					<td><?php echo $row["email"];?></td>
					<td><?php echo $row["birthdate"];?></td>
					<td><?php echo $row["gender"];?></td>
					<td><?php echo $row["user_country"];?></td>
					<td><?php echo $row["user_city"];?></td>
                    
					<td><?php echo $row["plate_id"];?></td>
					<td><?php echo $row["model"];?></td>
					<td><?php echo $row["body"];?></td>
					<td><?php echo $row["brand"];?></td>
					<td><?php echo $row["color"];?></td>
					<td><?php echo $row["year"];?></td>
					<td><?php echo $row["status"];?></td>
					<td><?php echo $row["price_day"];?></td>
                    
					<td><?php echo $row["office_id"];?></td>
					<td><?php echo $row["office_country"];?></td>
					<td><?php echo $row["office_city"];?></td> 
				</tr>
				<?php endwhile;?>
			
			</table>
		
		</form>

    </section>

</body>
</html>