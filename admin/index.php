<?php
session_start();
$title='';
if(empty($_SESSION['allowed']) OR $_SESSION['allowed']=='non' ) {
	$title='Redirecting';
	header('Location: login.php');
}
else {
	$title="Admin Page";

}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?></title>

</head>
<body>
		<?php include('includes/header.php'); ?>

</body>
</html>