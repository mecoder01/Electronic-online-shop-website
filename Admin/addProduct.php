<?php 
	session_start();//session started
	require '../login_connection.php';//restrict the page directly
	require '../database_link.php';//linked with the database
	require '../footer.php';//footer of the page
	if(isset($_POST['done'])){//done button is set
		$productAdd = $pdo->prepare("INSERT INTO products_db(product_name,product_description,product_cost,product_quantity,category_id,featured) VALUES (:product_name, :product_description, :product_cost, :product_quantity, :category_id, :featured)");
		$product_array =[//creating the array loop
			'product_name'=>$_POST['product_name'],
			'product_description'=>$_POST['product_description'],
			'product_cost'=>$_POST['product_cost'],
			'product_quantity'=>$_POST['product_quantity'],
			'category_id'=>$_POST['category_id'],
			'featured'=>$_POST['featured']
		];
		//redirected to the admin main page after execution
		if ($productAdd->execute($product_array)) {
			header('Location:mainAdmin.php');
		}
		else{//whenever fault occur
			echo 'Error Generated';
		}
	}//redirecting the cancel button to set
	if (isset($_POST['cancel'])) {
		header('Location:mainAdmin.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Product</title>
	<?php require 'adminHeader.php'; require '../footer.php'; ?>
	<main>
		<!-- creating a form to add the product -->
		<form action="addProduct.php" method="POST">
			<h1>Add Product</h1>
			<label class="label_name">Product Name:</label>
			<input class="label_desc" type="text" name="product_name" />
			<br><br>
			<label class="label_name">Product Description:</label>
			<textarea class="label_desc" rows="10" name="product_description" ></textarea>
			<br><br>
			<label class="label_name">Product Cost:</label>
			<input class="label_desc" type="text" name="product_cost" />
			<br><br>
			<label class="label_name">Product Quantity:</label>
			<input class="label_desc" type="text" name="product_quantity" />
			<br><br>
			<label class="label_name">Category:</label>
			<select name="category_id">
				<?php
					$categoryDisplay = $pdo->prepare("SELECT * FROM categories_db");
					$categoryDisplay->execute();
					//foreach loop created to add
					foreach ($categoryDisplay as $verticalDisplay) {
						echo '<option value="'. $verticalDisplay['category_id'] .'">';
						echo $verticalDisplay['category_name'];
						echo '</option>';
					}
				?> 
			</select>
			<br><br>
			<label class="label_name">Featured:</label>
				<input type="radio" name="featured" value="YES" checked>Yes
				<input type="radio" name="featured" value="NO">No
			<br><br>	
			<input class="label_desc" type="submit" name="done" value="Done">
			<input class="label_desc" type="submit" name="cancel" value="Cancel">
		</form>
	</main>
</head>
<body>

</body>
</html>