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
		$pre=$bdd->prepare('INSERT INTO tbl_news (title,description,date_news,image) VALUES(:title,:descr,:datee,:image)');
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

	                        move_uploaded_file($_FILES['imagefile']['tmp_name'], 'uploads/' . basename($_FILES['imagefile']['name']));

							$pat='admin/uploads/' . basename($_FILES['imagefile']['name']);	                        

	                }

        }

}
		$dat=date("Y/m/d");
		$pre->execute(array(
			'title' => $_POST['titlear'],
			'descr' => $_POST['descr'],
			'datee'=> $dat,
			'image' => $pat
			));

	}

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Ajouter une article</title>
	<style type="text/css">
		body {
			background-color: #e9eaeb;
		}
		table {
			width: 800px;
			height: 500px;
			margin-top: 40px;
			text-align: center;
			border:2px solid #96999a;
			border-radius: 10px;
			color: black;
		}
		.pn {
			border: 1.6px solid #96999a;
			border-radius: 10px;
			width: 250px;
		}
		#btt {
			border: 1.6px solid #96999a;
			width: 100px;
			color:black;
			font-weight: bold;
			border-radius: 10px;
		} 

	</style>
</head>
<body>
<?php include 'includes/header.php'; ?>
	<form action="add_news.php" method="post" enctype="multipart/form-data">
	<table align="center">
		<tr>
			<td colspan="2">
				<?php echo $msg; ?>
			</td>
		</tr>
		<tr>
			<td>Le titre de votre article:</td>
			<td><input class="pn" type="text" name="titlear" max='100'></td>
		</tr>
		<tr>
			<td>
				Description:
			</td>
			<td>
				<textarea class="pn" cols="100" rows="16" name='descr'>
					
				</textarea>
			</td>
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