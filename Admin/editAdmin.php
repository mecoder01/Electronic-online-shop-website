<?php
	session_start();
	require '../login_connection.php';
	require '../database_link.php'; 
	$get_Admin = $pdo->prepare("SELECT * FROM admin_user WHERE user_id=:aid");
	$get_Admin->execute($_GET);
	//data are fetch
	$admin_msg=$get_Admin->fetch();
	//when submitting the form
	if (isset($_POST['done'])) {
		$get_Admin = $pdo->prepare("UPDATE admin_user
			SET
			fullName=:fullName,
			username=:username,
			email=:email,
			permission=:permission
			WHERE user_id=:id");
		unset($_POST['done']);
			if ($get_Admin->execute($_POST)){
				header('Location:userDisplay.php?admin_msg=User info Edited');
			}
		}
	if (isset($_POST['cancel'])) {
		header('Location:userDisplay.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Edit</title>
	<?php require 'adminHeader.php';?>
	<main>
		<form action="editAdmin.php" method="POST">
			<h1>Edit Admin Information</h1>
			<input type="hidden" name="id" value="<?php echo $_GET['aid'] ?>">
			<label class="label_name">Full Name:</label>
			<input class="label_desc" type="text" name="fullName" value="<?php echo $admin_msg['fullName']; ?>" />
			<br><br>
			<label class="label_name">Username:</label>
			<input class="label_desc" type="text" name="username" value="<?php echo $admin_msg['username']; ?>" />
			<br><br>
			<label class="label_name">Email:</label>
			<input class="label_desc" type="text" name="email" value="<?php echo $admin_msg['email']; ?>" />
			<br><br>
			<label class="label_name">Permission:</label>
			<input type="radio" name="permission" value="YES"/>Yes
			<input type="radio" name="permission" value="NO" />No
			<br><br>			
			<input class="label_desc" type="submit" name="done" value="Done">
			<input class="label_desc" type="submit" name="cancel" value="Cancel">
		</form>
	</main>
</head>