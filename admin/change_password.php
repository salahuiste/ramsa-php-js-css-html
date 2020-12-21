<?php
	$msg='';
	session_start();
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
 	$donnes=$bdd->query("SELECT password FROM tbl_user");
 	$thepass=$donnes->fetch();
 	$thepass_entred=md5($_POST['oldpass']);
 	if(strlen($_POST['newpassword1'])<5) {
 		$msg='<span style="color:red">le motdepasse doit être supérieur ou égal à 5 </span>';
 	}
 	else {

 		if($thepass['password']!=$thepass_entred OR strlen($thepass_entred)<5) {
 		$msg='<span style="color:red">le mot de passe est incorrect! </span>';
 	}
 	else {
 		if($_POST['newpassword1']!=$_POST['newpassword2']) {
 			$msg='les motdepasses doivent être identiques!';
 		}
 		else {
 			$thenew_pass=md5($_POST['newpassword1']);
 			$req = $bdd->prepare('UPDATE tbl_user set password=:pass WHERE username="admin"');

			$req->execute(array(
				    'pass' => $thenew_pass,
				    ));
 			$msg='<span style="color:green">le motdepasse est bien modifée!</span>';
 		}
 	}
 	}
 	
 	}
}
 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
	<style type="text/css">
		table {
			width: 500px;
			height: 300px;
			border:2px solid #96999a;
			border-radius: 10px;
			color: black;
		}
		div table {
			margin: auto;
			text-align: center;
			margin-top: 60px;
		}
		.ps {
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
		body {
			background-color: #e9eaeb;
		}
	</style>
</head>
<body>
<?php include('includes/header.php') ?>
<div>
	<form action="change_password.php" method="post">
	<table>
		<tr>
			<td colspan="2">
				<?php echo $msg; ?>
			</td>
		</tr>
		<tr>
			<td>
				Entrez l'ancien mot de passe:
			</td>
			<td>
				<input class="ps" type="Password" name="oldpass">
			</td>
		</tr>
		<tr>
			<td>
				Entrez le nouveau mot de passe:
			</td>
			<td>
				<input class="ps" type="Password" name="newpassword1">
			</td>
		</tr>
		<tr>
			<td>
				Rentrez le nouveau mot de passe:
			</td>
			<td>
				<input class="ps" type="Password" name="newpassword2">
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input id="btt" type="submit" value="Valider">
			</td>
		</tr>
	</table>
	</form>

</div>
</body>
</html>