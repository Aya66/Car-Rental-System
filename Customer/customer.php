<?php
session_start();
if(isset($_GET['email']) && $_GET['email'] !== ""){
	$_SESSION['email'] = $_GET['email'];
}
$sesEmail = $_SESSION['email'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carrentalsystem";
$sql = "SELECT user_id
FROM `user`
WHERE `user`.email = $sesEmail ";
$conn = mysqli_connect($servername, $username, $password, $dbname);  //creates the connection
$result = $conn->query($sql);
while($row = mysqli_fetch_array($result)){
	$id = $row["user_id"];
}
if(isset($_POST["checkout"])){
	header("Location: /car-rental-system/customer/checkout.php? id='$id'");
}
if(isset($_POST["rentCar"])){
	header("Location: /car-rental-system/customer/customer.php? id='$id'");
}
if(isset($_POST["rents"])){
	header("Location: /car-rental-system/customer/rents.php? id='$id'");
}
$sql = "DELETE FROM `reservation` WHERE return_date < date(CURRENT_TIMESTAMP)";
$result = $conn->query($sql);
?>

<html>
<head>

	<title>Cars</title>
	<!--Style sheets-->
	<link rel="stylesheet" href="/Car-Rental-System/Styles/colours.css">
    <link rel="stylesheet" href="/Car-Rental-System/Styles/location-size.css">
    <link rel="stylesheet" href="/Car-Rental-System/Styles/fonts.css">

	<script>
		function emptyValidate() {  //checks if there are any empty fields
			var duration = document.getElementById("duration").value;
			if (duration == "") {
				alert("Must enter a duration");
				return false;
			}
			if (duration <= 0) {
				alert("Must enter a valid duration time");
				return false;
			}
		}
	</script>

	<style>
		#customers {
		font-family: Arial, Helvetica, sans-serif;
		border-collapse: collapse;
		width: 100%;
		}
		#customers td, #customers th {
		border: 1px solid #ddd;
		padding: 8px;
		color: white;
		font-weight: bold;
		}
		#customers tr:hover {background-color: grey;}
		#customers th {
		padding-top: 12px;
		padding-bottom: 12px;
		text-align: center;
		background-color: black;
		color: white;
		}
	</style>
</head>

<body>

	<nav class="nav-bar black-background">

		<form method="POST">
   			<button type="submit" name="rentCar" value="rentCar" class="btn-link navbar-first" >Cars</button>
		</form>

		<form method="POST">
   			<button type="submit" name="checkout" value="checkout" class="btn-link navbar-second" >Checkout</button>
		</form>

        <form method="POST">
   			<button type="submit" name="rents" value="rents" class="btn-link navbar-third" >Current Rentals</button>
		</form>

		<a href="/Car-Rental-System/logout.php">
        	<h2 class="font26 logout-margins white-colour">Logout</h2>
		</a>
    
    </nav>

    <section class="center scrollbar">



