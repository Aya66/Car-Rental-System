<html>
<head>
	<script>
		function emptyValidate(){  //checks if there are any empty fields
			var email = document.getElementById("email").value;
			var password = document.getElementById("password").value;
			if(email == ""){
				alert("Must enter email");
				return false;
			}
			if(password == ""){
				alert("Must enter password");
				return false;
			}
		}
	</script>
	<!--Style sheets-->
	<link rel="stylesheet" href="colours.css">
    <link rel="stylesheet" href="location-size.css">
    <link rel="stylesheet" href="fonts.css">
</head>
<body>
	<nav class="nav-bar black-background">
        <h2 class="font26 title-margins white-colour">Car Rental System</h2>
    </nav>
	<section>
	<h1 class="login-text white-colour font30">Login</h1>
	<form action="login.php" method="POST" class="form-border">
		<!--<fieldset>-->
            <label class="word-margin font20 white-colour">Email</label>
            <br>
            <input type="email" name="email" id="email" class="text-box">
            <br>
			<label class="word-margin font20 white-colour">Password</label>
            <br>
            <input type="password" name="pass" id="password" class="text-box">
            <br>
			<input type="submit" onclick="emptyValidate()" class="word-margin white-colour buttons-size background-colour-button button-homepage radius-5">
        <!--</fieldset>-->
    </form>
	</section>
	<br>
	<div>
        <h2 class="font20 white-colour sign-up-text-margins">Don't already have an account? Sign up here:</h2>
		<a href="customer_registeration.php">
        <button class="white-colour reg-button-size background-colour-button button-homepage word-margin radius-5">Register</button>
    	</a>
	</div>
<?php
	if ( isset($_GET['error']) && $_GET['error'] == 1 )  //received error if the email or password are invalid
{
     echo "<p class='error-msg font20 white-colour'>" . "Invalid email or password";
}
?>
</body>
</html>