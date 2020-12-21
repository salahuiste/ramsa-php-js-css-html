<?php 
 try {
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
	<title>Galerie</title>
	<style type="text/css">
		body {
			 width: 1200px;
			  margin: auto;
			 border-right: 2px solid #045FB4;
			border-left: 2px solid #045FB4;
		}
		#pagecourant {
			margin-top: -5px;
			margin-left: 10px; 
			color: #045FB4;
		}
		table {
			border:2px solid #045FB4;
			margin-bottom: 30px;
		}
		table img {
			width: 300px;
		}
	</style>
</head>
<body>
<?php include('includes/header.php') ?>
<div>
	<div>
		<div>
				<h2 id='pagecourant'>Galerie:</h2>
			</div>
		<div>
			<?php 
		$np;
		if(empty($_GET['page']) or $_GET['page']==1)
			$np=0;
		else 
			$np=$_GET['page'];
		$np*=3;
		$ge=$bdd->query('SELECT * FROM galerie LIMIT '.$np.',6');

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
						echo "<a href='.".$donnees['chemin']."'><img src='.".$donnees['chemin']."' ></a>";
					echo "</td>";
				}
				echo"</tr>";

				}


	?>
		</div>	
		<div>
			<?php 
		$getnm=$bdd->query('SELECT count(*)as nb_page FROM galerie');
		$nb_pagea=$getnm->fetch();
		$p=0;
		$p=$nb_pagea['nb_page']/6;
		if($nb_pagea['nb_page']%6) $p++;
		echo "<tr>";
		echo "<td>";
		echo "<form method='get' action='gallery.php'>";
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
		echo "</td>";
				echo "</tr>";

				echo "</table>";


	?>
		</div>
	</div>

</div>
<?php include('includes/footer.php') ?>

</body>
</html>