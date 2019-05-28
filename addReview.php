<?php 
	session_start();
	require 'login_connection.php';
	require 'Admin/db_link.php';
	if (isset($_POST['revi'])) {
		$reviewAdd = $pdo->prepare("INSERT INTO review_table(product_id, review_description) VALUES (:product_id,:review_description)");
		$review_array =[
			'product_id' => $_POST['product_id'],
			'review_description' => $_POST['reviewText']
		];
		if ($reviewAdd->execute($review_array)) {
			header('Location:displayCategory.php');
		}
		else{
			echo 'Review didn\'t added' ;
		}
	}
	if (isset($_POST['cancel'])) {
		header('Location:displayCategory.php');
	}	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Review</title>
	<!-- <?php require 'Admin/adminHeader.php'; require 'footer.php'; ?> -->
	<main>
		<form action="addReview.php" method="POST">
			<h2>Review for the products</h2>
			<input type="hidden" name="product_id" value="<?php echo $_GET['product_id']; ?>">
			<textarea class="label_desc" rows="5" name="reviewText" placeholder="Text here your words..."></textarea>
			<input class="label_desc" type="submit" name="comment" value="Add Review">
			<input class="label_desc" type="submit" name="cancel" value="Cancel">
		</form>
</main>