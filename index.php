<?php
session_start();//session started
	if(isset($_SESSION['sessUserId'])){
		header('Location:login.php');
	}
	require 'database_link.php';
?>
<!doctype html>
<html>
	<head>
		<title>Ed's Electronics</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="electronic.css" />
	</head>
	<body>
	<header>
		<h1>Ed's Electronics</h1>
		<ul>
			<li><a href="index.php">Home</a></li>		
			<li>Products
				<ul>
				<?php 
					$dropListProduct = $pdo->prepare("SELECT * FROM categories_db");
					$dropListProduct->execute();
					foreach ($dropListProduct as $listingProducts)
					{
						echo '<li><a href="user/displayCategory.php?category_id='. $listingProducts['category_id'].'">' .$listingProducts['category_name'].'</a></li>';
					}
				?>
				</ul>
			</li>
			
			<li><a href="login.php">Login</a><br>
			<font size="2">Don't have an account?<a href="user/signUp.php" style="color: blue"><u> Register</u></a></font></li>
		</ul>
		<address>
			<p>We are open 9-5, 7 days a week. Call us on
				<strong>01604 11111</strong>
			</p>
		</address>
	</header>
		<section></section>
		<?php require 'aside.php'; ?>
		<main>
			<h1>Welcome to Ed's Electronics</h1>

			<p>We stock a large variety of electrical goods including phones, tvs, computers and games. Everything comes with at least a one year guarantee and free next day delivery.</p>
			<h2>Product list</h2>

			<ul class="products">
				<?php 
					$listProducts = $pdo->prepare("SELECT * FROM products_db ORDER BY product_id DESC LIMIT 10");
					$listProducts->execute();
					foreach($listProducts as $row){
						echo '<li><h3>'.$row['product_name'] . '</h3>
							<p>'. $row['product_description'] . '</p>
							<div class="price">£' .  $row['product_cost'] . '</div>
						</li>';
					}
				 ?>
			</ul>
			<hr />
		</main>
		<?php require 'footer.php'; ?>
    </body>
</html>
