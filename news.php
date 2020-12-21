<?php
	try  {
		$bdd=new PDO("mysql:host=localhost;dbname=ramsa;charset=utf8","root","");
		}
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
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
        table {
        	margin-top: -40px;
        }
		td {
			width: 450px;
			height: 200px;
		}
		.td_page {
			display: flex;
			flex-direction: column;
		}
		.text_img {
			display: flex;			
		}
		.text_img p {
			margin-left: 10px;
		}
		.text_img img {
			width: 120px;
			height: 100px;
		}
		.text_lire {
			display: flex;
			flex-direction: column;
		}
		.text_lire a {
			margin-left: 70px;
		}

		.btt a{
			text-decoration: none;
			color:white;
			border-radius: 3px;
			background-color: #045FB4;

		}
		#title_page {
			margin-top: -5px;
			margin-left: 10px; 
			color: #045FB4;
		}
</style>
<body>
<?php include("includes/header.php"); ?>
<div>
<h2 id='title_page'>Les actualités:</h2>
</div>
<div>
	<?php 
		$np;
		if(empty($_GET['page']) or $_GET['page']==1)
			$np=0;
		else 
			$np=$_GET['page'];
		$np*=3;
		$ge=$bdd->query('SELECT * FROM tbl_news LIMIT '.$np.',6');

		echo "<table align='center'>";
		$j=0;
		$flag=0;
		while(!$flag){
				echo"<tr>";
				for($i=0;$i<3;$i++) {
					$donnees=$ge->fetch();
					if(!$donnees){
						$flag=1;
						break;
					}
					echo "<td>";
					echo "<div class='td_page'> <div><h4>".$donnees['title']."</h4> </div>";
					echo "<div class='text_img'>";
							echo"<div>";
								if(!$donnees['image']){
									$img="./images/img-icon.png";
								}
								else 
									$img=$donnees['image'];
								echo "<img src='".$img."'>";
							echo "</div>";
							echo "<div class='text_lire'>";
									echo "<div><p>";
										echo substr($donnees['description'],0,40);
										if(strlen($donnees['description'])<40) echo"</p>";
										else 
									echo "...</p>";
									echo "</div>";
									echo "<div class='btt'>";
										echo "<a  href='news_detail.php?id=".$donnees['id']."'>La suite</a>";
									echo "</div>";	
							echo"</div>";
							echo "</div>";
						echo "</div>";
					echo "</td>";
				}
				echo"</tr>";

				}
		echo "</table>";


	?>
</div>
<div align="right">
	<?php 
		$getnm=$bdd->query('SELECT count(*)as nb_page FROM tbl_news');
		$nb_pagea=$getnm->fetch();
		$p=0;
		$p=$nb_pagea['nb_page']/6;
		if($nb_pagea['nb_page']%6) $p++;
		echo "<form method='get' action='news.php'>";
		echo "Pages";
			echo"<select name='page'>";
				for($i=1;$i<=$p;$i++) {
					echo"<option value='".$i."'>";
					echo $i;
					echo "</option>";
				}

			echo "</select>";
		echo "<input type='submit' value='>>'>";	
		echo "</form>";

	?>
</div>
<?php include("includes/footer.php"); ?>
</body>
</html>