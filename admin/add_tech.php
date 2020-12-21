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
	if($_SERVER['REQUEST_METHOD']=='POST') {
		$req=$bdd->prepare('INSERT INTO agent VALUES(:mat,:nom,:pre,:cin,:pwd,:ema,1,2,:loc)');
		$_POST['passa']=md5($_POST['passa']);
		$req->execute(array(
			'mat'=> $_POST['mata'],
			'nom' => $_POST['noma'],
			'pre' => $_POST['prena'],
			'cin' =>$_POST['cina'],
			'pwd' => $_POST['passa'],
			'ema' =>$_POST['email'],
			'loc'=>$_POST['loca']
			));
	$msg='<p style="color:green">L\'agent est bien ajouté!</p>';
	}
?>					
<!DOCTYPE html>
<html>
<head>
	<title>Ajouter un technicien</title>
	<style type="text/css">
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
<?php include('includes/header.php'); ?>

	<form action="add_tech.php" method="POST">
		<table align="center">
		<tr>
			<td colspan="2">
				<?php echo $msg; ?>
			</td>
		</tr>
		<tr>
			<td>Matricule</td>
			<td><input class="pn" type="text" name="mata" max='15'></td>
		</tr>
		<tr>
			<td>
				Nom:
			</td>
				<td><input class="pn" type="text" name="noma" max='100'></td>
		</tr>
		<tr>
			<td>Prénom:</td>
			<td><input class="pn" type="text" name="prena" max='100'></td>
		</tr>
		<tr>
			<td>CIN:</td>
			<td><input class="pn" type="text" name="cina" max='12'></td>
		</tr>
		<tr>
			<td>Password:</td>
			<td><input class="pn" type="password" name="passa" max='40'></td>
		</tr>
		<tr>
			<td>Email:</td>
			<td><input class="pn" type="email" name="email"></td>
		</tr>
		<tr>
			<td>Localité:</td>
			<td><input class="pn" type="text" name="loca" max='100'></td>
		</tr>
		<tr>
			<td colspan="2">
				<input id="btt" type="submit" name="valider">
			</td>
		</tr>
	</form>
</body>
</html>