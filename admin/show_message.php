<?php
	session_start();
	if(empty($_SESSION['allowed']) OR $_SESSION['allowed']=='non' ) {
	$title='Redirecting';
	header('Location: login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Voir Message</title>
	<style type="text/css">
		body {
  		background-color: #e9eaeb;
 		 }
 		 table {
 		 	margin-top: 40px;
 		 	border-collapse: collapse;
 		 }
		tr,td  {
  		border:2px solid #96999a ;
  		width: 324px;
  			}
 		.np {
 			font-family: arial;
 			font-weight: bold;

 		}
	</style>
</head>
<body>
<?php include('includes/header.php') ?>
<div>
	<?php 
		try {
			$bdd=new PDO("mysql:host=localhost;dbname=ramsa;charset=utf8","root","");
		}
		catch(Exception $e)
		{
		        die('Erreur : '.$e->getMessage());
		}
		$ge=$bdd->query('SELECT name,email,subject,message,date_message FROM tbl_contact WHERE id=\''.$_GET['id'].'\'');
		$donnees=$ge->fetch();
		echo "<table align='center'>";
			echo "<tr>";
				echo "<td class='np'>Nom et Prénom:</td>";
				echo "<td>".$donnees['name']."</td>";				
			echo "</tr>";
			echo "<tr>";
				echo "<td class='np'>Email:</td>";
				echo "<td>".$donnees['email']."</td>";				
			echo "</tr>";
			echo "<tr>";
				echo "<td class='np'>Sujet:</td>";
				echo "<td>".$donnees['subject']."</td>";				
			echo "</tr>";
			echo "<tr>";
				echo "<td class='np'>Message:</td>";
				echo "<td>".$donnees['message']."</td>";				
			echo "</tr>";			
		echo"</table>";
	?>
</div>
</body>
</html>