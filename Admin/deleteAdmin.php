<?php
	require '../database_link.php';//linking to database
	if (isset($_GET['adid'])) 
	{//preparing for execution
		$del_admin = $pdo->prepare("DELETE FROM admin_user WHERE admin_user.user_id= :adid");
		$del_array=[//creaiting an array loop
			'adid' => $_GET['adid']
		];
		if ($del_admin->execute($del_array)) 
		{//redirecting to userDisplay page for execution
    		header('Location:userDisplay.php?msg=Account Successfully Deleted');
    	}
		
	}
?>