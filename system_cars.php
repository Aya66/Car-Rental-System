<html>
<head>

	<title>Cars</title>
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

        <a href="system_cars.php">
        	<h2 class="font26 navbar-second white-colour">Customers</h2>
		</a>

        <a href="system_cars.php">
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
			$query = "SELECT * FROM car WHERE (CONCAT(`plate_id`, `model`, `body`, `brand`, `color`, `year`, `status`, `office_id`) LIKE '%".$searchedValModel."%'
			AND CONCAT(`plate_id`, `model`, `body`, `brand`, `color`, `year`, `status`, `office_id`) LIKE '%".$searchedValColor."%')";
			$searchResults = getQueryResults($query);
		}
		else {
			$query = "	SELECT *
						FROM car
						ORDER BY plate_id";
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

		if (isset($_POST["save"])) {

			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "carrentalsystem";
			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}

			"UPDATE car
			SET column1 = value1, column2 = value2, ...
			WHERE condition";
		
		}

		if (isset($_POST["add"])) {

			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "carrentalsystem";
			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}

			$newPlateID = $_POST["newPlateID"];

			if (validatePlateID($newPlateID)) {
				$sql = "INSERT INTO car (`plate_id`, `model`, `body`, `brand`, `color`, `year`, `status`, `office_id`) VALUES
				($newPlateID, '', '', '', '', '', '', NULL)";
			
				if ($conn->query($sql) === TRUE) {
					echo "New record created successfully";
					header("location:system_cars.php");
				}
				else {
					echo '	<h5 class="white-colour">
							Error: ' . $sql . "<br>" . $conn->error . '
							</h5>';
				}
			}
			else {
				echo '<h5 class="white-colour">"Error: Plate ID should be 4 digits long"</h5>' ;
			}

			$conn->close();

		}

		function validatePlateID($newPlateID) {
			if (strlen($newPlateID) == 4) {
				return 1;
			}
			else {
				return 0;
			}
		}

		?>

		<form action="system_cars.php" method="POST">

			<br>
			<input type="text" name="searchedValModel" placeholder="Search here">
			<input type="text" name="searchedValColor" placeholder="Search here">
			<input type="submit" name="search" value="Filter">
			<input type="text" name="newPlateID" placeholder="New Car Plate ID">
			<input type="submit" name="add" value="Add New Car">
			<input type="submit" name="save" value="Save Changes">
			<br>

			<br>
			<table class="white-colour font20">

				<tr>
					<th>plate number</th>
					<th>model</th>
					<th>body</th>
					<th>brand</th>
					<th>color</th>
					<th>year</th>
					<th>status</th>
					<th>office</th>
				</tr>
				<?php while($row = mysqli_fetch_array($searchResults)):?>
				<tr>
					<td><input type="text" name="plateID" value=<?php echo $row["plate_id"];?> readonly></td>
					<td><input type="text" name="carModel" value=<?php echo $row["model"];?>></td>
					<td><input type="text" name="carBody" value=<?php echo $row["body"];?>></td>
					<td><input type="text" name="carBrand" value=<?php echo $row["brand"];?>></td>
					<td><input type="text" name="carColor" value=<?php echo $row["color"];?>></td>
					<td><input type="number" name="carYear" min="1900" max="2099" step="1" value=<?php echo $row["year"];?>></td>
					<td>
						<?php
						echo '<select name="carStatus">';
						if ($row["status"] == "out_of_service") {
							echo '	<option value="out_of_service">Out of Service</option>
									<option value="active">Active</option>';
						}
						else {
							echo '	<option value="active">Active</option>
									<option value="out_of_service">Out of Service</option>';
						}
						echo '</select>';
						?>
					</td>
					<td><input type="text" name="officeID" value=<?php echo $row["office_id"];?>></td>
				</tr>
				<?php endwhile;?>
			
			</table>
		
		</form>

    </section>

</body>
</html>