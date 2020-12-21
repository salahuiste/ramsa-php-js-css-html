<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
			body {
 		margin: 0px;
 		display: flex;
 		flex-direction: column;
			}

		header {
		color: white;
		background-color: #0782c8;
    	display: flex;
    	justify-content: space-between;
    	height: 70px;
		}
		#log {
			margin-top:4px;
			font-size: 300%;
			font-weight: bold;
		}
		ul {
			display: flex;
			list-style-type: none;
		}
		header li {
			font-weight: bold;
			margin-top:10px;
			color: white;
			margin-right:20px;
		}
		header a {
			font-weight: bold;
			color: white;
			text-decoration: none;
		}
		nav a:hover {
			border-bottom: 1px solid white;
		}
		#barremenu {
			background-color: #e9eaeb;
			border-bottom: 2px solid #96999a;
		}
		#barremenu a {
			font-weight: bold;
			color: #96999a;
			text-decoration: none;
		}
		#barremenu li {
			margin-right:10px;
		}
		#barremenu a:hover {
			color: #0888dc;
			border-bottom: 2px solid #0888dc;
		}
		#barremenu ul {
			display: flex;
			justify-content: space-between;
		}
	</style>
</head>
<body>
	<header>
		<div>
			<p id='log'><a href="http://localhost/ramsa/" >RAMSA</a></p>
		</div>
		<div>
			<nav>
				<ul>
					<li>Votre Identifiant:<a href="http://localhost/ramsa/tech/change_password.php"><?php echo $_SESSION['user']; ?></a></li>
					<li><a href="logout.php">Se déconnecter</a></li>
				</ul>
			</nav> 
		</div>
	</header>
	<div id="barremenu">
		<ul>
			<li><a href="index.php">Home</a></li>		
			<li><a href="recl.php">Toutes Les Réclamations</a></li>

		</ul>
	</div>
</body>
</html>