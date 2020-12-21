<?php
$msg='';
if($_SERVER["REQUEST_METHOD"] == "POST") {
		try {
			$bdd=new PDO("mysql:host=localhost;dbname=ramsa;charset=utf8","root","");
		}
		catch(Exception $e)
			{
        die('Erreur : '.$e->getMessage());
		}
	$pre=$bdd->prepare('INSERT INTO tbl_contact (name,email,subject,message,date_message) VALUES(:name,:email,:subject,:message,:datee)');
	$datee=date("Y/m/d");

	$name=htmlspecialchars($_POST['namec']);
	$email=htmlspecialchars($_POST['emailc']);
	$subject=htmlspecialchars($_POST['sujetc']);
	$message=htmlspecialchars($_POST['messagec']);
	$pre->execute(array(
		'name' =>$name,
		'email' =>$email,
		'subject' => $subject,
		'message' => $message,
		'datee' =>$datee
		));
		

										  }		
?>
<!DOCTYPE html>
<html>
<head>
	<title>Contactez-Nous</title>
	<style type="text/css">
		body
			{
			    width: 1200px;
			    margin: auto;
			    border-right: 2px solid #045FB4;
				border-left: 2px solid #045FB4;
			}
		#formdiv {
			display: flex;
			flex-direction: column;
			justify-content: space-between;

			 } 
		.pn {
			border: 1.6px solid #5e5e5f;
			height: 20px;
			width: 250px;
		}
		textarea {
			border: 1.6px solid #5e5e5f;

		}
		#butt{
			background-color: #045FB4;
			color:white;
			height: 30px;
			width: 60px;
			border-radius: 10px;
		}
		#bloc_page{
			display: flex;
			flex-direction: column;
		}
		#pagecourant {
			margin-top: -5px;
			margin-left: 10px; 
			color: #045FB4;
		}
	</style>
</head>
<body>
<div id='bloc_page'>
		<?php include("includes/header.php"); ?>

		<div id='formdiv'>
			<div>
				<h2 id='pagecourant'>Contactez-nous:</h2>
			</div>
			<div>
				<form action="contact.php" method="POST">
				<table align="center">
					<tr>
						<td align="center" colspan="2"><?php echo $msg; ?></td>
					</tr>
					<tr>
						<td>Nom et prénom:</td>
						<td><input type="text" name="namec" class="pn" required></td>						
					</tr>
					<tr>
						<td>Email:</td>
						<td><input type="email" name="emailc" class="pn" required></td>						
					</tr>
					<tr>
						<td>Sujet:</td>
						<td><input type="text" name="sujetc" class="pn" required></td>		
					</tr>
					<tr>
						<td>Message:</td>
						<td>
							<textarea rows="10" cols="60" name="messagec" required>
								
							</textarea>
						</td>	
					</tr>
					<tr>
						<td align="center" colspan="2"><input type="submit" name="Envoyer" id='butt'></td>
					</tr>
				</table>
			</form>
			</div>
			
		</div>
		<?php include("includes/footer.php"); ?>
</div>
</body>
</html>