<?php
	require '../database_link.php';
	if (isset($_GET['catdel_id'])) {//deleting the data
		$del_Category = $pdo->prepare("DELETE FROM categories_db WHERE categories_db.category_id= :catdel_id");
		//creating an array loop
		$delcat_array=['catdel_id' => $_GET['catdel_id']];
		//executing the del_Category
		if ($del_Category->execute($delcat_array))
		{//redirecting to mainAdmin page
    		header('Location:mainAdmin.php?msg=Category Successfully Deleted');
    	}
		
	}
?>
