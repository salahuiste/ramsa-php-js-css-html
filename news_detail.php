<?php 
	try {
		$bdd=new PDO('mysql:host=localhost;dbname=ramsa;charset=utf8','root','');
	}
	catch(Exception $e)
			{
        die('Erreur : '.$e->getMessage());
		}
	if(empty($_GET['id'])) {
		header('Location: index.php');
	}	
	else {
		$re=$bdd->query('SELECT * FROM tbl_news WHERE id='.$_GET['id'].'');
		$donnees=$re->fetch();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>RAMSA</title>
	<style type="text/css">
		body
		{
		    width: 1200px;
		    margin: auto;
		    display: flex;
		    flex-direction: column;
		    border-right: 2px solid #045FB4;
			border-left: 2px solid #045FB4;
		}
		#imgar {
			width: 35%;
			float: left;
			margin-left: 10px;
			border-radius: 5px;

		}
		article {
		margin-top: 10px;
		margin-bottom: 10px;
		display: flex;
		} 
		article p {
			margin-left: 10px;
		}
		article  h1 {
			margin-left: 10px;

		}
	</style>
</head>
<body>
<?php include 'includes/header.php'; ?>
<div>
	<article>
		<?php
			if($donnees['id']) {
				if(!$donnees['image']){
					$img="./images/img-icon.png";
								}
				else {
					$img=$donnees['image'];
				}
				echo "<img id='imgar' src='".$img."'>";
				echo "<div id='para'>";
				echo "<h1>".$donnees['title']."</h1>";
				echo "<p>".$donnees['description']."</p>";
				echo "</div>";

			}
			else {
				echo "L'article n'est pas trouvé";
				header('location: news.php');
			}

		 ?>
	</article>
</div>
<?php include 'includes/footer.php'; ?>

</body>
</html>