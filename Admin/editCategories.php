<?php
	session_start();//session started 
	require '../login_connection.php';//restrict the page directly
	require '../database_link.php';//linked with database
	$get_cate = $pdo->prepare("SELECT * FROM categories_db WHERE category_id=:catedit_id");
	$get_cate->execute($_GET);
	//data are fetch
	$cate_msg=$get_cate->fetch();
	//when submitting the form
	if (isset($_POST['done'])) {//after edition and done button clicked
		$get_cate = $pdo->prepare("UPDATE categories_db
			SET
			category_name=:category_name,
			category_description=:category_description
			WHERE category_id=:id");
		unset($_POST['done']);
		if ($get_cate->execute($_POST)){//executing the get_cate
			header('Location:mainAdmin.php?cate_msg=Category Updated');
		}
	}//when cancel button clicked, directed to mainAdmin page
	if (isset($_POST['cancel'])) {
		header('Location:mainAdmin.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Category</title>
	<!-- providing header -->
	<?php require 'adminHeader.php';?>
	<main>
		<!-- creating a edit form for category -->
		<form action="editCategories.php" method="POST">
			<h1>Edit Category</h1>
			<input type="hidden" name="id" value="<?php echo $_GET['catedit_id'] ?>">
			<label class="label_name">Category Name:</label>
			<input class="label_desc" type="text" name="category_name" value="<?php echo $cate_msg['category_name']; ?>" />
			<br><br>
			<label class="label_name">Category Description:</label>
			<textarea class="label_desc" rows="15" name="category_description"><?php echo $cate_msg['category_description']; ?></textarea>
			<br><br>
			<input class="label_desc" type="submit" name="done" value="Done">
			<input class="label_desc" type="submit" name="cancel" value="Cancel">
		</form>
	</main>
</body>
</html>