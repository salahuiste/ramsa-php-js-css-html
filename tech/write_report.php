<?php
session_start();
$msg='';
$bdd=new PDO('mysql:host=localhost;dbname=ramsa;charset=utf8;','root','');
if(empty($_SESSION['allow']) OR $_SESSION['allow']=='non' ) {
	$title='Redirecting';
	header('Location: login.php');
}
else {
	if($_SERVER['REQUEST_METHOD']=='POST') {
		if(isset($_POST['statut'])) {
			$req=$bdd->prepare('INSERT INTO intervention(Date_Inter,Rapport,Etat_Inter,Id_Rec,Matricule) VALUES(:datei,:rapp,:etatin,:idrec,:matr)');
			$date=date("Y/m/d");
			$req->execute(array(
				'datei' =>$date,
				'rapp' =>$_POST['rapport'],
				'etatin'=> $_POST['statut'],
				'idrec' => $_GET['id'],
				'matr'=>$_SESSION['matri']
				));
			$msg='<p style="color:green;">Votre rapport est bien ajouté</p>';

		}
		else {
			$msg='<p style="color:red;">tous les champs sont obligatoires</p>';
		}

	}

}
?>

<!DOCTYPE html>
<html>
<head>
	<title>écrire le rapport</title>
	<style type="text/css">
		table {
			text-align: center;
		}
	</style>
</head>
<body>
<?php include('includes/header.php') ?>
		<div id='formdiv'>
			<div>
				<form action=<?php echo"write_report.php?id=".$_GET['id']; ?> method="POST">
				<table align="center">
				<tr>
					<td colspan="2"><?php echo $msg; ?></td>
				</tr>
				<?php 
					$req=$bdd->prepare('SELECT * FROM reclamation WHERE Id_Rec=?');
					$req->execute(array($_GET['id']));
					echo "<tr>";
						echo"<td>Reclamation ID:</td>";
						echo "<td>".$_GET['id']."</td>";
					echo"</tr>";
					$donnees=$req->fetch();
					echo "<tr>";
						echo"<td>Reclamation:</td>";
						echo "<td>".$donnees['Objet']."</td>";
					echo"</tr>";
				?>
					<tr>
						<td>Rapport:</td>
						<td>
							<textarea rows="10" cols="60" name="rapport" required></textarea>
						</td>	
					</tr>
					<tr>
						<td>Statut:</td>
						<td><input type="radio" name="statut" value='Réglé' id='reg'><label for='reg'>Réglé</label>
						<input type="radio" name="statut" value="Non-Réglé" id='nonreg'><label for='nonreg'>Non-Réglé</label>
						</td>
					</tr>
					<tr>
						<td align="center" colspan="2"><input type="submit" name="Envoyer" id='butt'></td>
					</tr>
				</table>
			</form>
			</div>
</body>
</html>