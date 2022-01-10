<html>
<head>

	<title>Cars</title>
	<!--Style sheets-->
	<link rel="stylesheet" href="/Car-Rental-System/Styles/colours.css">
    <link rel="stylesheet" href="/Car-Rental-System/Styles/location-size.css">
    <link rel="stylesheet" href="/Car-Rental-System/Styles/fonts.css">
	<!-- Scripts -->
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="jquery.tabledit.js"></script>
	<script type="text/javascript" src="custom_table_edit.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {

			$("#ajaxdata").load("carRecords.php");
			$("#ajaxform").change(function(){
				var selected=$(this).val();
				$("#ajaxdata").load("carRecordsFiltered.php",{selected_price: selected});
			});
			$("#refresh").click(function(){
				$("#ajaxdata").load("carRecords.php");
			});
		
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){

			$("#ajaxdata").load("carRecords.php");

			//here
			var selectedModel;
			var selectedBody;
			var selectedBrand;
			var selectedColor;
			var selectedYear;
			var selectedStatus;
			var selectedOffice;
			var selectedPriceMin = '0';
			var selectedPriceMax = '99999';

			$("#minprice").on("change keyup paste", function(){
				//here
				selectedPriceMin=$(this).val();

				if (selectedPriceMin == "") {
					selectedPriceMin = "0";
				}
				if (selectedPriceMax == "") {
					selectedPriceMax = "999999";
				}

				$("#ajaxdata").load("carRecordsFiltered.php",{
					model: selectedModel,
					body: selectedBody,
					brand: selectedBrand,
					color: selectedColor,
					year: selectedYear,
					status: selectedStatus,
					office: selectedOffice,
					min_price: selectedPriceMin,
					max_price: selectedPriceMax
				});
				//here
			})



			$("#maxprice").on("change keyup paste", function(){
				//here
				selectedPriceMax=$(this).val();

				if (selectedPriceMin == "") {
					selectedPriceMin = "0";
				}
				if (selectedPriceMax == "") {
					selectedPriceMax = "999999";
				}

				$("#ajaxdata").load("carRecordsFiltered.php",{
					model: selectedModel,
					body: selectedBody,
					brand: selectedBrand,
					color: selectedColor,
					year: selectedYear,
					status: selectedStatus,
					office: selectedOffice,
					min_price: selectedPriceMin,
					max_price: selectedPriceMax
				});
				//here
			})



			$("#ajaxform1").change(function(){

				selectedModel=$(this).val();

				if (selectedPriceMin == ""){
					selectedPriceMin = '0';
				}
				if (selectedPriceMax == ""){
					selectedPriceMax = '99999';
				}
				
				$("#ajaxdata").load("carRecordsFiltered.php",{
					model: selectedModel,
					body: selectedBody,
					brand: selectedBrand,
					color: selectedColor,
					year: selectedYear,
					status: selectedStatus,
					office: selectedOffice,
					min_price: selectedPriceMin,
					max_price: selectedPriceMax
				});
			});


			
			$("#ajaxform2").change(function(){

				selectedBody=$(this).val();

				if (selectedPriceMin == ""){
					selectedPriceMin = '0';
				}
				if (selectedPriceMax == ""){
					selectedPriceMax = '99999';
				}

				$("#ajaxdata").load("carRecordsFiltered.php",{
					model: selectedModel,
					body: selectedBody,
					brand: selectedBrand,
					color: selectedColor,
					year: selectedYear,
					status: selectedStatus,
					office: selectedOffice,
					min_price: selectedPriceMin,
					max_price: selectedPriceMax
				});
			});



			$("#ajaxform3").change(function(){

				selectedBrand=$(this).val();

				if (selectedPriceMin == ""){
					selectedPriceMin = '0';
				}
				if (selectedPriceMax == ""){
					selectedPriceMax = '99999';
				}

				$("#ajaxdata").load("carRecordsFiltered.php",{
					model: selectedModel,
					body: selectedBody,
					brand: selectedBrand,
					color: selectedColor,
					year: selectedYear,
					status: selectedStatus,
					office: selectedOffice,
					min_price: selectedPriceMin,
					max_price: selectedPriceMax
				});
			});



			$("#ajaxform4").change(function(){

				selectedColor=$(this).val();

				if (selectedPriceMin == ""){
					selectedPriceMin = '0';
				}
				if (selectedPriceMax == ""){
					selectedPriceMax = '99999';
				}

				$("#ajaxdata").load("carRecordsFiltered.php",{
					model: selectedModel,
					body: selectedBody,
					brand: selectedBrand,
					color: selectedColor,
					year: selectedYear,
					status: selectedStatus,
					office: selectedOffice,
					min_price: selectedPriceMin,
					max_price: selectedPriceMax
				});
			});



			$("#ajaxform5").change(function(){

				selectedYear=$(this).val();

				if (selectedPriceMin == ""){
					selectedPriceMin = '0';
				}
				if (selectedPriceMax == ""){
					selectedPriceMax = '99999';
				}

				$("#ajaxdata").load("carRecordsFiltered.php",{
					model: selectedModel,
					body: selectedBody,
					brand: selectedBrand,
					color: selectedColor,
					year: selectedYear,
					status: selectedStatus,
					office: selectedOffice,
					min_price: selectedPriceMin,
					max_price: selectedPriceMax
				});
			});



			$("#ajaxform6").change(function(){

				selectedStatus=$(this).val();

				if (selectedPriceMin == ""){
					selectedPriceMin = '0';
				}
				if (selectedPriceMax == ""){
					selectedPriceMax = '99999';
				}

				$("#ajaxdata").load("carRecordsFiltered.php",{
					model: selectedModel,
					body: selectedBody,
					brand: selectedBrand,
					color: selectedColor,
					year: selectedYear,
					status: selectedStatus,
					office: selectedOffice,
					min_price: selectedPriceMin,
					max_price: selectedPriceMax
				});
			});


			$("#ajaxform7").change(function(){

				selectedOffice=$(this).val();

				if (selectedPriceMin == ""){
					selectedPriceMin = '0';
				}
				if (selectedPriceMax == ""){
					selectedPriceMax = '99999';
				}

				$("#ajaxdata").load("carRecordsFiltered.php",{
					model: selectedModel,
					body: selectedBody,
					brand: selectedBrand,
					color: selectedColor,
					year: selectedYear,
					status: selectedStatus,
					office: selectedOffice,
					min_price: selectedPriceMin,
					max_price: selectedPriceMax
				});
			});
			
			//here

			// $("#refresh").click(function(){
			// 	$("#ajaxdata").load("carRecords.php");
			// });

		});
	</script>

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
				$sql = "INSERT INTO car (`plate_id`, `model`, `body`, `brand`, `color`, `year`, `status`, `office_id`, `price_day`) VALUES
				($newPlateID, '', '', '', '', '', '', NULL, '')";
			
				if ($conn->query($sql) === TRUE) {
					echo "New record created successfully";
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

		$conn->close();

		?>

		<form method="POST">

			<br>
			
			<label>Model:</label>
			<select id="ajaxform1" name="searchedValModel">
				<option selected="selected"></option>
				<?php
				foreach($modelArray as $item){
					echo '<option value=' .$item. '>' .$item. '</option>';
				}
				?>
			</select>
						
			<label>Body:</label>
			<select id="ajaxform2" name="searchedValBody">
				<option selected="selected"></option>
				<?php
				foreach($bodyArray as $item){
					echo '<option value=' .$item. '>' .$item. '</option>';
				}
				?>
			</select>
						
			<label>Brand:</label>
			<select id="ajaxform3" name="searchedValBrand">
				<option selected="selected"></option>
				<?php
				foreach($brandArray as $item){
					echo '<option value=' .$item. '>' .$item. '</option>';
				}
				?>
			</select>

			<label>Color:</label>
			<select id="ajaxform4" name="searchedValColor">
				<option selected="selected"></option>
				<?php
				foreach($colorArray as $item){
					echo '<option value=' .$item. '>' .$item. '</option>';
				}
				?>
			</select>

			<label>Year:</label>
			<select id="ajaxform5" name="searchedValYear">
				<option selected="selected"></option>
				<?php
				foreach($yearArray as $item){
					echo '<option value=' .$item. '>' .$item. '</option>';
				}
				?>
			</select>

			<label>Status:</label>
			<select id="ajaxform6" name="searchedValStatus">
				<option selected="selected"></option>
				<?php
				foreach($statusArray as $item){
					echo '<option value=' .$item. '>' .$item. '</option>';
				}
				?>
			</select>

			<label>Office:</label>
			<select id="ajaxform7" name="searchedValOffice">
				<option selected="selected"></option>
				<?php
				foreach($officeArray as $item){
					echo '<option value=' .$item. '>' .$item. '</option>';
				}
				?>
			</select>

			<label>Price/Day:</label>
			<input id="minprice" type="number" name="searchedValPriceMin" placeholder="From">
			<input id="maxprice" type="number" name="searchedValPriceMax" placeholder="To">

			<br>
			<br>
			<input type="text" name="newPlateID" placeholder="New Car Plate ID">
			<input type="submit" name="add" value="Add New Car">
			<br>

		</form>

		<div id="ajaxdata">
		
		</div>
    
	</section>

</body>
</html>