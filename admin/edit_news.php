<?php
	session_start();
	if(empty($_SESSION['allowed']) OR $_SESSION['allowed']=='non' ) {
	$title='Redirecting';
		header('Location: login.php');
			}	
	else {
			try {
						$bdd=new PDO("mysql:host=localhost;dbname=ramsa;charset=utf8","root","");
					}
					catch(Exception $e)
						{
			        die('Erreur : '.$e->getMessage());
					}
				if($_SERVER["REQUEST_METHOD"] == "POST") {
					$pat=NULL;
					$pre=$bdd->prepare('UPDATE tbl_news SET id=:idn,title=:titlen,description=:descrn,date_news=:daten,image=:imagen where id=:idn');
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

							$pat='uploads/' . basename($_FILES['imagefile']['name']);	                        

	                }

        		}

			}
					$dat=date("Y/m/d");
					$pre->execute(array(
						'idn' => $_GET['id'],
						'titlen' => $_POST['titlear'],
						'descrn' => $_POST['descr'],
						'daten'=> $dat,
						'imagen' => $pat,
						'idn' =>$_GET['id']
						));

					}
	
			
		}
		
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit news</title>
</head>
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
<body>
<?php include('includes/header.php'); ?>
<?php 
		$ge=$bdd->query('SELECT title,description FROM tbl_news WHERE id=\''.$_GET['id'].'\'');
		$donnees=$ge->fetch();
?>
	<form action="<?php echo "edit_news.php?id=".$_GET['id']; ?>" method="post" enctype="multipart/form-data">
	<table align="center">
		<tr>
			<td>Le titre de votre article:</td>
			<td><input class="pn" type="text" name="titlear" max='100' value="<?php echo $donnees['title'] ?>"></td>
		</tr>
		<tr>
			<td>
				Description:
			</td>
			<td>
				<textarea class="pn" cols="100" rows="16" name='descr'><?php echo $donnees['description'] ?>
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