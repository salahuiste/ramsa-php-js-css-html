<?php
session_start();
$title='';
if(empty($_SESSION['allow']) OR $_SESSION['allow']=='non' ) {
	$title='Redirecting';
	header('Location: login.php');
}
else {
	$title="Espace technique";

}
$bdd=new PDO('mysql:host=localhost;dbname=ramsa;charset=utf8;','root','');
if(!empty($_GET['activate'])) {
	$req=$bdd->prepare('UPDATE reclamation set Statut=1 WHERE Id_Rec=?');
	$req->execute(array($_GET['activate']));
	header('Location : ./index.php');
}
/*function ($police){

	echo "<script>alert('lol')</script>"
}*/

?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?></title>
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
	<script type="text/javascript">
		function infoclient(){
			alert("lol");
		}
	</script>
</head>
<body>
		<?php include('includes/header.php'); ?>
		<div>
			<?php
				
				$re=$bdd->query('SELECT Localite from agent where Matricule='.$_SESSION['matri'].'');
				$locatech=$re->fetch();
				$req=$bdd->prepare('SELECT * FROM client NATURAL JOIN reclamation WHERE Localite= ? AND Id_Rec NOT IN (SELECT Id_Rec FROM intervention)');
				$req->execute(array($locatech['Localite']));
				if($req) {
					echo "<table class='tab' align='center'>";
					echo "<tr><th>Reclamation</th><th>Police</th><th>Date</th><th>Statut</th></tr>";
					while($info=$req->fetch()) {
						echo "<tr> <td class='tab'>";
				        echo $info['Objet'] ;
				        echo "</td><td onclick='infoclient();'>";
				        echo $info['Police'];
				        echo "</td><td >";
				        echo $info['Date_Rec'];
				        echo '</td>' ;
				        if(!$info['Statut'])
				        	echo "<td><a href='index.php?activate=".$info['Id_Rec']."'>Valider</a></td>";
				        else {
				        	echo"<td style='color:green;'>En cours de traitement!</td> ";
				        }
				        echo "<td><a href='write_report.php?id=".$info['Id_Rec']."'>Rapport</> </td>";
				        echo "</tr>";
					}
				}
				
				else 
					echo "Pas des reclamations!";

			?>
		</div>
</body>
</html>