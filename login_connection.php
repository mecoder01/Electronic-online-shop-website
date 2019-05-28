<?php
	if(!isset($_SESSION['sessUserId']))
	{
		header('Location:../login.php');
	}
?>
