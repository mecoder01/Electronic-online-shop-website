<meta charset="utf-8" />
<link rel="stylesheet" href="../electronic.css" />
</head>

<body>
	<header>
		<h1>Ed's Electronics</h1>
		<ul>
			<li><a href="userIndex.php">Home</a></li>		
			<li>Products
				<ul>
				<?php 
					$dropListProduct = $pdo->prepare("SELECT * FROM categories_db");
					$dropListProduct->execute();
					foreach ($dropListProduct as $listingProducts)
					{
						echo '<li><a href="displayCategory.php?category_id='. $listingProducts['category_id'].'">' .$listingProducts['category_name'].'</a></li>';
					}
				?>
				</ul>
			</li>
			<?php if(!isset($_SESSION['sessUserId'])){ ?>
				<li><a href="../login.php">Login</a><br>
				<font size="2">Don't have an account?
					<a href="signUp.php" style="color: blue"><u> Register</u></a></font></li>
				<?php } else{ ?>
					<li><a href="../userLogout.php">Logout</a><br>
				<?php } ?>	
		</ul>

		<address>
			<p>We are open 9-5, 7 days a week. Call us on
				<strong>01604 11111</strong>
			</p>
		</address>

	</header>