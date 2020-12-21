<?php 
session_start();
	if(empty($_SESSION['allowed']) OR $_SESSION['allowed']=='non' ) {
	$title='Redirecting';
		header('Location: login.php');
			}	
	else {
		try {
			$bdd=new PDO("mysql:host=localhost;dbname=ramsa;charset=utf8","root","");
		}
		catch(Exception $e)
			{
        die('Erreur : '.$e->getMessage());
		}
		$bdd->query('DELETE FROM tbl_news WHERE id=\''.$_GET['id'].'\'');
		header('Location:./news.php');
	}
?>