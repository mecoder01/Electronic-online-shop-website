<?php
	session_start();//session start
	require '../database_link.php';//linked to database
	require 'header.php';//requiring header

	if (isset($_POST['register'])){//register is set when in action
		$userAdd = $pdo->prepare("INSERT INTO admin_user(
			fullName,username,email,password) VALUES (:fullName, :username, :email, :password)");
		$user_array=[//creating an array loop
			'fullName'=>$_POST['fullName'],
			'username'=>$_POST['username'],
			'email'=>$_POST['email'],
			//hashing the password
			'password'=>password_hash($_POST['password'], PASSWORD_DEFAULT)
		];//executing the array
		if ($userAdd->execute($user_array))
		{//redirecting to login page
			header('Location:../login.php');
		}
		else
		{//error message generating
			echo 'Invalid information';
		}
	}
	// cancel is set when in action
	if (isset($_POST['cancel'])) 
	{//redirecting the index page
		header('Location:../index.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="../electronics.css" />
</head>
<body>
	<main>
		<fieldset>
			<!-- creating a form for registration -->
			<h2><b>Create an Account</b></h2>
			Please fill up your information for registration<br><br><br>
			<form class="fill" action="signUp.php" method="POST">
				<label class="label_name">Full Name:</label><br>				
				<input type="text" name="fullName"><br><br>
				<label class="label_name">User Name:</label><br>
				<input type="text" name="username"><br><br>
				<label class="label_name">Email:</label><br>
				<input type="text" name="email"><br><br>
				<label class="label_name">Password:</label><br>
				<input type="Password" name="password"><br><br>
				<input type="Submit" name="register" value="Register" id="regis">	
				<input type="Submit" name="cancel" value="Cancel">	
			</form>
		</fieldset>
	</main>
	<?php require '../footer.php'; ?>
</body>