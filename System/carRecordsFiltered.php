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

    <table id="data_table" class="white-colour font20 black-background cool-table">

        <thead>
            <tr>
                <th>PlateID</th>
                <th>Model</th>
                <th>Body</th>
                <th>Brand</th>
                <th>Color</th>
                <th>Year</th>
                <th>Status</th>
                <th>Office</th>
                <th>Price/Day</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require('system_config.php');
            $db = new db;
            $result=$db->getCarRecordsWhere($_POST['model'], $_POST['body'], $_POST['brand'], $_POST['color'], $_POST['year'], $_POST['status'], $_POST['office'], $_POST['min_price'], $_POST['max_price']);
            
            while($row = mysqli_fetch_array($result)):
            ?>
            <tr id="<?php echo $row['plate_id']; ?>">

                <td><?php echo $row['plate_id'];?></td>
                <td><?php echo $row["model"];?></td>
                <td><?php echo $row['body'];?></td>
                <td><?php echo $row['brand'];?></td>
                <td><?php echo $row['color'];?></td>
                <td><?php echo $row['year'];?></td>
                <td><?php echo $row['status']?></td>
                <td><?php echo $row['office_id'];?></td>
                <td><?php echo $row['price_day'];?></td>
            
            </tr>
            <?php
            endwhile;
            //$db->closeCon();
            ?>
        </tbody>

    </table>

</body>