<!DOCTYPE html>
<html>
<head>
	<title>RAMSA</title>
	 <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style type="text/css">
		body
		{
		    width: 1200px;
		    margin: auto;
		    display: flex;
		    flex-direction: column;
		    border-right: 2px solid #045FB4;
			border-left: 2px solid #045FB4;
		}
		#bannerdiv {
			margin-top:10px; 
			margin-left: 10px;
			margin-right: 10px;
			background-image: url('images/ban-presentation.jpg');
			height: 185px;
			width: 1180px;
			display: flex;
			justify-content: space-between;
		}
		#bannerdiv div{
			margin-top: 60px;
		}
		#bloc_page {
			margin-top: 10px;
		}

		#butt a{
			margin-right: 10px;
		}
		#butt img {
			border-radius: 10px;
			height: 100px;
			width: 140px;
		}
		#butt {
			width: 330px;
			display: flex;
		}
		table {
			border-collapse: collapse;
			width: 400px;
			border:2px solid #045FB4;
		}
		div table {
			margin-bottom: 20px;
			margin-right: 240px;
		}
		#nb_page{
			margin-top: 10px;
			display: flex;
		}
		#nb_page h3 {
			text-align: center;
			margin-top:0px; 
			color: white;
			background-color:#045FB4; 
			border-radius: 5px 5px 5px 5px;

		}
		#framee {
			margin-left: 35px;			
		}
		#framee iframe {
			height: 130px;
		} 
		#newspart {
			width: 400px;

			display: flex;
			flex-direction:column;
		}
		#newspart a {
			color:#292828;
			font-size:1em;		
			text-decoration: none;
		}
		#newspart td:hover {
			background-color: #045FB4;
		}
		.class1 {
			background-color: #c0bdbd;
		}
		.class2 {
			background-color: #e3e0e0;
		}
	</style>
	<script type="text/javascript">
		var last,next,actuel='images/ban-presentation.jpg';
		var arraypics=['images/ban-presentation.jpg','images/espace-client.jpg','images/Station-depuration-mzar.jpg'];
		function changeback1(pl){
			for(var i=0;i<arraypics.length;i++) {
				if(pl=='right') {
					if(actuel==arraypics[i])
					{
						if(i==(arraypics.length-1)) {
							actuel=arraypics[0];
							break;
						}
						else {
							actuel=arraypics[i+1]
							break;
						}
					}	
				}
				else {
					if(actuel==arraypics[i])
					{
						if(i==0) {
							actuel=arraypics[arraypics.length-1];
							break;
						}
						else {
							actuel=arraypics[i-1]
							break;
						}
					}	
				}	
				
			}
			 document.getElementById('bannerdiv').style.backgroundImage = 'url("'+actuel+'")';
		}
		
	</script>
</head>
<body>
<?php include("includes/header.php"); ?>
<div>
	
		<div style="margin:auto;">
			<div  id="bannerdiv" >
				<div>
					<a href="#" >
						<img src="images/leftarrow.png" width="40px" onclick="changeback1('left');">
					</a>		
				</div>

				<div>
					<a href="#" >
							<img src="images/rightarrow.png" width="40px" onclick="changeback1('right');" >	
					</a>	
			
			</div>
			
		</div>
	<div id='nb_page' >
			<div id='butt' style="margin-left: 10px; margin-top: 50px;">


				<div>
					<a href="espace_client.php" >
						<img src="http://localhost/ramsa/images/espaceclient.jpg">
					</a>
				</div>	
				<div>
					<a href="gallery.php">
						<img src="http://localhost/ramsa/images/espacegalerie.jpg">
					</a>
				</div>
			</div>
			<div id='newspart'>
				<div>
					<a href="http://localhost/ramsa/news.php">
						<h3>Les actualités:</h3>
					</a>
				</div>
				<div>
					<?php
						try  {
						$bdd=new PDO("mysql:host=localhost;dbname=ramsa;charset=utf8","root","");
							}
						catch(Exception $e)
								{
					        die('Erreur : '.$e->getMessage());
							}
						$ge=$bdd->query('SELECT id,title FROM tbl_news ORDER BY id desc LIMIT 0,5');
						echo "<table id='tabnews'>";
						$cmp=0;
						$backg;
						while($donnes=$ge->fetch()) {
							if($cmp%2) $backg='class1';
							else 
								$backg='class2';
							echo "<tr>";
								echo "<td class='".$backg."''>";
								echo "<a href=\"news_detail.php?id=".$donnes['id']."\">".$donnes['title']." </a> </td>";
							echo "</tr>";
							$cmp++;

						}
						echo "</table>";

						?>
				</div>
			</div>
			<div id='framee'>
				<div>
					<a href="#">
						<h3 >Localisation:</h3>
					</a>
				</div>
				 <iframe frameborder="0" width="400px" style="border:2px solid #045FB4; overflow: scroll;"
					  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDkiiR_7L8wV0HBQJ1QVmxChS8Cc4mPBio&q=Independent+multi-service+agency+Agadir" allowfullscreen>
						</iframe>
			</div>
	</div>		
</div>	
<?php include("includes/footer.php"); ?>

</body>
</html>