<html>
<head>

  <style>

    .welcome-msg{
      font-size: 50px;
      margin-left: 35%;
      margin-top: 50px;
    }

  </style>

</head>

<body>

  <?php
  
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "carrentalsystem";

  $email = $_POST["email"];  //gets input from user from user_login.php
  $pass = $_POST["pass"];

  $conn = new mysqli($servername, $username, $password, $dbname);  //creates the connection
  if ($conn->connect_error) {        //checks the connection
    die("Connection failed: " . $conn->connect_error);
  }
  $sql = "SELECT * 
          FROM user 
          WHERE password='$pass' and email='$email'";
  $result = $conn->query($sql);  //gets the data of the user with the given inputs

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {  // check if the data exists

      if ($row["is_admin"] == 1) { // if user is admin
        header('Location: /car-rental-system/system.php');
      }
      else { // if user is customer
        header('Location: /car-rental-system/customer.php');
      }
    
    }
  }
  else if ($email != $row["email"] || $pass != $row["password"]) {  //if data does not exit, sends error to login page
    header('Location: /car-rental-system/user_login.php? error=1');
  }
  
  $conn->close();

  ?>

</body>
</html>