<head>

	<!--Style sheets-->
	<link rel="stylesheet" href="/Car-Rental-System/Styles/colours.css">
    <link rel="stylesheet" href="/Car-Rental-System/Styles/location-size.css">
    <link rel="stylesheet" href="/Car-Rental-System/Styles/fonts.css">
	<!-- Scripts -->
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="jquery.tabledit.js"></script>
	<script type="text/javascript" src="custom_table_edit.js"></script>

</head>

<body>

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
        <?php
            require('customer_config.php');
            $db = new db;
            $result=$db->getCarRecordsWhere($_POST['model'], $_POST['body'], $_POST['brand'], $_POST['color'], $_POST['year'], $_POST['status'], $_POST['country'], $_POST['city']);
            
            while($row = mysqli_fetch_array($result)):
            ?>
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

</body>