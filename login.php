<?php 
	session_start();
	if(isset($_SESSION['sessUserId'])){
		header('Location:user/userIndex.php');
	}
	require 'database_link.php';
	if(isset($_POST['login'])) //when login form is submitted 
	{
		$stmt = $pdo->prepare("SELECT * FROM admin_user WHERE username = :username");
		$loginCriteria=[
			'username' => $_POST['username']
		];
		$stmt->execute($loginCriteria);
		$formPass = $_POST['password'];
		unset($_POST['password']);
		if($stmt->rowCount() > 0)
		{
			$user = $stmt->fetch();
			if (password_verify($formPass, $user['password'])) 
			{
				$_SESSION['sessUserId'] = $user['user_id'];
				if($user['permission']==='YES')
				{
					header('Location:Admin/mainAdmin.php');
				}
				else{
					header('Location:user/userIndex.php');	
				}
			}
			else echo 'Password failed';
		}
		else echo 'Username or password may be incorrect';
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Log in</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="electronic.css" />
</head>
<body>
   <main>
	<fieldset>
	<legend>User Login</legend>
		<form action="login.php" method="POST">
			Username:<br>
			<input type="text" name="username"><br><br>
			Password:<br>
			<input type="Password" name="password"><br><br>
			<a href="user/signUp.php">Register?</a>
			<input type="Submit" name="login" value="Login" id="regis">	
		</form>
	</fieldset>
</main>
</body>
</html>