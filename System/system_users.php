<html>
<head>

	<title>Users</title>
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
			$query = "SELECT `user_id`, `first_name`, `last_name`, `email`, `birthdate`, `gender`, `country`,`city` FROM user WHERE is_admin = 0";
			$searchResults = getQueryResults($query);
		}
		else {
			$query = "	SELECT `user_id`, `first_name`, `last_name`, `email`, `birthdate`, `gender`, `country`,`city`
						FROM user
                        WHERE is_admin = 0
						ORDER BY user_id";
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
				ORDER BY user_id";
		
		$result = $conn->query($sql);  //gets the data of the user with the given inputs
		
		$userArray = array();
		$genderArray = array();
		$countryArray = array();
		$cityArray = array();
		
		if ($result->num_rows > 0) {

			while ($row = $result->fetch_assoc()) {  // check if the data exists
				$userArray[] = $row["user_id"];
				$genderArray[] = $row["gender"];
				$countryArray[] = $row["country"];
				$cityArray[] = $row["city"];
			}
			
		}
		else {  //if data does not exit, sends error to login page
			echo "no cars exist";
		}

		$userArray = array_unique($userArray);
		$firstArray = array_unique($firstArray);
		$countryArray = array_unique($countryArray);
		$cityArray = array_unique($cityArray);

		?>

		<form action="system_users.php" method="POST">

			<br>
			<input type="text" name="searchedValModel" placeholder="Search here">
			<input type="text" name="searchedValColor" placeholder="Search here">
			<input type="submit" name="search" value="Filter">
			<br>

			<br>
			<table class="white-colour font20 black-background">

				<tr>
					<th>User ID</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Email</th>
					<th>Birthdate</th>
					<th>Gender</th>
					<th>Country</th>
					<th>City</th>
				</tr>
				<?php while($row = mysqli_fetch_array($searchResults)):?>
				<tr>
                    <td><?php echo $row["user_id"];?></td>
                    <td><?php echo $row["first_name"];?></td>
                    <td><?php echo $row["last_name"];?></td>
                    <td><?php echo $row["email"];?></td>
                    <td><?php echo $row["birthdate"];?></td>
                    <td><?php echo $row["gender"];?></td>
                    <td><?php echo $row["country"];?></td>
                    <td><?php echo $row["city"];?></td>
				</tr>
				<?php endwhile;?>
			
			</table>
		
		</form>

    </section>

</body>
</html>