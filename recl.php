<?php 
session_start();
 $red=$msg='';
if($_SESSION['Valide']=='NON' OR empty($_SESSION['Valide'])) {
	header('Location: index.php');
}
if($_SERVER['REQUEST_METHOD']=='POST') {
	try {
	$bdd=new PDO('mysql:host=localhost;dbname=ramsa;charset=utf8','root','');
		}
		catch(Exception $e)
			{
        die('Erreur : '.$e->getMessage());
		}
	$req=$bdd->prepare('INSERT INTO reclamation(Date_Rec,Heure_Rec,Objet,Type_Incident,Police) VALUES(:DateR,:HeureR,:ObjetR,:TypeR,:PoliceR)');
	$date=date("Y/m/d");
	$heure=date("h:i:s");
	$req->execute(array(
		'DateR'=> $date,
		'HeureR'=>$heure,
		'ObjetR' => $_POST['message'],
		'TypeR' => 'Technique',
		'PoliceR' =>$_SESSION['NPOLICE']
		));
	$msg='<span style="color:green;">Votre Réclamation est bien envoyée</span>';
	session_destroy();
	$red="<meta http-equiv='refresh' content='1;url=index.php' />";

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Réclamation</title>
	<style type="text/css">
		.info {
			font-weight: bold;
		}
		#obj {
			width: 500px;
			height: 400px;
		}
	</style>
</head>
<body>
<div style="margin-top:-8px; margin-left:-8px; margin-right:-8px;"><?php include 'includes/header.php'; ?></div>
<div>
	<form action="recl.php" method="POST">
		<table align="center">
		<tr>
			<td><?php echo $msg; ?></td>
			<td><?php echo $red; ?> </td>
		</tr>
			<tr>
				<td>
					N°police:
				</td>
				<td class="info"><?php echo $_SESSION['NPOLICE']?></td>
			</tr>
			<tr>
				<td>Votre Nom et Prénom:</td>
				<td class="info"><?php echo $_SESSION['NOM'].' '.$_SESSION['PRENOM']; ?></td>
			</tr>
			<tr>
				<td>Votre CIN:</td>
				<td class="info"><?php echo $_SESSION['CIN']; ?></td>
			</tr>
			<tr>
				<td>Votre Adresse:</td>
				<td class="info"><?php echo $_SESSION['ADD']; ?></td>
			</tr>
			<tr>
				<td>Votre Téléphone:</td>
				<td class="info"> <?php echo $_SESSION['TEL']; ?></td>
			</tr>
			<tr>
				<td>Votre Email:</td>
				<td class="info"><?php echo $_SESSION['EMAIL']; ?></td>
			</tr>
			<tr>
				<td>Type de réclamation:</td>
				<td class="info">
					<input type="radio" name="technique" checked>Technique
				</td>
			</tr>
			<tr >
				<td style="vertical-align:top;">Objet:</td>
				<td><textarea type="text" name="message" id='obj'></textarea>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type="submit" name="Envoyer"></td>
			</tr>
		</table>
	</form>
</div>
<?php include("includes/footer.php"); ?>

</body>
</html>