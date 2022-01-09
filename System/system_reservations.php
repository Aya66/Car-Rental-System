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

	<section class=" white-colour font20 scrollbar">

		<?php

		if (isset($_POST["search"])) {
			$searchedValModel = $_POST["searchedValModel"];
			$searchedValColor = $_POST["searchedValColor"];
			$query = "	SELECT *, U.country AS user_country, U.city AS user_city, O.country AS office_country, O.city AS office_city
						FROM reservation R, user U, car C, office O
						WHERE R.user_id=U.user_id AND R.plate_id=C.plate_id AND R.office_id=O.office_id
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
				FROM reservation
				ORDER BY reservation_id";
		
		$result = $conn->query($sql);  //gets the data of the user with the given inputs
		
		$modelArray = array();
		$bodyArray = array();
		$brandArray = array();
		$colorArray = array();
		$yearArray = array();
		$statusArray = array();
		$officeArray = array();
		
		if ($result->num_rows > 0) {

			while ($row = $result->fetch_assoc()) {  // check if the data exists
				$modelArray[] = $row["model"];
				$bodyArray[] = $row["body"];
				$brandArray[] = $row["brand"];
				$colorArray[] = $row["color"];
				$yearArray[] = $row["year"];
				$statusArray[] = $row["status"];
				$officeArray[] = $row["office_id"];
			}
			
		}
		else {  //if data does not exit, sends error to login page
			echo "no cars exist";
		}

		$modelArray = array_unique($modelArray);
		$bodyArray = array_unique($bodyArray);
		$brandArray = array_unique($brandArray);
		$colorArray = array_unique($colorArray);
		$yearArray = array_unique($yearArray);
		$statusArray = array_unique($statusArray);
		$officeArray = array_unique($officeArray);

		?>

		<form action="system_reservations.php" method="POST">

			<br>
			<input type="text" name="searchedValModel" placeholder="Search here">
			<input type="text" name="searchedValColor" placeholder="Search here">
			<input type="submit" name="search" value="Filter">
			<br>

			<br>
			<table class="white-colour font20 black-background">

				<tr>
					<th>No</th>
					<th>Reservation_Date</th>
					<th>User_ID</th>
					<th>First_Name</th>
					<th>Last_Name</th>
					<th>Email</th>
					<th>Birthdate</th>
					<th>Gender</th>
					<th>Country</th>
					<th>City</th>
					<th>Plate_Number</th>
					<th>Model</th>
					<th>Body</th>
					<th>Brand</th>
					<th>Color</th>
					<th>Year</th>
					<th>Status</th>
					<th>Office_ID</th>
					<th>Office_Country</th>
					<th>Office_City</th>
					
				</tr>
				<?php while($row = mysqli_fetch_array($searchResults)):?>
				<tr>
                    <td><?php echo $row["reservation_id"];?></td>
					<td><?php echo $row["reservation_date"];?></td>
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