<?php 
session_start();
$msg='';
if(empty($_SESSION['allowed']) OR $_SESSION['allowed']=='non' ) {
	$title='Redirecting';
	header('Location: login.php');
}
				try {
					$bdd=new PDO("mysql:host=localhost;dbname=ramsa;charset=utf8","root","");
					}
					catch(Exception $e)
						{
			        die('Erreur : '.$e->getMessage());
					}
	if(!empty($_GET['delete'])){
		$req=$bdd->preapre('DELETE FROM agent WHERE Matricule=?');
		$req->execute(array($_GET['delete']));
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Techniciens</title>
	<style type="text/css">
	.tab {
  		margin-top: 40px;
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
	</style>
</head>
<body>
<?php include('includes/header.php'); ?>
<div style="position: absolute; margin-top: 130px;">
    		<a href='add_tech.php'><img src='images/add-128.png' width='30px'></a>
    	</div>
	<div>
		<?php
				

				$req=$bdd->query('SELECT * FROM agent');	
				if($req) {
					echo "<table class='tab' align='center'>";
					echo "<tr><th>Technicien</th><th>Matricule</th><th>Localité</th><th>Email</th><th>CIN</th></tr>";
					while($info=$req->fetch()) {
						echo "<tr> <td class='tab'>";
				        echo $info['Prenom_A'].' '.$info['Nom_A'] ;
				        echo "</td><td>";
				        echo $info['Matricule'];
				        echo "</td><td >";
				        echo $info['Localite'];
				        echo "</td><td>";
				        echo $info['Email'];
				        echo '</td>' ;
				        echo" <td>";
				        echo $info['CIN_A'];
				        echo '</td>' ;
				        echo "<td>
				<div style='margin-top:5px;'>
				 <a href=\"techniciens.php?delete=".$info['Matricule']."\"><img width='20px' src='images/trash-512.png'> </a>
				 </div>
				 </td>";
				        }
				        echo "</tr>";
					}
			?>
	</div>
</body>
</html>