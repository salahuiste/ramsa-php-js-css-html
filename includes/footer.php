<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		#tabfoo ul {
			list-style-type: none;
		 	display: flex;
		 	align-items: center;

		}
		#tabfoo li {
			margin-right: 50px;
		}
		#tabfoo img {
			width: 30px;
			height: 30px;
		} 
		footer {
			display: flex;
			align-items: center;
		}
		#phonne {
			margin-top: 5px;
			display: flex;
		}
		#phonne a{
			text-decoration: none;
			color: black;
		}
		#numsp {
		margin-top: 6px;
		}
	</style>
	    <script type="text/javascript">
    	function tekhrej() {
    		var para=document.getElementById('numsp');
    			para.style.opacity=1;
    	}
    </script>
</head>
<body>
<div>
	<footer style="	border-top: 2px solid #045FB4;
	border-bottom: 2px solid #045FB4;">

		<div id="tabfoo">
			<ul>
				
				<li>SUIVEZ-NOUS:</li>
				<li><a href="https://www.facebook.com/ramsagadir/"><img src="http://localhost/ramsa/images/fb.png"></a></li>
				<li><a href="#"><img src="http://localhost/ramsa/images/twit.png"></a></li>
				<li>APPELEZ-NOUS:</li>
				<li id='phonne'><a href="#" onclick="tekhrej()"><img src="http://localhost/ramsa/images/phone.png"></a><span id='numsp' style="opacity: 0;">05 28 82 96 00</span></li>
				
			</ul>		
		</div>

</footer>
</div>

</body>
</html>