<?php
session_start();
$msg='';
$aff=0;
$title='Réclamation';
if($_SERVER["REQUEST_METHOD"]=="POST") {
	try {
	$bdd=new PDO('mysql:host=localhost;dbname=ramsa;charset=utf8','root','');
		}
		catch(Exception $e)
			{
        die('Erreur : '.$e->getMessage());
		}

			$req = $bdd->prepare('SELECT * FROM client WHERE Police = ?');

			$req->execute(array($_POST['numpolice']));
			$donnees=$req->fetch();
			if(empty($donnees['Police'])) {
				$msg='<span style="color:red;">Le numéro de police n\'existe pas!</span>'; 
				$aff=1;
			}
					
			else {
				$_SESSION['NPOLICE']=$donnees['Police'];
				$_SESSION['CIN']=$donnees['CIN_C'];
				$_SESSION['NOM']=$donnees['Nom_C'];
				$_SESSION['PRENOM']=$donnees['Prenom_C'];
				$_SESSION['ADD']=$donnees['Adresse_C'];
				$_SESSION['TEL']=$donnees['Tel'];
				$_SESSION['EMAIL']=$_POST['emailc'];
				$modify=$bdd->prepare('UPDATE client SET Email=:emaill WHERE Police=:NP');
				$modify->execute(array(
					'emaill' => $_POST['emailc'],
					'NP' => $_POST['numpolice']
					));
				$_SESSION['Valide']='YES';
				$title='Redirecting';
				header('Location: recl.php');

			}	

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Espace Client</title>
	<style type="text/css">
		body {
			 width: 1200px;
		    margin: auto;
		    display: flex;
		    flex-direction: column;
		    border-right: 2px solid #045FB4;
			border-left: 2px solid #045FB4;
		}
		#title_page {
			margin-top: -5px;
			margin-left: 10px; 
			color: #045FB4;
		}
		#rec a{
			display: flex;
			text-decoration: none;
		}
		#rec span {
			margin-top: 30px;
		}
		#rec img  {
			width: 100px;
			height: 80px;
		}
		.main {
			height:100%;
			width:0px;
			overflow-x: hidden;
			position: relative;
		}
		#forml {
			display: flex;
						}
		 #forml div {
		 	margin-right: 30px;
		 }				
		#bloc_page {
			display: flex;
			flex-direction: column;
		}
	</style>
	<script type="text/javascript">
		function openrec () {
			document.getElementById('recform').style.width='250px';

		}

  </script>
</head>
<body onload="<?php if($aff) echo 'openrec()'; ?>">
<?php include("includes/header.php"); ?>
<div id="bloc_page">
	<div id='title_page'>
		<h2>Espace Client:</h2>
	</div>
	<div id='forml'>
	<div id='rec'>
		<a href="#" onclick="openrec();"><img src="images/reclamation.png"><span>Faire une réclamation?</span></a>
	</div>
	<div id="recform" class="main" align="center">
		<form action="espace_client.php" method="post">
		<table>
			<tr>
				<td>Numéro de police:</td>
				<td><input type="text" name="numpolice" required></td>
			</tr>
			<tr>
				<td>Email:</td>
				<td><input type="email" name="emailc" required></td>
			</tr>
			<tr>
				<td colspan="2" style="text-align: center;"><input type="submit" name="butt" value="Valider"></td>
			</tr>
		</table>		
		</form>
	</div>
		<div><?php echo $msg; ?></div>

	</div>
		<div></div>

</div>
<?php include("includes/footer.php"); ?>

</body>
</html>