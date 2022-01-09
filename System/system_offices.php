<html>
<head>

	<title>Offices</title>
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
			$searchedValOffice = $_POST["searchedValOffice"];
			$searchedValCountry = $_POST["searchedValCountry"];
			$searchedValCity = $_POST["searchedValCity"];
			$query = "	SELECT *
						FROM office
						WHERE CONCAT(`office_id`) LIKE '%".$searchedValOffice."%'
							AND CONCAT(`country`) LIKE '%".$searchedValCountry."%'
							AND CONCAT(`city`) LIKE '%".$searchedValCity."%'";
			$searchResults = getQueryResults($query);
		}
		else {
			$query = "	SELECT *
						FROM office
						ORDER BY office_id";
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
				FROM office
				ORDER BY office_id";
		
		$result = $conn->query($sql);  //gets the data of the user with the given inputs
		
		$officeArray = array();
		$countryArray = array();
		$cityArray = array();
		
		if ($result->num_rows > 0) {

			while ($row = $result->fetch_assoc()) {  // check if the data exists
				$officeArray[] = $row["office_id"];
				$countryArray[] = $row["country"];
				$cityArray[] = $row["city"];
			}
			
		}
		else {  //if data does not exit, sends error to login page
			echo "no cars exist";
		}

		$officeArray = array_unique($officeArray);
		$countryArray = array_unique($countryArray);
		$cityArray = array_unique($cityArray);

		?>

		<form action="system_offices.php" method="POST">

			<br>
			
			<label> OfficeID:</label>
			<select name="searchedValOffice">
				<option selected="selected"></option>
				<?php
				foreach($officeArray as $item){
					echo '<option value=' .$item. '>' .$item. '</option>';
				}
				?>
			</select>
						
			<label>Country:</label>
			<select name="searchedValCountry">
				<option selected="selected"></option>
				<?php
				foreach($countryArray as $item){
					echo '<option value=' .$item. '>' .$item. '</option>';
				}
				?>
			</select>
						
			<label>City:</label>
			<select name="searchedValCity">
				<option selected="selected"></option>
				<?php
				foreach($cityArray as $item){
					echo '<option value=' .$item. '>' .$item. '</option>';
				}
				?>
			</select>

			<input type="submit" name="search" value="Filter">
			<br>

			<br>
			<table class="white-colour font20 black-background cool-table">

				<tr>
					<th>OfficeID</th>
					<th>Country</th>
					<th>City</th>
				</tr>
				<?php while($row = mysqli_fetch_array($searchResults)):?>
				<tr>
                    <td><?php echo $row["office_id"];?></td>
                    <td><?php echo $row["country"];?></td>
                    <td><?php echo $row["city"];?></td>
				</tr>
				<?php endwhile;?>
			
			</table>
		
		</form>

    </section>

</body>
</html>