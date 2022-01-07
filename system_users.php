<html>
<head>

	<title>Users</title>
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