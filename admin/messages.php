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
	<title>Messages</title>
	<style type="text/css">
	body {
  		background-color: #e9eaeb;
 		 }
  .tab {
  		margin-top: 30px;
  		text-align: center;
  		border-collapse: collapse;
  	}
  	.tab th {
  		color:#0782c8;
  	}
  	.tab tr,td  {
  		border:2px solid #96999a ;
  		width: 324px;
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
			$num=$bdd->query('SELECT count(*) as numberr  FROM tbl_contact');
			$numb=$num->fetch();
			if($numb['numberr']) {
			$num->closeCursor();	
			echo"<table class='tab' align='center'>";
			echo"<tr>";
				echo "<th>Nom et Prénom</th>";
				echo "<th>Email</th>";
				echo "<th>Sujet</th>";
				echo "<th>Date</th>";
			echo "</tr>";
			$ge=$bdd->query('SELECT id,name,email,subject,message,date_message  FROM tbl_contact ORDER BY date_message');
			while ($donnes=$ge->fetch()) {
				echo "<tr>";
				echo "<td>".$donnes['name'].'</td>';
				echo "<td>".$donnes['email'].'</td>';
				echo "<td>".$donnes['subject'].'</td>';
				echo "<td>".$donnes['date_message'].'</td>';
				echo "<td>
				<div><a href=\"show_message.php?id=".$donnes['id']."\"><img width='20px' src='images/search-128.png'> </a></div>
				<div>
				 </td>";
				echo "</tr>";
			}
			echo "</table>";
			}
			else {
				echo "<p aling='center' style='font-weight:bold; color:#96999a;'>Vous n'avez pas de messages ! </p>";
			}
			
			
	?>
			
</div>
</body>
</html>