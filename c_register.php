<?php
	include("includes/config.php");
	include("includes/classes/Account.php");
	include("includes/classes/constants.php");

	$account = new Account($con);

	if (isset($_POST['registerButton'])) {
		$username = $_POST['username'];
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$email = $_POST['email'];
		$email2 = $_POST['email2'];
		$password = $_POST['password'];
		$password2 = $_POST['password2'];
		$encrytPw = md5($password);
		$profilePic = "assests\images\profile pic\dp.png";
		$date = date("Y-m-d");
		
		if ($email == $email2 and $password == $password2){
			mysqli_query($con, "INSERT INTO consumer_login VALUES ('', '$username', '$firstName', '$lastName', '$email', '$encrytPw', '$date', '$profilePic')");
		}
		else {
			echo $account->getError(constants::$loginFailed);
		}

	}

	if(isset($_POST['loginButton'])) {
		$un = $_POST['loginUsername'];
		$pw = $_POST['loginPassword'];

		$pw  = md5($pw);

		$query = mysqli_query($con, "SELECT * FROM consumer_login WHERE username = '$un' AND password = '$pw'");

		if(mysqli_num_rows($query) == 1){
			$_SESSION['userLoggedIn'] = $un;
			header("Location: c_index.php");
		}
	}

	function keepValues($name){
		if (isset($_POST[$name])){
			echo $_POST[$name];
		}
	}
?>

<html>
<head>
	<title>Welcome to AgroGuide!</title>
	<link rel="stylesheet" type="text/css" href="assets/css/register.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="assets/js/register.js"></script>
</head>
<body>
	<?php

	if (isset($_POST['registerButton'])){
		echo '<script>
		$(document).ready(function(){
			$("#loginForm").hide();
			$("#registerForm").show();
		});
	</script>';
	}

	else {
		echo '<script>
		$(document).ready(function(){
			$("#loginForm").show();
			$("#registerForm").hide();
		});
	</script>';
	}

	?>

	<div id="background">

		<div id="loginContainer">

			<div id="inputContainer">
				<form id="loginForm" action="c_register.php" method="POST">
					<h2>Login to your account</h2>
					<p>
						<?php echo $account->getError(constants::$loginFailed);?>
						<label for="loginUsername" id="l">Username</label>
						<input id="loginUsername" name="loginUsername" type="text" value="<?php keepValues('loginUserName') ?>" placeholder="e.g. bartSimpson" required>
					</p>
					<p>
						<label for="loginPassword">Password</label>
						<input id="loginPassword" name="loginPassword" type="password" value="<?php keepValues("loginPassword") ?>" placeholder="Your password" required>
					</p>
					<button type="submit" name="loginButton" >LOG IN</button>

					<div class="accountAlreadyExist">
						<span id="hideLogin">Don't have an account yet? Signup here</span>
					</div>
					
				</form>



				<form id="registerForm" action="c_register.php" method="POST">
					<h2>Create your free account</h2>
					<p>
						<?php echo $account->getError(constants::$usernameCharacters);?>
						<?php echo $account->getError(constants::$EmailInvalid);?>
						<?php echo $account->getError(constants::$nameAlreadyTaken)?>

						<label for="username">Username</label>
						<input id="username" name="username" type="text" value="<?php keepValues("username") ?>" placeholder="e.g. bartSimpson" required>
					</p>

					<p>
						<?php echo $account->getError(constants::$firstnameCharacters); ?>
						<label for="firstName">First name</label>
						<input id="firstName" name="firstName" type="text" value="<?php keepValues("firstName") ?>" placeholder="e.g. Bart" required>
					</p>

					<p>
						<?php echo $account->getError(constants::$lastnameCharacters); ?>
						<label for="lastName">Last name</label>
						<input id="lastName" name="lastName" type="text" value="<?php keepValues("lastName") ?>" placeholder="e.g. Simpson" required>
					</p>

					<p>
						<?php echo $account->getError(constants::$EmailsDoNotMatch); ?>
						<?php echo $account->getError(constants::$EmailInvalid); ?>
						<?php echo $account->getError(constants::$emailAlreadyTaken)?>
						<label for="email">Email</label>
						<input id="email" name="email" type="email"value="<?php keepValues("email") ?>" placeholder="e.g. bart@gmail.com" required>
					</p>

					<p>
						<label for="email2">Confirm email</label>
						<input id="email2" name="email2" type="email"value="<?php keepValues("email2") ?>" placeholder="e.g. bart@gmail.com" required>
					</p>

					<p>
						<?php echo $account->getError(constants::$passwordsDoNotMatch); ?>
						<?php echo $account->getError(constants::$passwordsNotAlphanumeric); ?>
						<?php echo $account->getError(constants::$passwordsCharacters); ?>
						<label for="password">Password</label>
						<input id="password" name="password" type="password" value="<?php keepValues("password") ?>" placeholder="Your password" required>
					</p>

					<p>
						<label for="password2">Confirm password</label>
						<input id="password2" name="password2" type="password" value="<?php keepValues("password2") ?>" placeholder="Your password" required>
					</p>

					<button type="submit" name="registerButton">SIGN UP</button>

					<div class="accountAlreadyExist">
						<span id="hideRegister">Already have an account yet? Login here</span>
					</div>
					
				</form>
			</div>
		</div>

		<div id="loginQuote">

			<h1>Agro Guide</h1>
			<h2>To Others, It's Dirt. To Us, It's Potential</h2>
			
		</div>

	</div>

</body>
</html>