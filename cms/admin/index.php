<?php
session_start();
include_once('../includes/connection.php');

if(isset($_SESSION['logged_in'])){
	//display index
	?>
	<html>
		<head>
			<title>CMS Demo</title>
			<link rel="stylesheet" type="text/css" href="../assets/style.css" />
		</head>
		<body>
			<div class="container">
				<a href="index.php" id="logo">Content Management System</a>
				<br/>

				<ol>
					<li><a href="add.php">Add Article</a></li>
					<li><a href="delete.php">Delete Article</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ol>
			</div>
		</body>
	</html>

	<?php
}else{
	//display login
	if(isset($_POST['username'], $_POST['password'])){
		if(!empty($_POST['username']) && !empty($_POST['password'])){
			$username = $_POST['username'];
			$password = md5($_POST['password']);
			
			$query = $pdo->prepare("SELECT * FROM users WHERE user_name = ? AND user_password = ?");
			
			$query->bindValue(1, $username);
			$query->bindValue(2, $password);

			$query->execute();

			$num = $query->rowCount();

			if($num == 1){
				//user etered correct details
				$_SESSION['logged_in'] = true;
				header('Location: index.php');
				exit();
			}else{
				//user entered wrong details
				$error = 'Incorrect details!';
			}

		}else{
			$error = 'All fields are required.';
		}
	}
	?>
	<html>
		<head>
			<title>CMS Demo</title>
			<link rel="stylesheet" type="text/css" href="../assets/style.css" />
		</head>
		<body>
			<div class="container">
				<a href="index.php" id="logo">Content Management System</a>
				<br/><br/>
				<?php if(isset($error)){ ?>
					<small style="color:#aa0000;"><?php echo $error; ?></small>
					<br/><br/>
				<?php } ?>


				<form action="index.php" method="post" autocomplete="off">
					<input type="text" name="username" placeholder="Username" />
					<input type="password" name="password" placeholder="Password" />
					<input type="submit" value="Login" />
				</form>
			</div>
		</body>
	</html>

	<?php
}

?>