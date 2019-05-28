<?php
	session_start();//session started
	if(!isset($_SESSION['sessUserId'])){
		header('Location:../login.php');
	}
	require '../database_link.php';//linking with database
	require 'header.php';//requring header
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Ed's Electronics</title>
		<section></section>
		<?php require '../aside.php'; ?>
		<main>
			<!-- This is the header of the userIndex page-->
			<h1>Welcome to Ed's Electronics</h1>
			<p>We stock a large variety of electrical goods including phones, tvs, computers and games. Everything comes with at least a one year guarantee and free next day delivery.</p>
			<h2>Product list</h2><br>
			<ul class="products">
				<?php 
				//This code will show the products information where recent added product will display first
					$listProducts = $pdo->prepare("SELECT * FROM products_db ORDER BY product_id DESC LIMIT 10");
					$listProducts->execute();//executing the listproducts 
					foreach($listProducts as $listProduct){
						//Displaying products information which is limits to 10
						echo '<li><h3>'.$listProduct['product_name'] . '</h3>
							<p>'. $listProduct['product_description'] . '</p><div class="price">£' . 
							$listProduct['product_cost'] . '</div></li>';
					}
				 ?>
			</ul>			
			<hr /><!-- horizontal line -->
		</main>
		<?php require '../footer.php'; ?>
    </body>
</html>
