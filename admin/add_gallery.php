<?php 
session_start();
$msg='';
if(empty($_SESSION['allowed']) OR $_SESSION['allowed']=='non' ) {
	$title='Redirecting';
	header('Location: login.php');
}
else {
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		try {
			$bdd=new PDO("mysql:host=localhost;dbname=ramsa;charset=utf8","root","");
		}
		catch(Exception $e)
			{
        die('Erreur : '.$e->getMessage());
		}
		$pat=NULL;
		$pre=$bdd->prepare('INSERT INTO galerie (chemin) VALUES(:chemin)');
		if (isset($_FILES['imagefile']) AND $_FILES['imagefile']['error'] == 0)

			{

        // Testons si le fichier n'est pas trop gros

	        if ($_FILES['imagefile']['size'] <= 1000000)

	        {

	                // Testons si l'extension est autorisée

	                $infosfichier = pathinfo($_FILES['imagefile']['name']);

	                $extension_upload = $infosfichier['extension'];

	                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');

	                if (in_array($extension_upload, $extensions_autorisees))

	                {

	                        // On peut valider le fichier et le stocker définitivement

	                        move_uploaded_file($_FILES['imagefile']['tmp_name'], '../galerie/' . basename($_FILES['imagefile']['name']));

							$pat='/galerie/' . basename($_FILES['imagefile']['name']);	    
							$msg='<span style="color:green;">Votre photo est bien téléchargé</span>'  ;                  

	                }
	                else 
	                	$msg='<span style="color:red;">Erreur</span>' ; 

        }

}
		$pre->execute(array(
			'chemin' => $pat
			));

	}

}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Ajouter une photo</title>
</head>
<body>
<?php include 'includes/header.php'; ?>
	<form action="add_gallery.php" method="post" enctype="multipart/form-data">
	<table align="center" style="margin-top: 20px;">
		<tr>
			<td><?php echo $msg; ?></td>
		</tr>
		<tr>
			<td>Télécharger une image:</td>
			<td><input type="file" name="imagefile"></td>
		</tr>
		<tr>
			<td colspan="2">
				<input id="btt" type="submit" name="valider">
			</td>
		</tr>
	</table>
	</form>
</body>
</html>