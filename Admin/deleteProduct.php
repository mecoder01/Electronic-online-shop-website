<?php
	require '../database_link.php';//linking to database
	if (isset($_GET['proddel_id'])) {//proddeel_id is set
		$del_Product = $pdo->prepare("DELETE FROM products_db WHERE products_db.product_id= :proddel_id");
		$del_array=[//array loop created
			'proddel_id' => $_GET['proddel_id']
		];
		//redirecting to the mainAdmin page after execution
		if ($del_Product->execute($del_array)) {
    		header('Location:mainAdmin.php?msg=Product Successfully Deleted');
    	}
		
	}
?>