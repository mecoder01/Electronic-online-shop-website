<?php
	session_start();//session started
	require '../login_connection.php';//restrict the page directly
	require '../database_link.php';//linked with the database
	require '../footer.php';//footer of the page 
	$get_prod = $pdo->prepare("SELECT * FROM products_db WHERE product_id=:prodedit_id");
	$get_prod->execute($_GET);//executing the get_prod
	//data are fetch
	$prod_msg=$get_prod->fetch();
	//when submitting the form
	if (isset($_POST['done'])) 
	{//this process is set when button clicked
		$get_prod = $pdo->prepare("UPDATE products_db
			SET
			product_name=:product_name,
			product_description=:product_description,
			product_cost=:product_cost,
			product_quantity=:product_quantity,
			category_id=:category_id,
			featured=:featured
			WHERE product_id=:id");
		unset($_POST['done']);
		if ($get_prod->execute($_POST))
		{//after execution page redirect to mainAdmin page
			header('Location:mainAdmin.php?prod_msg=Product Updated');
		}
	}
	if (isset($_POST['cancel']))
	{//cancel button is set to redirect the mainAdmin page
		header('Location:mainAdmin.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Product</title>
	<?php require 'adminHeader.php'; ?>
	<main>
		<form action="" method="POST">
			<h1>Edit Product</h1>
			<input type="hidden" name="id" value="<?php echo $_GET['prodedit_id'] ?>">
			<label class="label_name">Product Name:</label>
			<input class="label_desc" type="text" name="product_name" value="<?php echo $prod_msg['product_name']; ?>" />
			<br><br>
			<label class="label_name">Product Description:</label>
			<textarea class="label_desc" rows="15" name="product_description"><?php echo $prod_msg['product_description']; ?></textarea>
			<br><br>
			<label class="label_name">Product Cost:</label>
			<input class="label_desc" type="text" name="product_cost" value="<?php echo $prod_msg['product_cost']; ?>" />
			<br><br>
			<label class="label_name">Product Quantity:</label>
			<input class="label_desc" type="text" name="product_quantity" value="<?php echo $prod_msg['product_quantity']; ?>" />
			<br><br>
			<label class="label_name">Category:</label>
			<select name="category_id">
				<?php
					$categoryDisplay = $pdo->prepare("SELECT * FROM categories_db");
					$categoryDisplay->execute();

					foreach ($categoryDisplay as $verticalDisplay) {
						echo '<option value="'. $verticalDisplay['category_id'] .'" ';
						if($prod_msg['category_id']==$verticalDisplay['category_id']){ echo 'selected'; }
							echo '>';
						echo $verticalDisplay['category_name'];
						echo '</option>';
					}
				?> 
			</select>
			<br><br>
			<label class="label_name">Featured:</label>
				<input type="radio" name="featured" value="YES"/>Yes
				<input type="radio" name="featured" value="NO" />No
				<br><br>
			<input class="label_desc" type="submit" name="done" value="Done">
			<input class="label_desc" type="submit" name="cancel" value="Cancel">
		</form>
	</main>