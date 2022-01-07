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
			$searchedValBody = $_POST["searchedValBody"];
			$searchedValBrand = $_POST["searchedValBrand"];
			$searchedValColor = $_POST["searchedValColor"];
			$searchedValYear = $_POST["searchedValYear"];
			$searchedValStatus = $_POST["searchedValStatus"];
			$searchedValOffice = $_POST["searchedValOffice"];
			$query = "	SELECT *
						FROM car
						WHERE CONCAT(`model`) LIKE '%".$searchedValModel."%'
							AND CONCAT(`body`) LIKE '%".$searchedValBody."%'
							AND CONCAT(`brand`) LIKE '%".$searchedValBrand."%'
							AND CONCAT(`color`) LIKE '%".$searchedValColor."%'
							AND CONCAT(`year`) LIKE '%".$searchedValYear."%'
							AND CONCAT(`status`) LIKE '%".$searchedValStatus."%'
							AND CONCAT(`office_id`) LIKE '%".$searchedValOffice."%'";
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

		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "carrentalsystem";
		$conn = new mysqli($servername, $username, $password, $dbname);  //creates the connection
		if ($conn->connect_error) {        //checks the connection
			die("Connection failed: " . $conn->connect_error);
		}
		$sql = "SELECT *
				FROM car
				ORDER BY plate_id";
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

		<form action="system_cars.php" method="POST">

			<br>
			
			<label> model:</label>
						<select name="searchedValModel">
						<option selected="selected"></option>
						<?php
						foreach($modelArray as $item){
							echo '<option value=' .$item. '>' .$item. '</option>';
						}
						?>
						</select>
						
			<label>body:</label>
						<select name="searchedValBody">
						<option selected="selected"></option>
						<?php
						foreach($bodyArray as $item){
							echo '<option value=' .$item. '>' .$item. '</option>';
						}
						?>		
						</select>
						
			<label>brand:</label>
						<select name="searchedValBrand">
						<option selected="selected"></option>
						<?php
						foreach($brandArray as $item){
							echo '<option value=' .$item. '>' .$item. '</option>';
						}
						?>		
						</select>
			<label>color:</label>
						<select name="searchedValColor">
						<option selected="selected"></option>
						<?php
						foreach($colorArray as $item){
							echo '<option value=' .$item. '>' .$item. '</option>';
						}
						?>		
						</select>
			<label>year:</label>
						<select name="searchedValYear">
						<option selected="selected"></option>
						<?php
						foreach($yearArray as $item){
							echo '<option value=' .$item. '>' .$item. '</option>';
						}
						?>		
						</select>
			<label>status:</label>
						<select name="searchedValStatus">
						<option selected="selected"></option>
						<?php
						foreach($statusArray as $item){
							echo '<option value=' .$item. '>' .$item. '</option>';
						}
						?>		
						</select>
			<label>Office:</label>
						<select name="searchedValOffice">
						<option selected="selected"></option>
						<?php
						foreach($officeArray as $item){
							echo '<option value=' .$item. '>' .$item. '</option>';
						}
						?>		
						</select>

			<input type="submit" name="search" value="Filter">
			<input type="text" name="newPlateID" placeholder="New Car Plate ID">
			<input type="submit" name="add" value="Add New Car">
			<input type="submit" name="save" value="Save Changes">
			<br>

			<br>
			<table class="white-colour font20 black-background">

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
							echo '	<option value="active">Active</option>
									<option value="out_of_service" selected="selected">Out of Service</option>';
						}
						else {
							echo '	<option value="active" selected="selected">Active</option>
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