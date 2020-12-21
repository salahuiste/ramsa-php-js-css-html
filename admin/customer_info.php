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
	<title>Customer Info</title>
</head>
<body>
<?php include 'includes/header.php'; ?>
<div>
	<?php try {
	$bdd=new PDO('mysql:host=localhost;dbname=ramsa;charset=utf8','root','');
		}
		catch(Exception $e)
			{
        die('Erreur : '.$e->getMessage());
		}
			$req = $bdd->prepare('SELECT * FROM client WHERE Police = ?');

			$req->execute(array($_GET['id']));
			$donnees=$req->fetch();
		?>
	<table align="center">
		<tr>
				<td>
					N°police:
				</td>
				<td class="info"><?php echo $donnees['Police']?></td>
			</tr>
			<tr>
				<td>Votre Nom et Prénom:</td>
				<td class="info"><?php echo $donnees['Nom_C'].' '.$donnees['Prenom_C']; ?></td>
			</tr>
			<tr>
				<td>Votre CIN:</td>
				<td class="info"><?php echo $donnees['CIN_C']; ?></td>
			</tr>
			<tr>
				<td>Votre Adresse:</td>
				<td class="info"><?php echo $donnees['Adresse_C']; ?></td>
			</tr>
			<tr>
				<td>Votre Téléphone:</td>
				<td class="info"> <?php echo $donnees['Tel']; ?></td>
			</tr>
			<tr>
				<td>Votre Email:</td>
				<td class="info"><?php echo $donnees['Email']; ?></td>
			</tr>
	</table>
</div>
</body>
</html>