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

		<a href="index.html">
        	<h2 class="font26 logout-margins white-colour">Logout</h2>
		</a>
    
    </nav>

	<section class=" white-colour font20 scrollbar">

		<?php
	
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "carrentalsystem";

		$conn = new mysqli($servername, $username, $password, $dbname);  //creates the connection
		if ($conn->connect_error) {        //checks the connection
			die("Connection failed: " . $conn->connect_error);
		}
		$sql = "SELECT * 
				FROM car";
		$result = $conn->query($sql);  //gets the data of the user with the given inputs

		if ($result->num_rows > 0) {
			echo "plate_id model body brand color year status office_id <br>";
			while ($row = $result->fetch_assoc()) {  // check if the data exists
				echo'	<div class="item-bar black-background">
						<h4 class="item-margins">'.
						$row["plate_id"]." ".$row["model"]." ".$row["body"]." ".$row["brand"]." ".$row["color"]." ".$row["year"]." ".$row["status"]." ".$row["office_id"]."<br>"
						.'</h4>
						</div>';
			}
		}
		else {  //if data does not exit, sends error to login page
			echo "no cars exist";
			//header('Location: /car-rental-system/user_login.php? error=1');
		}
		
		$conn->close();

		?>

    </section>

</body>
</html>