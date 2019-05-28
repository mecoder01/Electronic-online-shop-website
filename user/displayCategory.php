<?php 
	session_start();
	require '../database_link.php';
?>
<!doctype html>
<html>
	<head>
		<title>Product Display</title>
		<?php require 'header.php'; ?>
		<section></section>
		<?php require '../aside.php' ?>
	<main>
		<h2>Product Lists</h2>
		<ul class="homeProduct">
			<?php
			$clickedProduct = $pdo->prepare("SELECT * FROM products_db WHERE category_id = :category_id");
			$clickedArray =['category_id' =>$_GET['category_id']];
			$clickedProduct->execute($clickedArray);
			foreach ($clickedProduct as $prodis) { ?>
				<li>
					<h3>Product Name: <?php echo $prodis['product_name']; ?></h3>
					<p><h4>Product Details:</h4>
					<?php echo $prodis['product_description']; ?></p>
					<div class="product_cost">£<?php echo $prodis['product_cost']; ?> </div>
					<h4>Product Reviews:</h4>
					<?php 
						$reviewDisplay = $pdo->prepare("SELECT * FROM review_table WHERE product_id = :product_id");
						$revCriteria=['product_id' => $prodis['product_id']];
						$reviewDisplay->execute($revCriteria);
						foreach ($reviewDisplay as $revDiv) {
							if ($revDiv['approval']=='AGREE'){
								echo '<p>' .$revDiv['review_description'] .'</p>';
							}
						}
					?>
					<?php 
						if (isset($_POST['comment'])) {
							$reviewAdd = $pdo->prepare("INSERT INTO review_table(product_id, approval, review_description) VALUES (:product_id,:approval,:review_description)");
							$review_array =[
								'product_id' => $_POST['product_id'],
								'approval' => $_POST['approval'],
								'review_description' => $_POST['review_description']
							];
							if ($reviewAdd->execute($review_array)) {
								header('Location:userIndex.php');
							}
							else echo 'Review didn\'t added' ;
						}
					?>
					<form action="" method="POST">
						<input type="hidden" name="product_id" value="<?php echo $prodis['product_id']; ?>">
						<input type="hidden" name="approval" value="DISAGREE">
						<textarea rows="5" cols="70" name="review_description" placeholder="Review your words..."></textarea>
						<input type="submit" name="comment" value="Review">
					</form>
				</li>
			<?php }?>
		</ul>
	</main>
	<?php require '../footer.php'; ?>
</body>
</html>