<html>
<head>

	<title>Register</title>
	<!--Style sheets-->
	<link rel="stylesheet" href="colours.css">
    <link rel="stylesheet" href="location-size.css">
    <link rel="stylesheet" href="fonts.css">

	<script>

		function emptyValidate() {    //checks if there are any empty fields
			var fname = document.getElementById("fname").value;
			var lname = document.getElementById("lname").value;
			var email = document.getElementById("email").value;
			var bd = document.getElementById("bd").value;
			var gender = document.getElementById("gender").value;
			var country = document.getElementById("country").value;
			var country = document.getElementById("city").value;
			var password = document.getElementById("password").value;
			var confirmPass = document.getElementById("confirmPass").value;
			if (fname == "") {
				alert("Must enter First Name");
				return false;
			}
			if (lname == "") {
				alert("Must enter Last Name");
				return false;
			}
			if (email == "") {
				alert("Must enter email");
				return false;
			}
			if (bd == "") {
				alert("Must enter birth-date");
				return false;
			}
			if (gender == "") {
				alert("Must enter gender");
				return false;
			}
			if (country == "") {
				alert("Must enter country");
				return false;
			}
			if (city == "") {
				alert("Must enter city");
				return false;
			}
			if (password == "") {
				alert("Must enter password");
				return false;
			}
			if (confirmPass == "") {
				alert("Must enter confirmed password");
				return false;
			}
		}

		function samePasswords() {    //checks if the user entered the same password and confirm password
			var password = document.getElementById("password").value;
			var confirmPass = document.getElementById("confirmPass").value;
			if (password != confirmPass) {
				alert("Password and confirmed password are not the same, please re-enter");
				return false;
			}
		}

		function validateAll() {
			if (emptyValidate() === false)
				return false;
			if (samePasswords() === false)
				return false;
			else
				return true;
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

		<h1 class="login-text white-colour font30">Register</h1>

		<form action="register.php" method="POST" onsubmit="return validateAll()" class="form-border">
			<!--<fieldset>-->
				<input type="text" placeholder="First Name" name="fname" id="fname" class="reg-textbox">
				<br>
				<input type="text" placeholder="Last Name" name="lname" id="lname" class="reg-textbox">
				<br>
				<input type="email" placeholder= "Email" name="email" id="email" class="reg-textbox">
				<br>
				<input type="date" placeholder="Birth-date" name="bd" id="bd" class="date-textbox">
				<label class="font16 white-colour">M</label>
				<input type="radio" placeholder="Gender" name="gender" id="gender" value = "M" >
				<label class="font16 white-colour">F</label>
				<input type="radio" placeholder="Gender" name="gender" id="gender" value = "F" >
				<br>
				<input type="text" placeholder="Country" name="country" id="country" class="reg-textbox">
				<br>
				<input type="text" placeholder="City" name="city" id="city" class="reg-textbox">
				<br>
				<input type="password" placeholder= "Password" name="pass" id="password" class="reg-textbox">
				<br>
				<input type="password" placeholder= "Confirm Password" name="passConfirm" id="confirmPass" class="reg-textbox">
				<br>
				<input class="white-colour buttons-size background-colour-button button-homepage radius-5" type="submit">
			<!--</fieldset>-->
		</form>

		<?php
			if ( isset($_GET['error']) && $_GET['error'] == 1 )  //received error if the email already exists in the database
			{
				echo "<p class='error-msg font20 white-colour'>" . "Email Already Exists";
			}
		?>
		
		<h2 class="font20 white-colour">Already registered? Login here:
			<a href="user_login.php"> <button class="white-colour reg-button-size background-colour-button button-homepage radius-5">Login</button> </a>
		</h2>
	
	</section>

</body>
</html>