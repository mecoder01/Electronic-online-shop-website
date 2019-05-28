<?php 
	session_start();//session started
	if(!isset($_SESSION['sessUserId'])){
		header('Location:../login.php');
	}
	require '../database_link.php'; 
	if (isset($_GET['search'])) {
		$key = $_GET['pd_search'];
		$result = $pdo->query("SELECT * FROM products_db WHERE product_name LIKE '%$key%'");
		unset($_GET['search']);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Search</title>
	<link rel="stylesheet" href="../electronic.css" />
	<?php require 'header.php'; ?>
	<section></section>
	<?php require '../aside.php'; ?>
	<main>
		<?php 
			echo '<ul class="homeProduct">';
			foreach ($result as $row) {
				echo '<b><h2>'. $row['product_name'] . '</h2></b>';
				echo $row['product_description'] . '<br><br><br>';
			}
			echo '</ul>';
		 ?>
	</main>
</body>
</html>