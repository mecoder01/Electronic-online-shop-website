<?php
	session_start();//session start
	require '../database_link.php';//linking to database
	require 'adminHeader.php';//header of the page
	require '../footer.php';//footer of the page
	if (isset($_POST['addAdmin'])){//addAdmin is set
		$adminAdd = $pdo->prepare("INSERT INTO admin_user(
			fullName, email, username, password, permission) VALUES (:fullName, :email, :username, :password, :permission)");
		$admin_array=[//creating admin_array array loop
			'fullName'=>$_POST['fullName'],
			'email'=>$_POST['email'],
			'username'=>$_POST['username'],
			'password'=>password_hash($_POST['password'], PASSWORD_DEFAULT),
			'permission'=>$_POST['permission']
		];
		if ($adminAdd->execute($admin_array)) 
		{//redirecting to userDisplay page after execution
			header('Location:userDisplay.php');
		}
		else
		{//generating error message
			echo 'Invalid information';
		}
	}
	if (isset($_POST['cancel'])) 
	{//redirecting to userDisplay page
		header('Location:userDisplay.php');
	}
?>
<body>
	<main>
		<fieldset>
			<!-- Creating a form for adding the user -->
			<h2><b>Add new Admin account</b></h2>
			<form class="fill" action="addAdmin.php" method="POST">
				<label class="label_name">Full Name:</label><br>				
				<input type="text" name="fullName"><br><br>
				<label class="label_name">User Name:</label><br>
				<input type="text" name="username"><br><br>
				<label class="label_name">Email:</label><br>
				<input type="email" name="email"><br><br>
				<label class="label_name">Password:</label><br>
				<input type="Password" name="password"><br><br>
				<label class="label_name">Permission:</label>
				<input type="radio" name="permission" value="YES" checked>Yes
				<input type="radio" name="permission" value="NO">No
				<br><br>
				<input type="submit" name="addAdmin" value="Add" id="regis">
				<input  type="submit" name="cancel" value="Cancel">	
			</form>
		</fieldset>
	</main>
</body>