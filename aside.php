<aside>
	<form action="searchProduct.php" method="GET">
		<input type="text" name="pd_search" placeholder="Search" >
		<input type="submit" name="search" value="Search">
	</form>
	<h1>Featured Product</h1>
	<?php 
		//listing all the features of product from database
		$listFeaturedProducts = $pdo->prepare("SELECT * FROM products_db");
		//this code will execute the above statement
		$listFeaturedProducts->execute();
		foreach($listFeaturedProducts as $featuredProduct){
			if ($featuredProduct['featured']==='YES') {
				echo '<p><strong>'.$featuredProduct['product_name'] .'</strong></p>';
				echo '<p>'.$featuredProduct['product_description'] . '</p>';
			}
		}
	?>
</aside>