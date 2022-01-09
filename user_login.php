<html>
<head>

	<title>Login</title>
	<!--Style sheets-->
	<link rel="stylesheet" href="/Car-Rental-System/Styles/colours.css">
    <link rel="stylesheet" href="/Car-Rental-System/Styles/location-size.css">
    <link rel="stylesheet" href="/Car-Rental-System/Styles/fonts.css">

	<script>

		function emptyValidate() {  //checks if there are any empty fields
			var email = document.getElementById("email").value;
			var password = document.getElementById("password").value;
			if (email == "") {
				alert("Must enter email");
				return false;
			}
			if (password == "") {
				alert("Must enter password");
				return false;
			}
		}

	</script>

</head>

<body>

	<nav class="nav-bar black-background">
		<a href="index.html">
        	<h2 class="font26 title-margins white-colour">Car Rental System</h2>
		</a>
    </nav>

	<section class="center">

		<h1 class="login-text white-colour font30">Login</h1>
		
		<form action="login.php" method="POST" class="form-border">
			<!--<fieldset>-->
				<input type="email" placeholder="Email" name="email" id="email" class="reg-textbox">
				<br>
				<input type="password" placeholder="Password" name="pass" id="password" class="reg-textbox">
				<br>
				<input type="submit" onclick="emptyValidate()" class="white-colour buttons-size background-colour-button button-homepage radius-5">
			<!--</fieldset>-->
		</form>

		<?php
			if ( isset($_GET['error']) && $_GET['error'] == 1 )  //received error if the email or password are invalid
			{
				echo "<p class='error-msg font20 white-colour'>" . "Invalid email or password";
			}
		?>

		<h2 class="font20 white-colour">Don't already have an account? Sign up here:
			<a href="user_register.php"> <button class="white-colour reg-button-size background-colour-button button-homepage radius-5">Register</button> </a>
		</h2>
	
	</section>

</body>
</html>