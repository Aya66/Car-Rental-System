<html>
<head>

	<title>Reservations</title>
	<!--Style sheets-->
	<link rel="stylesheet" href="colours.css">
    <link rel="stylesheet" href="location-size.css">
    <link rel="stylesheet" href="fonts.css">

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

		<a href="logout.php">
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