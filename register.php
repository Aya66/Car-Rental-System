<html>

<head>
</head>

<body>

  <?php

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "carrentalsystem";

  $fname = $_POST["fname"];   // gets input from user from user_registeration.php
  $lname = $_POST["lname"];
  $email = $_POST["email"];
  $db = date('Y-m-d', strtotime($_POST['bd']));
  $gender = $_POST["gender"];
  $country = $_POST["country"];
  $city = $_POST["city"];
  $pass = $_POST["pass"];

  $conn = new mysqli($servername, $username, $password, $dbname);  // creates the connection
  if ($conn->connect_error) {    						//checks the connection
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT * FROM user WHERE email='$email'"; // checks if email already exists in db
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    header('Location: /car-rental-system/user_register.php? error=1'); // sends error and closes connection
    $conn->close();
  }

  $sql = "INSERT INTO user (first_name, last_name, email, birthdate, gender, country,  city, password) 
  VALUES ('$fname', '$lname', '$email', '$db', '$gender', '$country', '$city', '$pass')";  //puts the given data into the db

  if ($conn->query($sql) === TRUE) {  // if data is placed in db correctly, sends user to the customer page
    header("Location: /car-rental-system/Customer/customer.php? email= '$email'");
  }
  else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
  
  ?>

</body>
</html>