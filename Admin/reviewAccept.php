<?php 
	session_start();
	require '../login_connection.php';
	require '../database_link.php'; 
	$get_review = $pdo->prepare("SELECT * FROM review_table WHERE review_id =:review_id");
	$get_review->execute($_GET);
	$rev_msg=$get_review->fetch();

	if (isset($_POST['done'])) 
	{
		$get_review = $pdo->prepare("UPDATE review_table SET approval = :approval, 
			review_description = :review_description 
			WHERE review_id=:review_id");
		$getCriteria = [
			'approval' => $_POST['approval'],
			'review_description' => $_POST['review_description'],
			'review_id' => $_POST['id']
		];
		if ($get_review->execute($getCriteria)) 
		{
			header('Location:mainAdmin.php?rev_msg=Approved Successfully');
		}
	}
	if (isset($_POST['cancel'])) 
	{
		header('Location:mainAdmin.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Approve Review</title>
</head>
<?php require 'adminHeader.php'; ?>
<main>
	<form action="" method="POST">
		<h1>Review Approval</h1>
		<input type="hidden" name="id" value="<?php echo $_GET['review_id'] ?>"> 
		<label class="label_name">Review</label>
		<input class="label_desc" type="text" name="review_description" value="<?php echo $rev_msg['review_description'] ?>" readonly>
		<br><br>
			<label class="label_name">Approval:</label>
				<input type="radio" name="approval" value="AGREE"/>Agree
				<input type="radio" name="approval" value="DISAGREE" />Disagree
				<br><br>
			<input type="submit" name="done" value="Done">
			<input type="submit" name="cancel" value="Cancel">
	</form>
</main>
</html>