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
</head>
<body>
    <nav class="nav-bar black-background">
		<a href="index.html">
        	<h2 class="font26 title-margins white-colour">Car Rental System</h2>
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
            FROM `reservation`
            WHERE user_id = $id AND paid = FALSE";
            $result = mysqli_query($conn,$sql);
            
            if(isset($_POST["pay"])){
                $paid = "UPDATE `reservation` SET paid = TRUE WHERE user_id = $id";
                $conn->query($paid);
            }
            $conn->close();

        ?>
        <h1 class="login-text white-colour font30">Unpaid Reservations</h1>
        <table class="form-border">
            <tr>
                <th class="font16 white-colour">Plate ID</th>
                <th class="font16 white-colour">Reservation Date</th>
                <th class="font16 white-colour">Price</th>
                <th class="font16 white-colour">Model</th>
            </tr>
            <?php while($row = mysqli_fetch_array($result)):?>
            <tr>
                <td class="font16 white-colour"><?php echo $row["plate_id"];?></td>
                <td class="font16 white-colour"><?php echo $row["reservation_date"];?></td>
                <!--<td><?php echo $row["body"];?></td>-->
            </tr>
            <?php endwhile;?>
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