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
if(!empty($_GET['delete'])) {
	$delete=$bdd->prepare('DELETE FROM galerie WHERE id=?');
	$delete->execute(array($_GET['delete']));
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Galerie</title>
	<style type="text/css">
				body {
			background-color: #e9eaeb;
		}
	</style>
</head>
<body>
<?php include 'includes/header.php'; ?>
<div id="bd">
    	<div align="center" id='addbtn'>
    		<a href='add_gallery.php'><img src='images/add-128.png' width='30px'></a>
    	</div>
    	<div>
     <?php 
			$ge=$bdd->query('SELECT * FROM galerie ORDER BY id');
			if($ge) {
				echo"<table class='tab' align='center'>";
				echo"<tr>";
				echo "<th>ID</th>";
				echo "<th>Chemin</th>";
				echo "</tr>";
			while ($donnes=$ge->fetch()) {
				echo "<tr>";
				
				echo "<td>".$donnes['id'].'</td>';
				echo "<td>".$donnes['chemin'].'</td>';
				echo "<td>
				<div>
				 <a href=\"gallery.php?delete=".$donnes['id']."\"><img width='20px' src='images/trash-512.png'> </a>
				 </div>
				 </td>";
				echo "</tr>";
			}
			echo "</table>";
						}		
				
			
	?>
  		</div>
  </div>
</body>
</html>