<?php
session_start();
include_once('../includes/connection.php');
include_once('../includes/article.php');

$article = new Article;

if(isset($_SESSION['logged_in'])){
	if(isset($_GET['id'])){
		$id = $_GET['id'];

		$query = $pdo->prepare('DELETE FROM articles WHERE article_id = ?');
		$query->bindValue(1, $id);
		$query->execute();

		header('Location: delete.php');
	}

	$articles = $article->fetch_all();

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
				<h4>Select an article to Delete:</h4>

				<form action="delete.php" action="get">
					<select name="id" onchange="this.form.submit();">
						<?php foreach($articles as $article){ ?>
							<option value="<?php echo $article['article_id']; ?>"><?php echo $article['article_title']; ?>
							</option>
						<?php } ?>
					</select>
				</form>
			</div>
		</body>
	</html>
	<?php
}else{
	//redirect user to index so they can log in
	header('Location: index.php');
}
?>