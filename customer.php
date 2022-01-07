<?php
		if(isset($_POST["search"])){
			$searchedValModel = $_POST["searchedValModel"];
			$searchedValColor = $_POST["searchedValColor"];
			$query = "SELECT `plate_id`, `model`, `body`, `brand`, `color`, `year`, `status`, `country`, `city` FROM `car`,`office` WHERE car.office_id = office.office_id AND (CONCAT(`plate_id`, `model`, `body`, `brand`, `color`, `year`, `status`, `country`, `city`) LIKE '%".$searchedValModel."%'
			AND CONCAT(`plate_id`, `model`, `body`, `brand`, `color`, `year`, `status`, `country`, `city`) LIKE '%".$searchedValColor."%')";
			$searchResults = getQueryResults($query);
		}
		else{
			$query ="SELECT C.plate_id, C.model, C.body, C.brand, C.color, C.year, C.status, OF.country, OF.city
					 FROM car C, office OF
					 WHERE C.office_id = OF.office_id
					 ORDER BY C.plate_id";
			$searchResults = getQueryResults($query);
			//$conn->close();
			
		}
		function getQueryResults($query){
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "carrentalsystem";
			$conn = mysqli_connect($servername, $username, $password, $dbname);  //creates the connection
			$filteredResult = mysqli_query($conn,$query);
			return $filteredResult;
			
		}

		?>


<html>
<head>

	<title>Customer</title>
	<!--Style sheets-->
	<link rel="stylesheet" href="colours.css">
    <link rel="stylesheet" href="location-size.css">
    <link rel="stylesheet" href="fonts.css">



	<script>
		function printFilter(){
			var model = document.getElementById("filteredModel").value;
			alert(model);
		}
	</script>
</head>

<body>

	<nav class="nav-bar black-background">
		<a href="index.html">
        	<h2 class="font26 title-margins white-colour">Car Rental System</h2>
		</a>
    </nav>
	<section class=" white-colour font20 scrollbar">

		<form action="customer.php" method="POST">
			<input type="text" name="searchedValModel" placeholder="Search here">
			<input type="text" name="searchedValColor" placeholder="Search here">
			<input type="submit" name="search" value="filter">
		<table>
			<tr>
				<th>plate_id</th>
				<th>model</th>
				<th>body</th>
				<th>brand</th>
				<th>color</th>
				<th>year</th>
				<th>status</th>
				<th>country</th>
				<th>city</th>
			</tr>
			<?php while($row = mysqli_fetch_array($searchResults)):?>
			<tr>
				<td><?php echo $row["plate_id"];?></td>
				<td><?php echo $row["model"];?></td>
				<td><?php echo $row["body"];?></td>
				<td><?php echo $row["brand"];?></td>
				<td><?php echo $row["color"];?></td>
				<td><?php echo $row["year"];?></td>
				<td><?php echo $row["status"];?></td>
				<td><?php echo $row["country"];?></td>
				<td><?php echo $row["city"];?></td>
			</tr>
			<?php endwhile;?>
		</table>
		</form>





<!--
		/*$conn = new mysqli($servername, $username, $password, $dbname);  //creates the connection
		if ($conn->connect_error) {        //checks the connection
			die("Connection failed: " . $conn->connect_error);
		}
		$sql = "SELECT C.plate_id, C.model, C.body, C.brand, C.color, C.year, C.status, OF.country, OF.city
				FROM car C, office OF
				WHERE C.office_id = OF.office_id
				ORDER BY C.plate_id";
		$result = $conn->query($sql);  //gets the data of the user with the given inputs
		$modelArray = array();
		if ($result->num_rows > 0) {
			echo "plate_id model body brand color year status country city <br>";
			while ($row = $result->fetch_assoc()) {  // check if the data exists
				$modelArray[] = $row["model"];
				echo'	<div class="item-bar black-background">
						<h4 class="item-margins">'.
						$row["plate_id"]." ".$row["model"]." ".$row["body"]." ".$row["brand"]." ".$row["color"]." ".$row["year"]." ".$row["status"]." ".$row["country"]." ".$row["city"]."<br>"
						.'</h4>
						</div>';
				
			}
		}
		else {  //if data does not exit, sends error to login page
			echo "no cars exist";
			//header('Location: /car-rental-system/user_login.php? error=1');
		}
		print print_r($modelArray);
		
		?> 
				<form method="POST" onsubmit="printFilter()">
						<label>Choose a car model:</label>
						<select name="model"  id="filteredModel">
						<option selected="selected">Choose one</option>
						<?php
						//foreach($modelArray as $item){
							//echo '<option value=' .$item. '>' .$item. '</option>';
						//}
						?>		
						</select>
						<input type="submit">
					   </form>-->
			
		<?php
		//$conn->close();

		?>

    </section>

</body>
</html>