<html>
<head>
    <!--Style sheets-->
    <link rel="stylesheet" href="colours.css">
    <link rel="stylesheet" href="location-size.css">
    <link rel="stylesheet" href="fonts.css">
    <script>
        function success(){
            alert("Payment Successful!");
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
		<a href="index.html">
        	<h2 class="font26 navbar-third white-colour">Car Rental System</h2>
		</a>
        <a href="logout.php">
        	<h2 class="font26 logout-margins white-colour">Logout</h2>
		</a>
    </nav>
	<section class=" white-colour font20 scrollbar">
        <?php
            session_start();
            if(isset($_GET['id']) && $_GET['id'] !== ""){
                $_SESSION['id'] = $_GET['id'];
            }
            $id = $_SESSION['id'];

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "carrentalsystem";
            $conn = new mysqli($servername, $username, $password, $dbname);  //creates the connection
            $sql = "SELECT *
            FROM `reservation`,`car`
            WHERE user_id = $id AND paid = FALSE AND reservation.plate_id = car.plate_id";
            $result = mysqli_query($conn,$sql);
            
            if(isset($_POST["pay"])){
                $paid = "UPDATE `reservation` SET paid = TRUE, rental_date = date(CURRENT_TIMESTAMP), return_date = DATE_ADD(date(CURRENT_TIMESTAMP),INTERVAL rent_days DAY) WHERE user_id = $id";
                $conn->query($paid);
            }
            $conn->close();

        ?>
        <h1 class="login-text white-colour font30">Unpaid Reservations</h1>
        <table id="customers">
            <tr>
                <th class="font16 white-colour">Plate ID</th>
                <th class="font16 white-colour">Model</th>
                <th class="font16 white-colour">Reservation Date</th>
                <th class="font16 white-colour">Rent duration(days)</th>
                <th class="font16 white-colour">price/day</th>
                <th class="font16 white-colour">price</th>
                <!--<th class="font16 white-colour">Model</th>-->
            </tr>
            <?php $total_price = 0; ?>
            <?php while($row = mysqli_fetch_array($result)):?>
            <tr>
                <td class="font16 white-colour"><?php echo $row["plate_id"];?></td>
                <td class="font16 white-colour"><?php echo $row["model"];?></td>
                <td class="font16 white-colour"><?php echo $row["reservation_date"];?></td>
                <td class="font16 white-colour"><?php echo $row["rent_days"];?></td>
                <td class="font16 white-colour"><?php echo $row["price_day"];?></td>
                <td class="font16 white-colour"><?php echo $row["price_day"] * $row["rent_days"];?></td>
                <?php $total_price = $total_price + $row["price_day"] * $row["rent_days"];?>
                <!--<td><?php echo $row["body"];?></td>-->
            </tr>
            <?php endwhile;?>
                <td ></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td class="font16 white-colour">Total price:<?php echo $total_price;?></td>
        </table>
        <br>
        <br>
        <form method="POST" class="form-border">
            <label>Payment Method</label>
			<br>
			<label class="font16 white-colour">Cash</label>
            <input type="radio" name="method">
            <br>
			<label class="font16 white-colour">Credit Card</label>
			<input type="radio" name="method">
			<br>
            <input type="password" placeholder="Enter Pin" class="reg-textbox">
            <br>
            <input class="white-colour buttons-size background-colour-button button-homepage radius-5" type="submit" value="Confirm Payment" name="pay" onclick="success()">
        </form>
    </section>
</body>
</html>