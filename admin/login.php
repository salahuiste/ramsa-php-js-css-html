
<?php
session_start();
$_SESSION['allowed']='non';
$usrr=$pass=' ';
if($_SERVER["REQUEST_METHOD"] == "POST") {

		if(empty($_POST['username'])) {
				$usrr="Entre the username!";
			}
		if(empty($_POST['password'])) {
				$pass="Entre the password!";
			}
		if(!empty($_POST['password'])&&!empty($_POST['username']))	{
		try {
			$bdd=new PDO("mysql:host=localhost;dbname=ramsa;charset=utf8","root","");
		}
		catch(Exception $e)
			{
        die('Erreur : '.$e->getMessage());
		}
		$rep=$bdd->query('SELECT username,password FROM tbl_user');
		while($donnes=$rep->fetch()) {
			$pass_hashed=md5($_POST['password']);
			if($_POST['username']==$donnes['username'] && $pass_hashed==$donnes['password'] )
			{
				$_SESSION['allowed']='yes';
				$_SESSION['user']=$_POST['username'];
				header('Location: index.php');
			}
			else {
				if($_POST['username']!=$donnes['username']) 
					$usrr="the username is invalid!";
				
				if($pass_hashed!=$donnes['password'])
					$pass='the password is invalid!';
			}
			
			

									}	
		}
										}
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	 <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style type="text/css">
		.butt{
			border-radius: 4px;
			width: 300px;
			height: 30px;
			border:1px solid #cdc9c2;
		}
		.butt1{
			width: 100px;
			height: 30px;
			color: white;
			border: 1px solid #0782c8;
			background-color:#0782c8;
			border-radius: 6px;
		}
		.butt1:hover{
			color:#9c9ea0;
		}
		#log{
			position: relative;
			margin-top:200px;
			margin-left: 500px;
		}
		.err {
			color: red;
		}
	</style>

</head>
<body>

<div id="log"> 
	<p style="font-size: 1.5em; font-weight: bold; color: #0782c8; ">Login to RAMSA Admin System</p>
	<form action="login.php" method="post">
		<table>
			<tr>
				<td><input class="butt" type="text" name="username" placeholder="username"></td>
				<td><?php echo"<p class='err'>".$usrr."</p>" ?></td>
			</tr>
			<tr>
				<td><input class="butt" type="password" name="password" placeholder="password"></td>
				<td><?php echo"<p class='err'>".$pass."</p>" ?></td>
			</tr>
			<tr>
				<td><input class="butt1" type="submit" name="login" value="Login"></td>
			</tr>
		</table>
	</form>
</div>
</body>
</html>