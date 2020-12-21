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
  <title>News</title>
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
  	#bd {
  		display: flex;
  		/*flex-direction: column;**/
  		}

  </style>
</head>
<body>
<?php include('includes/header.php') ?>
  <div id="bd">
    	<div align="center" id='addbtn'>
    		<a href='add_news.php'><img src='images/add-128.png' width='30px'></a>
    	</div>
    	<div>
     <?php 
			try {
					$bdd=new PDO("mysql:host=localhost;dbname=ramsa;charset=utf8","root","");
				}
				catch(Exception $e)
					{
		        die('Erreur : '.$e->getMessage());
				}
				echo"<table class='tab' align='center'>";
				echo"<tr>";
				echo "<th>ID</th>";
				echo "<th>TITRE</th>";
				echo "<th>DATE</th>";
				echo "<th>OPTIONS</th>";
				echo "</tr>";
			$ge=$bdd->query('SELECT id,title,date_news FROM tbl_news ORDER BY id');
			while ($donnes=$ge->fetch()) {
				echo "<tr>";
				echo "<td>".$donnes['id'].'</td>';
				echo "<td>".$donnes['title'].'</td>';
				echo "<td>".$donnes['date_news'].'</td>';
				echo "<td>
				<div><a href=\"edit_news.php?id=".$donnes['id']."\"><img width='20px' src='images/Replace-icon.png'> </a></div>
				<div>
				 <a href=\"delete_news.php?id=".$donnes['id']."\"><img width='20px' src='images/trash-512.png'> </a>
				 </div>
				 </td>";
				echo "</tr>";
			}
			echo "</table>"
			
	?>
  		</div>
  </div>
</body>
</html>