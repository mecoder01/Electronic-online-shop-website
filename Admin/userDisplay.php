<?php
	require '../database_link.php';
	require 'adminHeader.php';
	require '../footer.php';
?>
<title>Account Data</title>
<main>	
	<?php if(isset($_GET['msg'])) echo '<h4>'. $_GET['msg'].'</h4>'; ?>
	<h2><u><a href="mainAdmin.php">Return back</a></u></h2>
	<?php
	//Display table For Admin
		$adminInfo = $pdo->prepare("SELECT * FROM admin_user");
		$adminInfo->execute();
		?>
		<div>
			<font style="text-align: center;"><h3>Table of Users</h3></font><br>
			<table border="1px"style="text-align: center;" >
			<tr>
				<th>User_ID</th>
				<th>Full Name</th>
				<th>Username</th>
				<th>Email</th>
				<th>Password</th>
				<th>Permission</th>
				<th>Action</th>
			</tr>
		<?php $id=1;
			foreach ($adminInfo as $userInfo)
			{
				echo '<tr>';
				echo '<td>'.$id++.'</td>';
				echo '<td>'.$userInfo['fullName'].'</td>';
				echo '<td>'.$userInfo['username'].'</td>';
				echo '<td>'.$userInfo['email'].'</td>';
				echo '<td>'.$userInfo['password'].'</td>';
				echo '<td>'.$userInfo['permission'].'</td>';
				echo '<td><a href="editAdmin.php?aid='. $userInfo['user_id'] .'">Edit</a> | <a href="deleteAdmin.php?adid='. $userInfo['user_id'] .'">Delete</a> </td>' ;
				echo '</tr>';
			}
		?>
		</table>
		<p><a href="addAdmin.php?aaid='. $userInfo['admin_id'] .'">Add New User</a></p>
	</div><br><br><br>
</main>