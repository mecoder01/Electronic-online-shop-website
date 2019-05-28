<?php 
	session_start();//session started
	require '../login_connection.php';//restrict the page directly
	require '../database_link.php';//linked with database
	require '../footer.php';//footer of the page
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<?php
		require 'adminHeader.php';
		require 'adminMenu.php';
	?>
	<main>
		<?php if(isset($_GET['msg'])) echo '<h4>'. $_GET['msg'].'</h4>'; ?>
		<font size="10" style="text-align: center;"><p><strong><u><em>Dashboard</strong></em></u></p></font><br>
		<?php
		//Display the category table
			$variety = $pdo->prepare("SELECT * FROM categories_db");
			$variety->execute();
 		?>
 		<div>
 			<font style="text-align: center;"><u><h3>Table of Categories</h3></u></font><br>
 			<table border="1px"style="text-align: center;" >
 			<tr>
 				<th>Category_id</th>
 				<th>Category_name</th>
 				<th>Category_description</th>
 				<th>Action</th>
 			</tr>
 		<?php $id=1;
 			foreach ($variety as $categoryShow)
 			{
 				echo '<tr>';
 				echo '<td>'.$id++.'</td>';
 				echo '<td>'.$categoryShow['category_name'].'</td>';
 				echo '<td>'.$categoryShow['category_description'].'</td>';
 				echo '<td><a href="editCategories.php?catedit_id='. $categoryShow['category_id'] .'">Edit</a> | <a href="deleteCategory.php?catdel_id='. $categoryShow['category_id'] .'">Delete</a> </td>';
 				echo '</tr>';
 			}
 		?>
			</table>
		</div>
		<br><br><br>
 		<?php 
 			//Displaying the products table
			$producto = $pdo->prepare("SELECT * FROM products_db");
			$producto->execute();
 		?>
 		<div>
 			<!-- creating a table to display the data of products -->
 			<font style="text-align: center;"><u><h3>Table of Products</h3></u></font><br>
 			<table border="1px" style="text-align: center;">
	 			<tr>
	 				<th>Product_id</th>
	 				<th>Product_name</th>
			 		<th>Product_description</th>
			 		<th>Product_cost</th>
			 		<th>Product_quantity</th>
			 		<th>Category_id</th>
			 		<th>Featured</th>
			 		<th>Action</th>
	 			</tr>
		 		<?php $id=1;
		 			foreach ($producto as $productShow){
		 				echo '<tr>';
		 				echo '<td>'.$id++.'</td>';
		 				echo '<td>'.$productShow['product_name'].'</td>';
		 				echo '<td>'.$productShow['product_description'].'</td>';
		 				echo '<td>'.$productShow['product_cost'].'</td>';
		 				echo '<td>'.$productShow['product_quantity'].'</td>';
		 				echo '<td>'.$productShow['category_id'].'</td>';
		 				echo '<td>'.$productShow['featured'].'</td>';
		 				echo '<td><a href="editProduct.php?prodedit_id='. $productShow['product_id'] .'">Edit</a> | <a href="deleteProduct.php?proddel_id='. $productShow['product_id'] .'">Delete</a> </td>';
		 				echo '</tr>';
		 			}
		 		?>	 		
			</table>
		</div><br><br><br>
	<?php 
		$reviewTab = $pdo->prepare("SELECT * FROM review_table");
		$reviewTab->execute();
	?>
	<div>
		<font style="text-align: center;"><u><h3>Review Table</h3></u></font><br>
		<table border="1px" style="text-align: center;">
		<tr>
			<th>review_id</th>
			<th>product_id</th>
			<th>review_description</th>
			<th>Approval</th>
			<th>Action</th>
		</tr>
		<?php $id=1;
			foreach ($reviewTab as $reviewShow) {
				echo '<tr>';
				echo '<td>'. $id++ .'</td>';
				echo '<td>'. $reviewShow['product_id'] .'</td>';
				echo '<td>'. $reviewShow['review_description'] .'</td>';
				echo '<td>'.$reviewShow['approval'].'</td>';
				echo '<td><a href="reviewAccept.php?review_id='. $reviewShow['review_id'] .'">Aprove?</a></td>';
		 		echo '</tr>';

			}
		?>
		</table>
	</div>
	</main>
	<?php require '../footer.php';  ?>
</body>
</html>