<?php
		if(isset($_POST["search"])){
			$searchedValModel = $_POST["searchedValModel"];
			$searchedValBody = $_POST["searchedValBody"];
			$searchedValBrand = $_POST["searchedValBrand"];
			$searchedValColor = $_POST["searchedValColor"];
			$searchedValYear = $_POST["searchedValYear"];
			$searchedValStatus = $_POST["searchedValStatus"];
			$searchedValCountry = $_POST["searchedValCountry"];
			$searchedValCity = $_POST["searchedValCity"];
			$query = "SELECT `plate_id`, `model`, `body`, `brand`, `color`, `year`, `status`, `country`, `city`,`price_day` FROM `car`,`office` WHERE 
			car.office_id = office.office_id 
			AND CONCAT(`plate_id`, `model`, `body`, `brand`, `color`, `year`, `status`, `country`, `city`) LIKE '%".$searchedValModel."%'
			AND CONCAT(`plate_id`, `model`, `body`, `brand`, `color`, `year`, `status`, `country`, `city`) LIKE '%".$searchedValBody."%'
			AND CONCAT(`plate_id`, `model`, `body`, `brand`, `color`, `year`, `status`, `country`, `city`) LIKE '%".$searchedValBrand."%'
			AND CONCAT(`plate_id`, `model`, `body`, `brand`, `color`, `year`, `status`, `country`, `city`) LIKE '%".$searchedValColor."%'
			AND CONCAT(`plate_id`, `model`, `body`, `brand`, `color`, `year`, `status`, `country`, `city`) LIKE '%".$searchedValYear."%'
			AND CONCAT(`plate_id`, `model`, `body`, `brand`, `color`, `year`, `status`, `country`, `city`) LIKE '%".$searchedValStatus."%'
			AND CONCAT(`plate_id`, `model`, `body`, `brand`, `color`, `year`, `status`, `country`, `city`) LIKE '%".$searchedValCountry."%'
			AND CONCAT(`plate_id`, `model`, `body`, `brand`, `color`, `year`, `status`, `country`, `city`) LIKE '%".$searchedValCity."%'
			AND car.plate_id NOT IN (SELECT plate_id FROM reservation)";
			$searchResults = getQueryResults($query);
		}
		else{
			$query ="SELECT C.plate_id, C.model, C.body, C.brand, C.color, C.year, C.status,C.price_day, OF.country, OF.city
					 FROM car C, office OF
					 WHERE C.office_id = OF.office_id AND C.plate_id NOT IN (SELECT plate_id FROM reservation)
					 ORDER BY C.plate_id";
			$searchResults = getQueryResults($query);
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
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "carrentalsystem";
		$conn = new mysqli($servername, $username, $password, $dbname);  //creates the connection
		if ($conn->connect_error) {        //checks the connection
			die("Connection failed: " . $conn->connect_error);
		}
		$sql = "SELECT C.plate_id, C.model, C.body, C.brand, C.color, C.year, C.status, OF.country, OF.city
				FROM car C, office OF
				WHERE C.office_id = OF.office_id AND C.plate_id NOT IN (SELECT plate_id FROM reservation)
				ORDER BY C.plate_id";
		$result = $conn->query($sql);  //gets the data of the user with the given inputs
		$plateArray = array();
		$modelArray = array();
		$bodyArray = array();
		$brandArray = array();
		$colorArray = array();
		$yearArray = array();
		$statusArray = array();
		$countryArray = array();
		$cityArray = array();
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {  // check if the data exists
				$plateArray[] = $row["plate_id"];
				$modelArray[] = $row["model"];
				$bodyArray[] = $row["body"];
				$brandArray[] = $row["brand"];
				$colorArray[] = $row["color"];
				$yearArray[] = $row["year"];
				$statusArray[] = $row["status"];
				$countryArray[] = $row["country"];
				$cityArray[] = $row["city"];
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
		$countryArray = array_unique($countryArray);
		$cityArray = array_unique($cityArray);
?>
		<br>
		<form action="customer.php" method="POST" class="white-colour bold font20">
			<label>  Model:  </label>
						<select name="searchedValModel">
						<option selected="selected"></option>
						<?php
						foreach($modelArray as $item){
							echo '<option value=' .$item. '>' .$item. '</option>';
						}
						?>		
						</select>
						
			<label>  Body:  </label>
						<select name="searchedValBody">
						<option selected="selected"></option>
						<?php
						foreach($bodyArray as $item){
							echo '<option value=' .$item. '>' .$item. '</option>';
						}
						?>		
						</select>
						
			<label>  Brand:  </label>
						<select name="searchedValBrand">
						<option selected="selected"></option>
						<?php
						foreach($brandArray as $item){
							echo '<option value=' .$item. '>' .$item. '</option>';
						}
						?>		
						</select>
			<label>  Color:  </label>
						<select name="searchedValColor">
						<option selected="selected"></option>
						<?php
						foreach($colorArray as $item){
							echo '<option value=' .$item. '>' .$item. '</option>';
						}
						?>		
						</select>
			<label>  Year:  </label>
						<select name="searchedValYear">
						<option selected="selected"></option>
						<?php
						foreach($yearArray as $item){
							echo '<option value=' .$item. '>' .$item. '</option>';
						}
						?>		
						</select>
			<label>  Status:  </label>
						<select name="searchedValStatus">
						<option selected="selected"></option>
						<?php
						foreach($statusArray as $item){
							echo '<option value=' .$item. '>' .$item. '</option>';
						}
						?>		
						</select>
			<label>  Country:  </label>
						<select name="searchedValCountry">
						<option selected="selected"></option>
						<?php
						foreach($countryArray as $item){
							echo '<option value=' .$item. '>' .$item. '</option>';
						}
						?>		
						</select>
			<label>  City:  </label>
						<select name="searchedValCity">
						<option selected="selected"></option>
						<?php
						foreach($cityArray as $item){
							echo '<option value=' .$item. '>' .$item. '</option>';
						}
						?>		
						</select>
			<input type="submit" name="search" value="filter">
		<br>
		<br>
		<table id="customers">
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
				<th>price/day</th>
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
				<td><?php echo $row["price_day"];?></td>
			</tr>

			<?php endwhile;?>
		</table>
		<form method="POST" class="white-colour bold font20">
			<br>
			<label>Enter the desired car's plate ID  </label>
			<select name="searchedValPlate">
						<option selected="selected"></option>
						<?php
						foreach($plateArray as $item){
							echo '<option value=' .$item. '>' .$item. '</option>';
						}
						?>		
						</select>
			<label for="duration">  Rent Duration (days)  </label>
			<input type="text" id="duration" name="duration" class="small-textbox">
			<input type="submit" value="Reserve" name="chosen" id="reserved" onclick="return emptyValidate()">
		</form>
		<?php
		
		if(isset($_POST["chosen"])){
			$searchedValPlate = $_POST["searchedValPlate"];
			$duration = $_POST["duration"];
			$car = "SELECT *
			FROM car,office
			WHERE car.office_id = office.office_id AND car.plate_id = $searchedValPlate";
			$finalResult = mysqli_query($conn,$car);
			
			?>
			<table id="customers">
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
				<th>price/day</th>
			</tr>
			<?php while($row = mysqli_fetch_array($finalResult)):?>
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
				<td><?php echo $row["price_day"];?></td>
				<?php $officeid = $row["office_id"];
				$plateid = $row["plate_id"];
				?>
			</tr>
			<?php endwhile;
			$reserve = "INSERT INTO `reservation` (`user_id`, `plate_id`, `office_id`, `reservation_date`, `paid`,`rent_days`) VALUES
			($id, $plateid, $officeid, date(CURRENT_TIMESTAMP), FALSE , $duration)";
			$conn->query($reserve);
			?>
		</table>
		<form method="POST">
			<input type="submit" value="Proceed to checkout" name="checkout">
		</form>
		<?php
		}
		$conn->close();
		?>
    </section>

</body>
</html>