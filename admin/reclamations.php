<?php 
session_start();
$msg='';
if(empty($_SESSION['allowed']) OR $_SESSION['allowed']=='non' ) {
	$title='Redirecting';
	header('Location: login.php');
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Réclamations</title>
	<style type="text/css">
			.tab {
  		margin-top: 30px;
  		text-align: center;
  		border-collapse: collapse;
  	}
  	.tab th {
  		color:#0782c8;
  	}
  	.tab tr,td  {
  		border:2px solid #96999a ;
  		width: 324px;
  	}
  	.tab a {
  		text-decoration: none;

  	}
	</style>
</head>
<body>
<?php include('includes/header.php'); ?>
		<div>
			<?php
				
				try {
					$bdd=new PDO("mysql:host=localhost;dbname=ramsa;charset=utf8","root","");
					}
					catch(Exception $e)
						{
			        die('Erreur : '.$e->getMessage());
					}
				$req=$bdd->query('SELECT * FROM client NATURAL JOIN reclamation WHERE Id_Rec NOT IN (SELECT Id_Rec FROM intervention)');	
				if($req) {
					echo "<table class='tab' align='center'>";
					echo "<tr><th>Reclamation</th><th>Police</th><th>Localité</th><th>Date</th><th>Statut</th></tr>";
					while($info=$req->fetch()) {
						echo "<tr> <td class='tab'>";
				        echo $info['Objet'] ;
				        echo "</td><td><a href='customer_info.php?id=".$info['Police']."'>";
				        echo $info['Police'];
				        echo "</a></td><td >";
				        echo $info['Localite'];
				        echo "</td><td>";
				        echo $info['Date_Rec'];
				        echo '</td>' ;
				        if(!$info['Statut'])
				        	echo "<td style='color:red;'>On attend la validation du technicien</td>";
				        else {
				        	echo"<td style='color:green;'>En cours de traitement!</td> ";
				        }
				        echo "</tr>";
					}

					$req=$bdd->query('SELECT * FROM client NATURAL JOIN reclamation NATURAL JOIN intervention');	
					while($info=$req->fetch()) {
						echo "<tr> <td class='tab'>";
				        echo $info['Objet'] ;
				        echo "</td><td><a href='customer_info.php?id=".$info['Police']."'>";
				        echo $info['Police'];
				        echo "</a></td><td >";
				        echo $info['Localite'];
				        echo "</td><td>";
				        echo $info['Date_Rec'];
				        echo '</td>' ;
				        if($info['Etat_Inter']=='Réglé')
				        	echo "<td style='color:green;'>".$info['Etat_Inter']."</td>";
				        else {
				        	echo"<td style='color:red;'>".$info['Etat_Inter']."</td> ";
				        }
				        echo "</tr>";
						}
					}
				
				else 
					echo "Pas des reclamations!";

			?>
		</div>
</body>
</html>