<?php 
	session_start();//session started
	require '../login_connection.php';//restrict the page directly
	require '../database_link.php';//linked with the database
	require '../footer.php';//footer of the page
	if(isset($_POST['done'])){//when done button clicked
		//data can be add by INSERT code
		$categoryAdd = $pdo->prepare("INSERT INTO categories_db(category_name,category_description) VALUES (:category_name, :category_description)");
		$category_array =[//creating and array loop
			'category_name'=>$_POST['category_name'],
			'category_description'=>$_POST['category_description']
		];
		//directed to the admin main page
		if ($categoryAdd->execute($category_array)) {
			header('Location:mainAdmin.php');
		}
		else{
			echo 'Error Generated';
		}
	}
	if (isset($_POST['cancel'])) {//when cancel button click
			header('Location:mainAdmin.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Category</title>
	<?php require 'adminHeader.php'; require '../footer.php'; ?>
	<main>
		<!-- creating a form for adding the category -->
		<form action="addCategory.php" method="POST">
			<h1>Add Category</h1>
			<label class="label_name">Category Name:</label>
			<input class="label_desc" type="text" name="category_name" />
			<br><br>
			<label class="label_name">Category Description:</label>
			<textarea class="label_desc" rows="10" name="category_description" ></textarea>
			<br><br>
			<input class="label_desc" type="submit" name="done" value="Done"><br>
			<input class="label_desc" type="submit" name="cancel" value="Cancel">
		</form>
	</main>
</body>
</html>